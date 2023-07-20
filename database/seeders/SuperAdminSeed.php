<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class SuperAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

            $admin = SuperAdmin::create([
                'firstname' => $faker->firstname(),
                'lastname' => $faker->lastname(),
                'email' => 'superadmin@claimstack.com',
                'uid' => 1,
                'employee_code' => 'EMP1',
                'designation' => 'SuperAdmin',
                'department' => $faker->randomElement(['Operations', 'Sales', 'Accounts', 'Lending', 'IT', 'Insurance', 'Analytics & MIS', 'Product Management', 'Provider management', 'Claims Processing', 'Claims Processing']),
                'phone' => $faker->numerify('9#########'),
                'kra' => Str::upper(Str::random(8)),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password')

            ]);
            /*$admin->assignRole('admin');
            $role = Role::where('name', 'admin')->with('permissions')->first();
            foreach($role->permissions as $permission){
                 $admin->givePermissionTo($permission);
            }

        $admins = SuperAdmin::first();

            $part  = User::where('department', $admin->department)->inRandomOrder()->first();
            SuperAdmin::where('id', $admin->id)->update([
                'linked_employee' => $part->id,
                'linked_employee_id' => $part->employee_code
            ]);*/
    }
}
