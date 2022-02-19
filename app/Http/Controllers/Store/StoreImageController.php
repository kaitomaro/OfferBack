<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Img;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ImageRequest;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\ObjectUploader;
use Aws\S3\Exception\S3Exception;
use App;

class StoreImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index() {
        $shop = Shop::find(Auth::guard('shop')->id());
        $images = 
        	Img::where('shop_id', $shop->id)
        		->get();
        return view('store/images/image_index')->with([
	       "images" => $images
	    ]);
    }

    public function create_image(ImageRequest $request) {
        $shop = Shop::find(Auth::guard('shop')->id());
        if ($request->has('delete_0')) {
            $image = Img::find(intval($request->input("id_0")));
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $image->image_name
            ]);
            $image->delete();
            if ($request->input("id_1") != "0") {
                $image1 = Img::find(intval($request->input("id_1")));
                $image1->sort_num = $image1->sort_num - 1;
                $image1->save();
            } if ($request->input("id_2") != "0") {
                $image2 = Img::find(intval($request->input("id_2")));
                $image2->sort_num = $image2->sort_num - 1;
                $image2->save();
            } if ($request->input("id_3") != "0") {
                $image3 = Img::find(intval($request->input("id_3")));
                $image3->sort_num = $image3->sort_num - 1;
                $image3->save();
            } if ($request->input("id_4") != "0") {
                $image4 = Img::find(intval($request->input("id_4")));
                $image4->sort_num = $image4->sort_num - 1;
                $image4->save();
            }

            return redirect('/store/images');
        } elseif($request->has('delete_1')) {
            $image = Img::find(intval($request->input("id_1")));
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $image->image_name
            ]);
            $image->delete();
            if ($request->input("id_2") != "0") {
                $image2 = Img::find(intval($request->input("id_2")));
                $image2->sort_num = $image2->sort_num - 1;
                $image2->save();
            } 
            if ($request->input("id_3") != "0") {
                $image3 = Img::find(intval($request->input("id_3")));
                $image3->sort_num = $image3->sort_num - 1;
                $image3->save();
            }
            if ($request->input("id_4") != "0") {
                $image4 = Img::find(intval($request->input("id_4")));
                $image4->sort_num = $image4->sort_num - 1;
                $image4->save();
            }
            return redirect('/store/images');
        } elseif($request->has('delete_2')) {
            $image = Img::find(intval($request->input("id_2")));
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $image->image_name
            ]);
            $image->delete();
            if ($request->input("id_3") != "0") {
                $image3 = Img::find(intval($request->input("id_3")));
                $image3->sort_num = $image3->sort_num - 1;
                $image3->save();
            }
            if ($request->input("id_4") != "0") {
                $image4 = Img::find(intval($request->input("id_4")));
                $image4->sort_num = $image4->sort_num - 1;
                $image4->save();
            }
            return redirect('/store/images');
        } elseif($request->has('delete_3')) {
            $image = Img::find(intval($request->input("id_3")));
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $image->image_name
            ]);
            $image->delete();
            if ($request->input("id_4") != "0") {
                $image4 = Img::find(intval($request->input("id_4")));
                $image4->sort_num = $image4->sort_num - 1;
                $image4->save();
            }
            return redirect('/store/images');
        } elseif($request->has('delete_4')) {
            $image = Img::find(intval($request->input("id_4")));
            $s3 = App::make('aws')->createClient('s3');
            $result = $s3->deleteObject([
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Key'    => $image->image_name
            ]);
            $image->delete();
            return redirect('/store/images');
        }
        $img_x = $request->input('store_image_x');
        $img_y = $request->input('store_image_y');
        $img_width = $request->input('store_image_width');
        $img_height = $request->input('store_image_height');
        if ($request->input("sort_id") == "0"){
            if (file_exists($request->file('img_file0'))) {
                if($request->file('img_file0')->isValid()) { 
                    if($request->input("id_0") != "0") {
                        $store_image = Img::find(intval($request->input("id_0")));
                    } else {
                        $store_image = new Img();
                    }
                    $now = date_format(Carbon::now(), 'YmdHis');
                    $file = $request->file('img_file0');
                    $mime = $file->getMimeType();
                    $name = $shop->id . '_0';
                    $name = $now . '_store_img_' . $name;
                    $image = Image::make($file);
                    $image->orientate();
                    $image->crop($img_width, $img_height, $img_x, $img_y);
                    $image->resize(2140, 900);
                    $s3 = App::make('aws')->createClient('s3');
                    if (isset($store_image->id)){
                        $result = $s3->deleteObject([
                            'Bucket' => config('filesystems.disks.s3.bucket'),
                            'Key'    => $store_image->image_name
                        ]);
                    }
                    $s3->putObject(array(
                        'Bucket'     => config('filesystems.disks.s3.bucket'),
                        'Key'        => "store_img/".$name,
                        'Body'       =>  (string) $image->encode(),
                        'ContentType' => $mime,
                        'ACL'        => 'public-read'
                    ));
                    $store_image->image_name = "store_img/".$name;
                    $store_image->sort_num = 0;
                    $store_image->shop_id = $shop->id;
                    $store_image->save();
                }
            }
        } elseif ($request->input("sort_id") == "1"){
            if(file_exists($request->file('img_file1')))  {
                if($request->file('img_file1')->isValid()) { 
                    if($request->input("id_1") != "0") {
                        $store_image = Img::find(intval($request->input("id_1")));
                    } else {
                        $store_image = new Img();
                    }
                    $now = date_format(Carbon::now(), 'YmdHis');
                    $file = $request->file('img_file1');
                    $mime = $file->getMimeType();
                    $name = $shop->id . '_1';
                    $name = $now . '_store_img_' . $name;
                    $image = Image::make($file);
                    $image->orientate();
                    $image->crop($img_width, $img_height, $img_x, $img_y);
                    $image->resize(2140, 900);
                    $s3 = App::make('aws')->createClient('s3');
                    if (isset($store_image->id)){
                        $result = $s3->deleteObject([
                            'Bucket' => config('filesystems.disks.s3.bucket'),
                            'Key'    => $store_image->image_name
                        ]);
                    }
                    
                    $s3->putObject(array(
                        'Bucket'     => config('filesystems.disks.s3.bucket'),
                        'Key'        => "store_img/".$name,
                        'Body'       =>  (string) $image->encode(),
                        'ContentType' => $mime,
                        'ACL'        => 'public-read'
                    ));
                    $store_image->image_name = "store_img/".$name;
                    $store_image->sort_num = 1;
                    $store_image->shop_id = $shop->id;
                    $store_image->save();
                }
            }
        } elseif ($request->input("sort_id") == "2") {
            if(file_exists($request->file('img_file2')))  {
                if($request->file('img_file2')->isValid()) { 
                    if($request->input("id_2") != "0") {
                        $store_image = Img::find(intval($request->input("id_2")));
                    } else {
                        $store_image = new Img();
                    }
                    $now = date_format(Carbon::now(), 'YmdHis');
                    $file = $request->file('img_file2');
                    $mime = $file->getMimeType();
                    $name = $shop->id . '_2';
                    $name = $now . '_store_img_' . $name;
                    $image = Image::make($file);
                    $image->orientate();
                    $image->crop($img_width, $img_height, $img_x, $img_y);
                    $image->resize(2140, 900);
                    $s3 = App::make('aws')->createClient('s3');
                    if (isset($store_image->id)){
                        $result = $s3->deleteObject([
                            'Bucket' => config('filesystems.disks.s3.bucket'),
                            'Key'    => $store_image->image_name
                        ]);
                    }
                    $s3->putObject(array(
                        'Bucket'     => config('filesystems.disks.s3.bucket'),
                        'Key'        => "store_img/".$name,
                        'Body'       =>  (string) $image->encode(),
                        'ContentType' => $mime,
                        'ACL'        => 'public-read'
                    ));
                    $store_image->image_name = "store_img/".$name;
                    $store_image->sort_num = 2;
                    $store_image->shop_id = $shop->id;
                    $store_image->save();
                }
            }
        } elseif ($request->input("sort_id") == "3") {
            if(file_exists($request->file('img_file3')))  {
                if($request->file('img_file3')->isValid()) { 
                    if($request->input("id_3") != "0") {
                        $store_image = Img::find(intval($request->input("id_3")));
                    } else {
                        $store_image = new Img();
                    }
                    $now = date_format(Carbon::now(), 'YmdHis');
                    $file = $request->file('img_file3');
                    $mime = $file->getMimeType();
                    $name = $shop->id . '_3';
                    $name = $now . '_store_img_' . $name;
                    $image = Image::make($file);
                    $image->orientate();
                    $image->crop($img_width, $img_height, $img_x, $img_y);
                    $image->resize(2140, 900);
                    $s3 = App::make('aws')->createClient('s3');
                    if (isset($store_image->id)){
                        $result = $s3->deleteObject([
                            'Bucket' => config('filesystems.disks.s3.bucket'),
                            'Key'    => $store_image->image_name
                        ]);
                    }
                    $s3->putObject(array(
                        'Bucket'     => config('filesystems.disks.s3.bucket'),
                        'Key'        => "store_img/".$name,
                        'Body'       =>  (string) $image->encode(),
                        'ContentType' => $mime,
                        'ACL'        => 'public-read'
                    ));
                    $store_image->image_name = "store_img/".$name;
                    $store_image->sort_num = 3;
                    $store_image->shop_id = $shop->id;
                    $store_image->save();
                }
            }
        } elseif ($request->input("sort_id") == "4") {
            if(file_exists($request->file('img_file4')))  {
                if($request->file('img_file4')->isValid()) { 
                    if($request->input("id_4") != "0") {
                        $store_image = Img::find(intval($request->input("id_4")));
                    } else {
                        $store_image = new Img();
                    }
                    $now = date_format(Carbon::now(), 'YmdHis');
                    $file = $request->file('img_file4');
                    $mime = $file->getMimeType();
                    $name = $shop->id . '_4';
                    $name = $now . '_store_img_' . $name;
                    $image = Image::make($file);
                    $image->orientate();
                    $image->crop($img_width, $img_height, $img_x, $img_y);
                    $image->resize(2140, 900);
                    $s3 = App::make('aws')->createClient('s3');
                    if (isset($store_image->id)){
                        $result = $s3->deleteObject([
                            'Bucket' => config('filesystems.disks.s3.bucket'),
                            'Key'    => $store_image->image_name
                        ]);
                    }
                    $s3->putObject(array(
                        'Bucket'     => config('filesystems.disks.s3.bucket'),
                        'Key'        => "store_img/".$name,
                        'Body'       =>  (string) $image->encode(),
                        'ContentType' => $mime,
                        'ACL'        => 'public-read'
                    ));
                    $store_image->image_name = "store_img/".$name;
                    $store_image->sort_num = 4;
                    $store_image->shop_id = $shop->id;
                    $store_image->save();
                }
            }
        } 
        return redirect("/store/images");
    }
}
