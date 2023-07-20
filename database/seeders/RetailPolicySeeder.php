<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RetailPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('retail_policies')->truncate();
       $sql = file_get_contents(database_path() . '/seeds/retail_policies.sql');
    
        DB::statement($sql);
    }
}
