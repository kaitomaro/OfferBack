<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Device;
use Aws\Sns\Exception\SnsException;
use Aws\Sns\SnsClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MakeEndpoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:insert_devices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $devices = Device::all();

        foreach ($devices as $key => $device) {
            try {
                $platformApplicationArn = config('aws.Sns.arn');
                if (isset($request->platform) && $request->platform == 'android') {
                    $platformApplicationArn = env('ANDROID_APPLICATION_ARN');
                }
                $client = App::make('aws')->createClient('sns');

                $protocol = 'application';
                $endpoint = $device->arn;
                $topic = config('aws.Sns.topic');
                $result = $client->subscribe([
                    'Protocol' => $protocol,
                    'Endpoint' => $endpoint,
                    'ReturnSubscriptionArn' => true,
                    'TopicArn' => $topic,
                ]);
            } catch (SnsException $e) {
                return response()->json(['error' => "Unexpected Error"], 500);
            }
            sleep(2);
        }
    }
}
