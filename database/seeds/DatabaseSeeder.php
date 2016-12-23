<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AndroidDeviceTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('PostTableSeeder');
        $this->call('FactTableSeeder');
        $this->call('FeedBackTableSeeder');
    }
}
