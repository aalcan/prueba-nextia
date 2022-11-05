<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        $username = $request->input('username');

        $username_already_register = User::where('username', '=', $username)->get();

        if (count($username_already_register) > 0) {
            abort(500, "Username already register");
        }

        $user = new User([
            'name'     => $request->input('name'),
            'username' => $username,
            'password' => Hash::make($request->input('password')),
        ]);

        if (!$user->save()){
            abort(500, "Can't save the user");
        }

        $token_with_id = $user->createToken($user->id)->plainTextToken;  // UserID|token
        $split_regex   = "/[|,]+/";
        $token_split   = preg_split($split_regex, $token_with_id);       //[UserID, token]

        return [
            "token" => $token_split[1],
            "user"  => $user
        ];

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user();
    }
}
