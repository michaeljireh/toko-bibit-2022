<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(ProcessSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
