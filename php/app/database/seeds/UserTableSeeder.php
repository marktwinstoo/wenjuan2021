<?php


class UserTableSeeder extends Seeder
{
    public function run(){
        $user = new User;
        $user->username = 'admin';
        $user->email='admin@admin.admin';
        $user->password=Hash::make('123456');
        $user->save();
    }
}