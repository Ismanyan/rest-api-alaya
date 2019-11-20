<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time() // Time when JWT was issued. 
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        // Find the user by email & username
        $user = User::where('email', $this->request->input('email'))->where('username', $this->request->input('username'))->first();

        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the 
            // below respose for now.
            return response()->json([
                'error' => 'Email or Username does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $user->password)) {
            $token = $this->jwt($user);
            $user->token = $token;
            $user->save();
            return response()->json([
                'token' => $token
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }

    public function regist(STRING $token = null){
        if ($token == env("TOKEN")) {

            $email = User::where('email', $this->request->input('email'))->first();
            
            if ($email) {
                return response()->json([
                    'error' => 'Email already taken'
                ], 400);
            } else {
                $this->validate($this->request, [
                    'name'      => 'required|string|max:191|min:1',
                    'username'  => 'required|string|max:191|min:1',
                    'email'     => 'required|email|max:191|min:1',
                    'password'  => 'required|string|max:191|min:1',
                    'address'   => 'required|string',
                    'position'  => 'required|string|max:191|min:1',
                    'role'      => 'required|numeric',
                    'branch'    => 'required|string',
                    'pin'       => 'required|numeric|min:1',
                ]);

                $users = User::create([
                    'id'       => null,
                    'name'     => $this->request->input('name'),
                    'username' => $this->request->input('username'),
                    'email'    => $this->request->input('email'),
                    'password' => Hash::make($this->request->input('password')),
                    'address'  => $this->request->input('address'),
                    'branch'   => $this->request->input('branch'),
                    'photo'    => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png',
                    'position' => $this->request->input('position'),
                    'role'     => 1,
                    'pin'      => $this->request->input('pin'),
                    'token'    => null,
                    'created_at' => null,
                    'update_at'  => null
                ]);
                return response()->json($users, 200);
            }
        } else {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

    }

}
