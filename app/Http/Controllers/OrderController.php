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
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);
 		//$dataType = Order::where('slug', '=', $slug)->all();
 			if (!Auth::check() && Auth::user()->hasRole('admin')!== 1) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
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
	
}

