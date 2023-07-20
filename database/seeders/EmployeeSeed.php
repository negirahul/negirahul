<?php

namespace Database\Seeders;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class EmployeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        for ($i = 1; $i < 2; $i++) {
            Employee::create([
                'firstname' => $faker->firstname(),
                'lastname' => $faker->lastname(),
                'email' =>  $i == 1 ? 'employee@claimstack.com' : $faker->unique()->safeEmail(),
                'employee_code' => 'EMP' . $i,
                'designation' => 'Employee',
                'phone' => $faker->numerify('9#########'),
                'kra' => Str::upper(Str::random(8)),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password')

            ]);
        }
    }
}
