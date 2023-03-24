<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeed extends Seeder
{
    public function getPassword(){
        return bcrypt('123456');

    }

    // /**
    // * "userType": 0,
    // "userName": "SuparAdmin",
    // "fullName": "Super Mate",
    // "gender": "M",
    // "email": "raigen75@gmail.com",
    // "mobileNumber": "01993005578",
    // "passwordUpdated": false,

    public function userSeed(){
        
        $users = [
            [
                'id'=>'6f4c6a76-6785-41ab-b810-448349de43f2',
                'userType'=> 1,
                'userName'=>"superAdmin", 
                'fullName'=>"Super Mate",
                "gender"=>"M",
                "email"=>"raigen75@gmail.com",
                "mobileNumber"=>"01993005578",
                "password"=>self::getPassword()
            ],
            [
                'id'=>'448349de43f2-6785-41ab-b810-6f4c6a76',
                'userType'=> 2,
                'userName'=>"manager", 
                'fullName'=>"User",
                "gender"=>"M",
                "email"=>"something@gmail.com",
                "mobileNumber"=>"01993005578",
                "password"=>self::getPassword()
            ]
        ];
        User::truncate()->insert($users);
        
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->userSeed();
    }
}
