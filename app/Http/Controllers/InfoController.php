<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

class InfoController extends Controller
{
<<<<<<< HEAD
<<<<<<< HEAD
  public function saveOptions(Request $request)
  {
    $rules = [
      'minInvestment'=> 'required',
      'riskLevel'=> 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(['error' => 'Missing fields']);
    }
    /*Test2*/
    $stocks = $request->input('stocks');
    $bonds = $request->input('bonds');
    $mutualFunds = $request->input('mutualFunds');
    $etfs = $request->input('etfs');
    $indexFunds = $request->input('indexFunds');
    $retirement = $request->input('retirement');
    $minInvestment = $request->input('minInvestment');
    $riskLevel = $request->input('riskLevel');

    $options = new Option;

    $options->stocks = $stocks;
    $options->bonds = $bonds;
    $options->mutualFunds = $mutualFunds;
    $options->etfs = $etfs;
    $options->indexFunds = $indexFunds;
    $options->retirement = $retirement;
    $options->minInvestment = $minInvestment;
    $options->riskLevel = $riskLevel;
    $options->save();

    return Response::json(['success' => "Data saved"]);
  }


  public function displayResults()
  {

  }

  public function filterResults()
  {

  }
}
=======
=======
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
  public function store(Request $request)
  {
    $rules = [
      'age'=> 'required'
      'phone'=> 'required'
      'email'=> 'required'
    ];
    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all fields.']);
    }
    $age = $request->input('age');
    $recurring = $request->input('recurring');
    $email = $request->input('email');
    $address01 = $request->input('address01');
    $address02 = $request->input('address02');
    $city = $request->input('city');
    $state = $request->input('state');
    $zip = $request->input('zip');
    $allowContact = $request->input('allowContact');

    $users = new User;

    $users->name = $name;
    $users->phone = $phone;
    $users->email = $email;
    $users->address01 = $address01;
    $users->address02 = $address02;
    $users->city = $city;
    $users->state = $state;
    $users->zip = $zip;
    $users->allowContact = $allowContact;

    $users->save();


    return Response::json(['success' => "Your data was successfully accepted. Welcome Aboard!"]);
  }
}

======================================

?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

//use App\Photo;

class UsersController extends Controller
{

  }
<<<<<<< HEAD
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
=======
>>>>>>> 58e38b6c32ac208efef1f5633f6eab3685d3c39d
