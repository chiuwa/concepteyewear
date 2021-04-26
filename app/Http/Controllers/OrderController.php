<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Redirect;
use App\Order;
use Auth;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use Intervention\Image\ImageManagerStatic as Image;
class OrderController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    //...	public function home(){

  public function index(Request $request)
  {

    $slug = $this->getSlug($request);

    if (!Auth::check() || Auth::user()->hasRole('admin')!= '1') {
    return Redirect::back()->with("error",'No Permission');
   }

   $user = Auth::user();

   $dataType = Order::with('order_detail')
   ->with('order_detail.product')
   ->orderby('updated_at','DESC')
   ->get();
       // ->toarray();


		// echo '<pre>';
  //       print_r($dataType);
  //       die();
   $view = 'voyager::bread.browse';

   if (view()->exists("voyager::$slug.browse")) {
    $view = "voyager::$slug.browse";
  }

  return Voyager::view($view, compact(
    'user', 
    'dataType'
  ));
}


public function custom_view()
{
    
  if (!Auth::check() ||   Auth::user()->hasRole('admin') != '1') {
   return Redirect::back()->with("error",'No Permission');
  }
        $user = Auth::user();
        $id = $_GET['id'];

        $dataType = Order::with('order_detail')
        ->where('order.id', '=', $id)
        ->with('order_detail.product')
        ->with('user')
        ->with('customer')
        ->orderby('updated_at','DESC')
        ->first();
       //->toarray();
        if( !isset($dataType)){
           return Redirect::back()->with("error",'Cannot find this order');
        }

   //$view = 'voyager::bread.browse';
     // echo '<pre>';
     //     print_r($dataType);
     //     die();
  return view('/vendor/voyager/order/custom_view', compact('dataType'));
 //return view('order.custom_view', compact('dataType'));
    }
}

