<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUsers(){
        $users = [
            (object)[
                'name' => 'Tuan',
                'email' => 'tuan@mail.com',
            ],
            (object)[
                'name' => 'An',
                'email' => 'an@mail.com',
            ],
        ];
        foreach ($users as $user) {
            $user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt('123456'),
            ]);
            $this->createAPIToken($user);
        }
    }

    public function createAPIToken($user)
    {
      $tokenResult = $user->createToken('Personal Access Token');
      $api_token = $tokenResult->accessToken;
      $token_type = 'Bearer';
      $user->api_token = $api_token;
      $user->token_type = $token_type;
      $user->save();
    }
}
