<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        for ($i = 1; $i < 6; $i++) {
            $user = User::create([
                'firstname' => $faker->firstname(),
                'lastname' => $faker->lastname(),
                'email' => $i == 1 ? 'user@claimstack.com' : $faker->unique()->safeEmail(),
                'uid' => $i,
                'employee_code' => 'EMP' . $i,
                'designation' => 'Employee',
                'department' => $faker->randomElement(['Operations', 'Sales', 'Accounts', 'Lending', 'IT', 'Insurance', 'Analytics & MIS', 'Product Management', 'Provider management', 'Claims Processing', 'Claims Processing']),
                'phone' => $faker->numerify('9#########'),
                'kra' => Str::upper(Str::random(8)),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password')
            ]);
            $user->assignRole('user');
            $role = Role::where('name', 'user')->with('permissions')->first();
            foreach($role->permissions as $permission){
                 $user->givePermissionTo($permission);
            }
        }
        $admins = User::get(['id', 'employee_code', 'department']);
        foreach ($admins as $admin) {
            $part  = User::where('department', $admin->department)->first();
            User::where('id', $admin->id)->update([
                'linked_employee' => $part->id,
                'linked_employee_id' => $part->employee_code
            ]);
        }
    }
}
