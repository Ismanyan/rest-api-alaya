<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */

    //  Show user
    public function show(INT $id = null)
    {
        if ($id !== null) {
            $users = User::find($id);
            if (!$users) {
                return response()->json([
                    'error' => 'User does not exist'
                ], 400);
            } else {
                return response()->json($users, 200);
            }
            
        } else {
            $users = User::all();
            return response()->json($users, 200);
        }
    }

    // Delete user 
    public function delete(INT $id = null)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json([
                'error' => 'User does not exist'
            ], 400);
        } else {
            $users->delete();
            return response()->json($users, 200);
        }   
    }

    // Add User
    public function create(Request $request)
    {

        // Find the user by email & username
        $email = User::where('email', $request->input('email'))->where('username', $request->input('username'))->first();
        
        if ($email) {
            return response()->json([
                'error' => 'Email or username already taken'
            ], 400);
        } else {
            $this->validate($request, [
                'name'     => 'required|string|max:191|min:1',
                'username' => 'required|string|max:191|min:1',
                'email'    => 'required|email|max:191|min:1',
                'password' => 'required|string|max:191|min:1',
                'address'  => 'required|string',
                'position' => 'required|string|max:191|min:1',
                'role'     => 'required|numeric',
                'branch'   => 'required|string',
                'pin'      => 'required|numeric|min:1',
            ]);

            $users = User::create([
                'id' => null,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'branch' => $request->branch,
                'photo' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png',
                'position' => $request->position,
                'role' => 1,
                'pin' => $request->pin,
                'token' => null,
                'created_at' => null,
                'update_at' => null
            ]);

            return response()->json($users, 200);
        }
    }

    // Edit User
    public function edit(INT $id = null, Request $request)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json([
                'error' => 'User does not exist'
            ], 400);
        } else {
            // Find the user by email & username
            $email = User::where('email', $request->input('email'))->where('username', $request->input('username'))->first();
        
            if ($email) {
                return response()->json([
                    'error' => 'Email or username already taken'
                ], 400);
            } else {
                $this->validate($request, [
                    'name'      => 'required|string|max:191|min:1',
                    'username' => 'required|string|max:191|min:1',
                    'email'     => 'required|email|max:191|min:1',
                    'password'  => 'required|string|max:191|min:1',
                    'address'   => 'required|string',
                    'position'  => 'required|string|max:191|min:1',
                    'role'      => 'required|numeric',
                    'branch'    => 'required|string',
                    'pin'       => 'required|numeric|min:1',
                ]);
                
                $users->name = $request->input('name');
                $users->username = $request->input('username');
                $users->email = $request->input('email');
                $users->password = $request->input('password');
                $users->address = $request->input('address');
                $users->branch = $request->input('branch');
                $users->photo = $request->input('photo');
                $users->position = $request->input('position');
                $users->role = $request->input('role');
                $users->pin = $request->input('pin');
                $users->save();
                
                return response()->json($users, 200);
            }
        }
        
    }

}
