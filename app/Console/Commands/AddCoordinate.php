<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Shop;

class AddCoordinate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $shops = Shop::all();
        foreach ($shops as $key => $shop) {
            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            
            $address = $shop->address;
            $myKey = "AIzaSyC84TWoDhQcrt9WieQlmtzD5hgJw_oNLig";
            
            $address = urlencode($address);
            
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "+CA&key=" . $myKey ;
            
            $contents= file_get_contents($url);
            $jsonData = json_decode($contents,true);
            
            $lat = $jsonData["results"][0]["geometry"]["location"]["lat"];
            $lng = $jsonData["results"][0]["geometry"]["location"]["lng"];
            print("lat=$lat\n");
            print("lng=$lng\n");
            $shop->latitude = $lat;
            $shop->longitude = $lng;
            $shop->save();
            sleep(2);

        }
    }
}
