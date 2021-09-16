<?php

namespace Database\Seeders;

use App\Http\Controllers\Pay\ClienteController;
use App\Models\Address;
use App\Models\City;
use App\Models\Contact;
use App\Models\Image;
use App\Models\Lottery;
use App\Models\Payment;
use App\Models\PaymentMeta;
use App\Models\Raffle;
use App\Models\RaffleMeta;
use App\Models\Ticket;
use App\Models\TicketAlias;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Database\Seeder;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * To run: php artisan db:seed --class=FakerSeeder
     *
     * @return void
     */
    public function run()
    {
        Contact::factory(150)->create();
    }
}
