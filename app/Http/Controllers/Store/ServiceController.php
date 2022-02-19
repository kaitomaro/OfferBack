<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\Service;
use App\Coupon;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\ObjectUploader;
use Aws\S3\Exception\S3Exception;
use App;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index(){
        $shop = Shop::find(Auth::guard('shop')->id());
        $services = 
        	Service::where('shop_id', $shop->id)
        		->get();
        return view('store/services/index')->with([
	       "services" => $services
	    ]);
    }

    public function insert_service(CreateServiceRequest $request) {
        $shop = Shop::find(Auth::guard('shop')->id());
        $service = new Service();
        $service->name = $request->input('name');
        $service->service_type = $request->input('service_type');;
        $service->shop_id = $shop->id;
        $service->price = $request->input('price');
        $service->bill_type = 30;
        $img_x = $request->input('menu_image_x');
        $img_y = $request->input('menu_image_y');
        $img_width = $request->input('menu_image_width');
        $img_height = $request->input('menu_image_height');
        if (file_exists($request->file('menu_file'))) {
            if($request->file('menu_file')->isValid()) { 
                $now = date_format(Carbon::now(), 'YmdHis');
                $file = $request->file('menu_file');
                $mime = $file->getMimeType();
                $name = $shop->id;
                $name = $now . '_service_' . $name;
                $image = Image::make($file);
                $image->orientate();
                $image->crop($img_width, $img_height, $img_x, $img_y);
                $image->resize(828, 360);
                $s3 = App::make('aws')->createClient('s3');
                $s3->putObject(array(
                    'Bucket'     => config('filesystems.disks.s3.bucket'),
                    'Key'        => "service/".$name,
                    'Body'       =>  (string) $image->encode(),
                    'ContentType' => $mime,
                    'ACL'        => 'public-read'
                ));
                $service->image_path = "service/".$name;
            }
        }
        $service->save();
        return redirect('/store/services');
    }

    public function update_service(UpdateServiceRequest $request) {
        if ($request->has('delete')) {
            $service = Service::find($request->input('id'));
            $coupon = Coupon::where('service_id', $service->id);
            $coupon->delete();
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $service->image_path
            ]);
            $service->delete();
            return redirect('/store/services');
        }
        $shop = Shop::find(Auth::guard('shop')->id());
        $service = Service::find($request->input('id'));
        $service->name = $request->input('name');
        $service->shop_id = $shop->id;
        $service->price = $request->input('price');
        $service->bill_type = 30;
        $img_x = $request->input('menu_image_x');
        $img_y = $request->input('menu_image_y');
        $img_width = $request->input('menu_image_width');
        $img_height = $request->input('menu_image_height');
        if (file_exists($request->file('menu_file'))) {
            if($request->file('menu_file')->isValid()){ 
                $now = date_format(Carbon::now(), 'YmdHis');
                $file = $request->file('menu_file');
                $mime = $file->getMimeType();
                $name = $shop->id;
                $name = $now . '_service_' . $name;
                $image = Image::make($file);
                $image->orientate();
                $image->crop($img_width, $img_height, $img_x, $img_y);
                $image->resize(828, 360);
                $s3 = App::make('aws')->createClient('s3');
                $s3->putObject(array(
                    'Bucket'     => config('filesystems.disks.s3.bucket'),
                    'Key'        => "service/".$name,
                    'Body'       =>  (string) $image->encode(),
                    'ContentType' => $mime,
                    'ACL'        => 'public-read'
                ));
                $service->image_path = "service/".$name;
            }    
        }

        $coupons = Coupon::where('service_id', $service->id)->get();
        if (count($coupons) > 0) {
            foreach ($coupons as $key => $coupon) {
                if ($service->service_type == 1) {
                    if ($coupon->discount != $service->price) {
                        $coupon->discount = $service->price;
                        $coupon->save();
                    }
                }
            }
        }

        $service->save();
        return redirect('/store/services');
    }
}