<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Shop;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendToAllShopsMail;

class SendMailToShopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_mails';

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
        foreach ($shops as $shop) {
            // echo $shop['email']."\n";

            Mail::to($shop->email)->send(new SendToAllShopsMail());
        }
    }
}
