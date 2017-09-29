<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use App\Company;
use App\Filter;
use App\Investment;
use App\User;
use App\Role;

class InfoController extends Controller
{
  public function saveInvestmentInfo(Request $request)
  {
    $rules = [
      'userID' => 'required',
      'name' => 'required',
      'age' => 'required',
      'goal' => 'required',
      'amount' => 'required',
      'reoccurring' => 'required',
      'contribution' => 'required',
      'horizon_num' => 'required',
      'horizon_type' => 'required'
    ];
    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all required fields.']);
    }
    $userID = $request->input('userID');
    $name = $request->input('name');
    $age = $request->input('age');
    $goal = $request->input('goal');
    $amount = $request->input('amount');
    $reoccurring = $request->input('reoccurring');
    $contribution = $request->input('contribution');
    $horizon_num = $request->input('horizon_num');
    $horizon_type = $request->input('horizon_type');
    $stocks = $request->input('stocks');
    $options = $request->input('options');
    $exTradeFunds = $request->input('exTradeFunds');
    $secFutures = $request->input('secFutures');
    $bonds = $request->input('bonds');
    $mutualFunds = $request->input('mutualFunds');
    $collegeSavings = $request->input('collegeSavings');
    $commodityFutures = $request->input('commodityFutures');

    $info = new Investment;
    $info->userID = $userID;
    $info->name = $name;
    $info->age = $age;
    $info->goal = $goal;
    $info->amount = $amount;
    $info->reoccurring = $reoccurring;
    $info->contribution = $contribution;
    $info->horizon_num = $horizon_num;
    $info->horizon_type = $horizon_type;
    $info->stocks = $stocks;
    $info->options = $options;
    $info->exTradeFunds = $exTradeFunds;
    $info->secFutures = $secFutures;
    $info->bonds = $bonds;
    $info->mutualFunds = $mutualFunds;
    $info->collegeSavings = $collegeSavings;
    $info->commodityFutures = $commodityFutures;
    $info->save();

    return Response::json(['info' => $info]);
  }

  public function displayResults(Request $request)
  {
    $userID = $request->input('userID');
    $name = $request->input('name');
    $age = $request->input('age');
    $goal = $request->input('goal');
    $amount = $request->input('amount');
    $reoccurring = $request->input('reoccurring');
    $contribution = $request->input('contribution');
    $horizon_num = $request->input('horizon_num');
    $horizon_type = $request->input('horizon_type');

    $stocks = $request->input('stocks');
    $options = $request->input('options');
    $exTradeFunds = $request->input('exTradeFunds');
    $secFutures = $request->input('secFutures');
    $bonds = $request->input('bonds');
    $mutualFunds = $request->input('mutualFunds');
    $collegeSavings = $request->input('collegeSavings');
    $commodityFutures = $request->input('commodityFutures');

    $displayResults = Investment::all();

    if($stocks != NULL) {
      $displayResults->where('stocks', '=', $stocks);
    }

    return Response::json(['displayResults' => $displayResults]);
}

  public function filterResults()
  {


    return Response::json(['filterResults' => $filterResults]);
  }

}
