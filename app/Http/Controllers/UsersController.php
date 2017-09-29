<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use Hash;
use Auth;
use JWTAuth;

use App\User;

class UsersController extends Controller
{
  public function signUp(Request $request)
  {
    $rules = [
      /*'userName'=> 'required'*/
      'email'=> 'required'
      'password'=> 'required'
      'firstName'=> 'required'
      'lastName'=> 'required'
      'phone_num'=> 'required'
      'age'=> 'required'

    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all fields.']);
    }/*End If.*/

    /*$username = $request->input('username');*/
    $password = $request->input('password');

    /*checks to see if username already exists.*/
    $duplicate = User::where('email', '=', $email)->select('id')->first();
    if(empty($duplicate))
    {
      $password = Hash::make($password);

      $user = new User;

      /*$user->username = $username;*/
      $user->password = $password;

      $email = $request->input('email');
      $firstName = $request->input('firstName');
      $lastName = $request->input('lastName');
      $phone_num = $request->input('phone_num');
      $email = $request->input('email');
      $address01 = $request->input('address01');
      $address02 = $request->input('address02');
      $city = $request->input('city');
      $state = $request->input('state');
      $zip = $request->input('zip');
      $allow_Contact = $request->input('allow_Contact');

      $users->email = $email;
      $users->firstName = $firstName;
      $users->lastName = $lastName;
      $users->phone_num = $phone_num;
      $users->age = $age;
      $users->address01 = $address01;
      $users->address02 = $address02;
      $users->city = $city;
      $users->state = $state;
      $users->zip = $zip;
      $users->allow_Contact = $allow_Contact;

      $user->save();

      return Response::json(['success' => 'User Signed Up. Welcome Aboard!']);
    }/*End If.*/
    else
    {
      return Response::json(['error' => 'Username Unavailable']);
    }/*End Else. */

  }/*End Function.*/

  public function signIn(Request $request)
  {
    $rules = [
      'email' => 'required',
      'password' => 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if($validator->fails())
    {
      return Response::json(['error' => 'Missing field']);
    }/*End If.*/

    $email = $request->input('email');
    $password = $request->input('password');
    $credentials = compact("email", "password");

    $token = JWTAuth::attempt($credentials);

    if($token ==  false)
    {
      return Response::json(['error' => 'Invalid Credentials']);
    }/*End If.*/
    else
    {
      $user = User::where('email', '=', $email)->first();
      $user->save();
      return Response::json(['token' => $token]);
    }/*End Else.*/
  }/*End Function.*/

  public function getUser()
  {
    $user = Auth::user();
    $user = User::find($user->id);

    return Response::json(['user' => $user]);
  }

  public function signOut()
  {
    $user = Auth::user();
    $user = User::find($user->id);

    $user->save();

    return Response::json(['success' => 'goodbye']);
  }




}/* End Class. */

===================================
