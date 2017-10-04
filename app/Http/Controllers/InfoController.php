<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use App\Product;
use App\Option;

class InfoController extends Controller
{
  public function getProducts(Request $request)
  {
    $rules = [
      'minInvestment'=> 'required',
      'riskLevel'=> 'required'
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);
    if($validator->fails())
    {
      return Response::json(['error' => "The fields Risk level and Minimum investmente are required"]);
    }

    $userID = $request->input('userID');
    $riskLevel = $request->input('riskLevel');
    $minInvestment = $request->input('minInvestment');
    $isStock = $request->input('isStock');
    $isBond = $request->input('isBond');
    $isMutualFund = $request->input('isMutualFund');
    $isETF = $request->input('isETF');
    $isRetirement = $request->input('isRetirement');
    $isIndexFund = $request->input('isIndexFund');

    $getProducts = Product::leftJoin('companies', 'companyID', '=', 'companies.id');

    if ($riskLevel != NULL) {
      $getProducts->where('products.riskLevel', '=', $riskLevel);
    }
    if ($minInvestment != NULL) {
      $getProducts->where('products.minInvestment', '<', $minInvestment);
    }
    if($isStock != NULL) {
      $getProducts->where('products.isStock', '=', $isStock);
    }
    if($isBond != NULL) {
      $getProducts->where('products.isBond', '=', $isBond);
    }
    if($isMutualFund != NULL) {
      $getProducts->where('products.isMutualFund', '=', $isMutualFund);
    }
    if($isETF != NULL) {
      $getProducts->where('products.isETF', '=', $isETF);
    }
    if($isRetirement != NULL) {
      $getProducts->where('products.isRetirement', '=', $isRetirement);
    }
    if($isIndexFund != NULL) {
      $getProducts->where('products.isIndexFund', '=', $isIndexFund);
    }
    $getProducts = $getProducts->select('companies.name', 'companies.description', 'companies.website','products.id', 'products.name', 'products.summary', 'products.riskLevel', 'products.fees', 'products.performance',
    'products.minInvestment', 'products.physicalLocationAvailable', 'products.specialOffersAvailable', 'products.isStock', 'products.isBond', 'products.isMutualFund', 'products.isETF', 'products.isRetirement', 'products.isIndexFund')
    ->orderby('products.name', 'ASC')
    ->get();

    $option = new Option;
    $option->userID = $userID;
    $option->stocks = $isStock;
    $option->bonds = $isBond;
    $option->mutualFunds = $isMutualFund;
    $option->exTradeFunds = $isETF;
    $option->indexFunds = $isIndexFund;
    $option->retirement=$isRetirement;
    $option->minInvestment=$minInvestment;
    $option->riskLevel=$riskLevel;
    $option->save();

    return Response::json(['getProducts' => $getProducts, 'userID' => $userID]);
}

}
