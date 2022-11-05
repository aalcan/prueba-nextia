<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Create token for user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logIn(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token_with_id = $user->createToken($user->id)->plainTextToken; // UserID|token
        $split_regex = "/[|,]+/";
        $token_split = preg_split($split_regex, $token_with_id); //[UserID, token]
        return [
            'token' => $token_split[1]
        ];
    }

    /**
     * Revoke all user tokens.
     *
     * @return \Illuminate\Http\Response
     */
    public function logOut(Request $request)
    {
        $tokens_delete = $request->user()->tokens()->delete();

        if (!$tokens_delete) {
            abort(500, "Can't revoke tokens");
        }
        return Response('Tokens deleted', 204)->header('Content-Type', 'text/plain');;
    }


}
