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
      'userID' => 'required',
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
    $searchCriteria = [];

    $getProducts = Product::leftJoin('companies', 'companyID', '=', 'companies.id');




    if ($riskLevel != NULL) {
      $getProducts->where('products.riskLevel', '=', $riskLevel);
      $searchCriteria[] = $riskLevel;
    }
    if ($minInvestment != NULL) {
      $getProducts->where('products.minInvestment', '<=', $minInvestment);
      $searchCriteria[] = $minInvestment;
    }



    if($isStock != NULL) {
      $getProducts->where('products.isStock', '=', $isStock);
      $searchCriteria[] = 'Stocks';
    }
    if($isBond != NULL) {
      $getProducts->orWhere('products.isBond', '=', $isBond);
      $searchCriteria[] = 'Bonds';
    }
    if($isMutualFund != NULL) {
      $getProducts->orWhere('products.isMutualFund', '=', $isMutualFund);
      $searchCriteria[] = 'Mutual funds';
    }
    if($isETF != NULL) {
      $getProducts->orWhere('products.isETF', '=', $isETF);
      $searchCriteria[] = 'EX Trade funds';
    }
    if($isRetirement != NULL) {
      $getProducts->orWhere('products.isRetirement', '=', $isRetirement);
      $searchCriteria[] = 'Retirement';
    }
    if($isIndexFund != NULL) {
      $getProducts->orWhere('products.isIndexFund', '=', $isIndexFund);
      $searchCriteria[] = 'Index funds';
    }
    $getProducts = $getProducts->select('companies.name', 'companies.description', 'companies.website','products.id', 'products.name', 'products.summary', 'products.riskLevel', 'products.fees', 'products.performance',
    'products.minInvestment', 'products.physicalLocationAvailable', 'products.specialOffersAvailable', 'products.isStock', 'products.isBond', 'products.isMutualFund', 'products.isETF', 'products.isRetirement', 'products.isIndexFund')
    ->orderby('products.name', 'ASC')
    ->get();

    $option = new Option;
    $option->userID = $userID;
    $option->isStock = $isStock;
    $option->isBond = $isBond;
    $option->isMutualFund = $isMutualFund;
    $option->isETF = $isETF;
    $option->isIndexFund = $isIndexFund;
    $option->isRetirement=$isRetirement;
    $option->minInvestment=$minInvestment;
    $option->riskLevel=$riskLevel;
    $option->save();


    if (count($getProducts) > 0){

      return Response::json(['getProducts' => $getProducts, 'userID' => $userID, 'message' => 'Your search options have been saved.', 'messageNum' => '1', 'options' => $option, 'searchCriteria' => $searchCriteria]);
    }
    else {
      return Response::json(['getProducts' => '[]', 'message' => 'We currently have no products that match your search criteria', 'messageNum' => '0', 'options' => $option, 'searchCriteria' => $searchCriteria]);
    }
}

}
