<?php

namespace Database\Seeders;

use App\Models\AssociatePartner;
use App\Models\HospitalFacility;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HospitalFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);
        for ($i = 1; $i < 10; $i++) {

            $hospital    = Hospital::inRandomOrder()->first();

            HospitalFacility::create([
                'hospital_id' => $hospital->id,
                'pharmacy' => $faker->randomElement(['Yes','No']),
                'lab' => $faker->randomElement(['Yes','No']),
                'ambulance' => $faker->randomElement(['Yes','No']),
                'operation_theatre' => $faker->randomElement(['Yes','No']),
                'icu' => $faker->randomElement(['Yes','No']),
                'iccu' => $faker->randomElement(['Yes','No']),
                'nicu' => $faker->randomElement(['Yes','No']),
                'csc_sterilization' => $faker->randomElement(['Yes','No']),
                'centralized_gas_ons' => $faker->randomElement(['Yes','No']),
                'centralized_ac' => $faker->randomElement(['Yes','No']),
                'kitchen' => $faker->randomElement(['Yes','No']),
                'usg_machine' => $faker->randomElement(['Yes','No']),
                'digital_xray' => $faker->randomElement(['Yes','No']),
                'ct' => $faker->randomElement(['Yes','No']),
                'mri' => $faker->randomElement(['Yes','No']),
                'pet_scan' => $faker->randomElement(['Yes','No']),
                'organ_transplant_unit' => $faker->randomElement(['Yes','No']),
                'burn_unit' => $faker->randomElement(['Yes','No']),
                'dialysis_unit' => $faker->randomElement(['Yes','No']),
                'blood_bank' => $faker->randomElement(['Yes','No']),
                'comments' => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }
    }
}
