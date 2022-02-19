<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Device;
use Aws\Sns\Exception\SnsException;
use Aws\Sns\SnsClient; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserDeviceTokenController extends Controller
{
    public function getDeviceToken(Request $request)
    {
        try {
            $device = Device::whereAppDeviceToken($request->app_device_token)->first();
            if ($device == null) {
                $platformApplicationArn = config('aws.Sns.arn');
                if (isset($request->platform) && $request->platform == 'android') {
                    $platformApplicationArn = env('ANDROID_APPLICATION_ARN');
                }
                $client = App::make('aws')->createClient('sns');
                $result = $client->createPlatformEndpoint(array(
                    'PlatformApplicationArn' => $platformApplicationArn,
                    'Token' => $request->app_device_token,
                    'CustomUserData' => $request->user_id
                ));

                $endPointArn = isset($result['EndpointArn']) ? $result['EndpointArn'] : '';
                $device = new Device();
                $device->platform = $request->platform;
                $device->app_device_token = $request->app_device_token;
                $device->arn = $endPointArn;
                $protocol = 'application';
                $endpoint = $endPointArn;
                $topic = config('aws.Sns.topic');
                $result = $client->subscribe([
                    'Protocol' => $protocol,
                    'Endpoint' => $endpoint,
                    'ReturnSubscriptionArn' => true,
                    'TopicArn' => $topic,
                ]);
            }
            $device->user_id = $request->user_id;
            $device->save();
        } catch (SnsException $e) {
            return response()->json(['error' => "Unexpected Error"], 500);
        }
        return response()->json(["status" => "Device token processed"], 200);
    }
}