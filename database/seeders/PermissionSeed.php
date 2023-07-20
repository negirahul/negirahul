<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user_role      = Role::create(['guard_name' => 'web', 'name' => 'user']);
       $admin_role     = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
       $associate_role = Role::create(['guard_name' => 'associate', 'name' => 'associate']);
       $employee_role  = Role::create(['guard_name' => 'employee', 'name' => 'employee']);

        // User Permissions
        Permission::create(['name' => 'Associate Partner Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Insurance Co. Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'TPA Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claims Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Authorization Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'File Management Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Report Generation Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Verification Module Creation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Bill Generation Module Creation/Editing Rights', 'guard_name' => 'web']);


        Permission::create(['name' => 'Admin Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'User Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Associate Partner Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Patient Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim ID Creation/Claim Intimation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claimant Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Borrower Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Insurance Co. Login ID Creation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'TPA Login ID Creation Rights', 'guard_name' => 'web']);

        Permission::create(['name' => 'Admin Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'User Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Associate Partner Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital Details Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Patient Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Intimation Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claimant Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Borrower Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Insurance Co. Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'TPA Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Insurance Policy Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Details Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Document Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Document Status Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Status Updation/Editing Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Lending Status Updation/Editing Rights', 'guard_name' => 'web']);

        Permission::create(['name' => 'Claim Pre-Assessment Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Final Assessment Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Bill Entry Rights (Including Editing)', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Processing Rights (Including Editing)', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim Authorization Rights', 'guard_name' => 'web']);

        Permission::create(['name' => 'Associate Partner ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Patient ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claim ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Claimant ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Borrower ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Insurance Co. ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'TPA ID Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => '2nd Level Authorization Rights', 'guard_name' => 'web']);
        Permission::create(['name' => "2nd Level Authorization Required (for User's works)", 'guard_name' => 'web']);

        Permission::create(['name' => 'Telephonic Verification Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Physical Verification Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Physical Verification Authorization Rights', 'guard_name' => 'web']);

        Permission::create(['name' => 'Rights to Change Login Password', 'guard_name' => 'web']);
        Permission::create(['name' => 'MIS Access Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Bill Generation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital Activation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Hospital Deactivation Rights', 'guard_name' => 'web']);
        Permission::create(['name' => 'Downloading Rights', 'guard_name' => 'web']);

       

        // Admin Permissions
        Permission::create(['name' => 'Associate Partner Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Insurance Co. Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'TPA Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claims Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Authorization Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'File Management Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Report Generation Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Verification Module Creation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Bill Generation Module Creation/Editing Rights', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Admin Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'User Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Associate Partner Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Patient Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim ID Creation/Claim Intimation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claimant Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Borrower Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Insurance Co. Login ID Creation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'TPA Login ID Creation Rights', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Admin Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'User Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Associate Partner Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital Details Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Patient Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Intimation Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claimant Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Borrower Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Insurance Co. Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'TPA Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Insurance Policy Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Details Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Document Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Document Status Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Status Updation/Editing Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Lending Status Updation/Editing Rights', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Claim Pre-Assessment Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Final Assessment Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Bill Entry Rights (Including Editing)', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Processing Rights (Including Editing)', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Claim Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Associate Partner ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Patient ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claimant ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Borrower ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Insurance Co. ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'TPA ID Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => '2nd Level Authorization Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => "2nd Level Authorization Required (for User's works)", 'guard_name' => 'admin']);

        Permission::create(['name' => 'Telephonic Verification Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Physical Verification Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Physical Verification Authorization Rights', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Rights to Change Login Password', 'guard_name' => 'admin']);
        Permission::create(['name' => 'MIS Access Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Bill Generation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital Activation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Hospital Deactivation Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Downloading Rights', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Pre-assessment Assigning Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Claim Processing Assigning Rights', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Final-assessment Assigning Rights', 'guard_name' => 'admin']);

        $user_permissions = Permission::where('guard_name', 'web')->get();

        foreach($user_permissions as $user_permission){
            $user_role->givePermissionTo($user_permission);
        }

        $admin_permissions = Permission::where('guard_name', 'admin')->get();

        foreach($admin_permissions as $admin_permission){
            $admin_role->givePermissionTo($admin_permission);
        }
    }
}
