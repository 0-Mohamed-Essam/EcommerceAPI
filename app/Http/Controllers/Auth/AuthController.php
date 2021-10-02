<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
   * Register a new user
   *
   * @param Request $request
   **/
  public function register(Request $request)
  {
    $fields = $request->validate([
      'name' => 'required|string|min:8|max:255|',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|confirmed'
    ]);

    $user = User::create([
      'name' => $fields['name'],
      'email' => $fields['email'],
      'password' => bcrypt($fields['password'])
    ]);

    $token = $user->createToken('token')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token
    ];

    return response($response, 201);
  }

  /**
   * Login an existing user
   *
   * @param Request $request
   **/
  public function login(Request $request)
  {
    $fields = $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    // Check email
    $user = User::where('email', $fields['email'])->first();

    // Check password
    if (!$user || !Hash::check($fields['password'], $user->password)) {
      return response([
        'message' => 'Bad credentials'
      ]);
    }

    $token = $user->createToken('token')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token
    ];

    return response($response, 201);
  }

  /**
   * Logout the user
   *
   * @param Request $request
   * @return  array
   */
  public function logout(Request $request)
  {
    auth()->user()->tokens()->delete();

    return [
      'message' => 'Logged out'
    ];
  }
};
