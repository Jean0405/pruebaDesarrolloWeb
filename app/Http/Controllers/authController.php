<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class authController extends Controller
{
    public function registerUser(Request $request)
    {
        try {
            // Input data validation
            $data = $request->validate([
                'identification_number' => 'required|unique:users,identification_number',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'location' => 'required|string',
                'type' => 'required|string'
            ]);

            // Create a new user
            $data["password"] = bcrypt($data["identification_number"]);
            $user = User::create($data);

            return response()->json(['status' => 200, 'message' => 'User registered', 'user' => $user]);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json(['status' => $statusCode, 'message' => $e->getMessage()], $statusCode);
        }
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'type' => 'required|string',
            'identification_number' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            if ($user->first_login) {
                $user->update(['first_login' => false]);
                return response(['status' => 200, 'isFirst_login' => true, 'user' => $user, 'token' => $token]);
            } else {
                return response(['status' => 200, 'isFirst_login' => false, 'user' => $user, 'token' => $token]);
            }
        } else {
            return response(["status" => 401, 'message' => 'Unauthorized user']);
        }
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function updateProfile(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response(['status' => 404, 'message' => 'UNon-existent user']);
        }

        $data = $request->validate([
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone_number' => 'sometimes|required|string',
            'location' => 'sometimes|required|string',
            'password' => 'sometimes|required|string',
        ]);

        $user->update($request->only([
            'identification_number',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'location',
            'password',
        ]));

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        return response(['status' => 200, 'message' => 'User has been updated', 'user' => $user]);
    }
}
