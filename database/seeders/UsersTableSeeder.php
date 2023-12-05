<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            'admin_name' => 'adminvu',
            'admin_email' => 'adminvu@gmail.com',
            'admin_phone' => '9573940146',
            'admin_password' => md5('adminvu')
        ]);
        $admin = Admin::create([
            'admin_name' => 'vuauthor',
            'admin_email' => 'vuauthor@gmail.com',
            'admin_phone' => '949203816',
            'admin_password' => md5('vuauthor')
        ]);
        $admin = Admin::create([
            'admin_name' => 'vuuser',
            'admin_email' => 'vuuser@gmail.com',
            'admin_phone' => '489398420301',
            'admin_password' => md5('vuuser')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

        factory(App\Models\Admin::class, 20)->create();
    }
}
