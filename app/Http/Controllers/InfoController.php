<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use App\Product;
use App\Option;
use App\Copmany;
use App\RiskLevel;
use App\Package;

class InfoController extends Controller
{

  public function saveSearchData (Request $request){
    $userID = $request->input('userID');
    $riskLevel = $request->input('riskLevel');
    $minInvestment = $request->input('minInvestment');
    $isStock = $request->input('isStock');
    $isBond = $request->input('isBond');
    $isMutualFund = $request->input('isMutualFund');
    $isETF = $request->input('isETF');
    $isRetirement = $request->input('isRetirement');
    $isIndexFund = $request->input('isIndexFund');

    $userID = 1;

    $checkOptions = Option::where('userID', '=', $userID)->first();

    if (!empty($checkOptions)) {
      $temp = Option::where('userID', '=', $userID)
            ->update(['riskLevel' => $riskLevel, 'minInvestment' => $minInvestment, 'isStock' => $isStock, 'isBond' => $isBond, 'isMutualFund' => $isMutualFund, 'isETF' => $isETF, 'isRetirement' => $isRetirement, 'isIndexFund' => $isIndexFund ]);
      return Response::json(['success' => 'Your search criteria has been updated.', 'temp' => $temp]);
    }
    else {
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
      return Response::json(['success' => 'Your search criteria has been saved.']);
    }


  }

  public function collectSearchData(Request $request){
    $userID = $request->input('userID');

    $searchData = Option::where('userID', '=', $userID)->get();

    return Response::json(['searchData' => $searchData]);
  }


  public function getProducts(Request $request, $type, $order, $physLoc, $specOff)
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

    if($physLoc == 1){
      $getProducts->where('products.physicalLocationAvailable', '=', '1');
    }
    if($specOff == 1){
      $getProducts->where('products.specialOffersAvailable', '=', '1');
    }

    $getProducts = $getProducts->select('companies.name', 'companies.description', 'companies.website','products.id', 'products.name', 'products.summary', 'products.riskLevel', 'products.fees', 'products.performance',
    'products.minInvestment', 'products.physicalLocationAvailable', 'products.specialOffersAvailable', 'products.isStock', 'products.isBond', 'products.isMutualFund', 'products.isETF', 'products.isRetirement', 'products.isIndexFund')
    ->orderby('products.'.$type, $order)
    ->get();


    $resultProducts = [];

    foreach($getProducts as $key => $product)
    {
      if($isStock != NULL && $isStock != 0) {
        if($product->isStock == $isStock) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;

          }
          if(!in_array('Stocks', $searchCriteria)) {
            $searchCriteria[] = 'Stocks';
          }
        }
      }
      if($isBond != NULL && $isBond != 0) {
        if($product->isBond == $isBond) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;
          }
          if(!in_array('Bonds', $searchCriteria)) {
            $searchCriteria[] = 'Bonds';
          }
        }
      }
      if($isMutualFund != NULL && $isMutualFund != 0) {
        if($product->isMutualFund == $isMutualFund) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;
          }
          if(!in_array('Mutual funds', $searchCriteria)){
            $searchCriteria[] = 'Mutual funds';
          }
        }
      }
      if($isETF != NULL && $isETF != 0) {
        if($product->isETF == $isETF) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;
          }
          if(!in_array('EX Trade funds', $searchCriteria)){
            $searchCriteria[] = 'EX Trade funds';
          }
        }

      }
      if($isRetirement != NULL && $isRetirement != 0) {
        if($product->isRetirement == $isRetirement) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;
          }
          if(!in_array('Retirement', $searchCriteria)){
            $searchCriteria[] = 'Retirement';
          }
        }

      }
      if($isIndexFund != NULL && $isIndexFund != 0) {
        if($product->isIndexFund == $isIndexFund) {
          if(!in_array($product, $resultProducts)) {
            $resultProducts[] = $product;
            $searchCriteria[] = 'Index funds';
          }
        }

      }
    }


    if (empty($resultProducts)) {
      $resultProducts = $getProducts;
    }


    if (count($resultProducts) > 0){
      return Response::json(['messageNum' => '1', 'searchCriteria' => $searchCriteria, 'resultProducts' => $resultProducts]);
    }
    else {

      return Response::json(['resultProducts' => $resultProducts, 'message' => 'We currently have no products that match your search criteria', 'messageNum' => '0', 'searchCriteria' => $searchCriteria]);
    }
  }

  public function getProducts2(Request $request, $type = "name", $order = "asc")
  {
    $optPackages = Option::select('options.packages')->where('options.userID', '=', '1')->get();
    $optRiskLevel = Option::select('options.riskLevel')->where('options.userID', '=', '1')->get();
    $optMinInv = Option::select('options.minInvestment')->where('options.userID', '=', '1')->get();

    $getPackages = explode(',', $optPackages[0]->packages);
    $getRiskLevel = $optRiskLevel[0]->riskLevel;
    $getMinInv = $optMinInv[0]->minInvestment;

    $showProducts = Product::where('products.riskLevel', '=', $getRiskLevel);

    $showProducts->where('products.isStock', '=', '1');

    $showProducts = $showProducts->where('products.minInvestment', '<=', $getMinInv)
    ->orderby('name', 'asc')->get();





    $getPackages1 = Package::whereIn('packages.id', $getPackages)->get();


    return Response::json(['messageNum' => '1', 'optPackages' => $optPackages[0]->packages, 'optRiskLevel' => $optRiskLevel, '$optMinInv' => $optMinInv, 'getPackages1' => $getPackages1, 'getRiskLevel' => $getRiskLevel, 'getMinInv' => $getMinInv, 'showProducts' => $showProducts]);
  }


}
