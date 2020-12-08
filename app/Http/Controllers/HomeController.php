<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use Session;
use App\AskingQuery;
use DB;
use Redirect;
use Auth;
class HomeController extends Controller
{


	public function home(){

		$posts = Post::select('posts.*', 'categories.name', 'posts.id as post_id')
		->join('categories', 'categories.id', '=', 'posts.category_id')
		->where('posts.status', '=', 'PUBLISHED')
		->orderBy('posts.id', 'desc')->get();


           // return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        //}
		
		return view('app', ['posts' => $posts]);
	}
	public static function getCarousel(){
		
		$carousel= DB::table('settings')
		->select('value')
		->where('key', 'like', 'site.carousel%')
		->get();		

		return $carousel;					
		exit();
	}
	
	public function service(){

		return view('service');
	}
	
	public function platform(){

		return view('platform');
	}
	


	public function design(){

		return view('design');
	}



	public function develop(){

		return view('develop');
	}

	public function lookbook(){

		$files = glob('storage/lookbook/*.*');
		$images = [];
		for($i = 0; $i < count($files); $i++){
			$images[$i] = $files[$i];    
		}
		
		return view('lookbook', ['images' => $images]);
	}

	
	public function makeOwn(){

		$lens= DB::table('lens')
		->where('deleted_at', '=', null)
		->get();

		$frames= DB::table('frames')
		->where('deleted_at', '=', null)
		->get();

		$temples= DB::table('temples')
		->where('deleted_at', '=', null)
		->get();

		$images['len'] = $lens;
		$images['frame'] = $frames;
		$images['temple'] = $temples;

		return view('makeOwn', ['lens' => $lens,'frames'=>$frames,'temples'=>$temples,'images'=>$images]);
	}

	public function findOwn(Request $request){
	
		$data = DB::table('product') 
		->join('lens_color','lens_color.id','=','product.lens_type_id')
		->join('lens','lens.id','=','lens_color.len_id')		
		->join('frames_color','frames_color.id','=','product.frames_type_id')
		->join('frames','frames.id','=','frames_color.frames_id')
		->join('temples_color','temples_color.id','=','product.temples_type_id')
		->join('temples','temples.id','=','temples_color.temples_id')
		->where('lens_type_id', '=', $request->len_color_options)
		->where('lens_type_id', '=', $request->len_color_options)
		->where('frames_type_id', '=', $request->frame_color_options)
		->where('temples_type_id', '=', $request->temple_color_options)
		->select('product.*','lens.name_en as lens_name_en','lens.name_zh as lens_name_zh','lens_color.color as lens_color','lens_color.color_name as len_color_name','lens_color.image as len_color_image','frames_color.color as frames_color','frames.name_en as frames_name_en','frames.name_zh as frames_name_zh','frames_color.color_name as frames_color_name','frames_color.image as frames_color_image','temples_color.color as temples_color','temples.name_en as temples_name_en','temples.name_zh as temples_name_zh','temples_color.color_name as temples_color_name','temples_color.image as temples_color_image')	
		->orderBy('id', 'DESC')	
		->get();

		$request->session()->put('own_product', $data);
		return redirect()->route('find_out_product');

	}

	public function getLensColor(Request $request){
		$data= [] ;
		$data = DB::table('lens_color') 
		->where('len_id', '=', $request->option)
		->get();

		return $data;

	}


	public function getFramesColor(Request $request){
		$data= [] ;
		$data = DB::table('frames_color') 
		->where('frames_id', '=', $request->option)
		->get();

		return $data;

	}

		public function getTemplesColor(Request $request){
		$data= [] ;
		$data = DB::table('temples_color') 
		->where('temples_id', '=', $request->option)
		->get();

		return $data;

	}

	public function find_out_product(){
		$data = [];

		$data = Session::get('own_product');

		$files = glob('storage/lookbook/*.*');
		$images = [];
		for($i = 0; $i < count($files); $i++){
			$images[$i] = $files[$i];    
		}
		
		return view('find_out_product',['data'=>$data,'images'=>$images]);
	}
	

	public function contact(){


		return view('contact');
	}
	
	
	public function asking(Request $request){

		$model = new AskingQuery();
		$model->title = $request->title;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->phone = $request->phone;
		$model->asking = $request->query_question;
		$model->save();
		if($model->save()){
			return Redirect::intended('home');
		}else{
			return Redirect::back()->with("modal_message_error", "Submit Error");
		}
	}	


	public function shopping_cart(){

		if (!Auth::check()) {
          return Redirect::to('home')
                ->withErrors(['fail' => 'Please Login First']);
		}
		$cart = Session::get('cart');
		if(isset($cart)){
		foreach ($cart as $key => $value) {
		$data = DB::table('product') 
		->where('id', '=', $key)
		->first();
		$cart[$key]['id'] = $data->id;
		$cart[$key]['product_name'] = $data->product_name;
		$cart[$key]['product_name_en'] = $data->product_name_en;
		$cart[$key]['description'] = $data->description;
		$cart[$key]['price'] = $data->price;
		$cart[$key]['color'] = $data->color;
		$cart[$key]['color_name'] = $data->color_name;
		$cart[$key]['product_image'] = $data->product_image_1;
		}
	}else{
		$cart = [] ; 
	}

		return view('shopping_cart',['cart'=>$cart]);
	}



	public function user_profile(){

		if (!Auth::check()) {
          return Redirect::to('home')
                ->withErrors(['fail' => 'Please Login First']);
		}
	 	$user = Auth::user();
	 

		return view('user_profile',['user'=>$user]);
	}



	public function updateProfile(Request $request){

		if (!Auth::check()) {
          return Redirect::to('home')
                ->withErrors(['fail' => 'Please Login First']);
		}

		$user = Auth::user();
		$user->password = bcrypt($request->get('password'));
		$user->name =$request->name;
		$user->mobile =$request->mobile;
		$user->save();
		return Redirect::back();
	}

	public function addtocart(Request $request){
		$item_id = $request->id;
		$cart = Session::get('cart');

		if(isset($cart[$item_id])){
			$cart[$item_id]['qty'] = $cart[$item_id]['qty']+1;
		}else{
			$cart[$item_id]['qty'] = 1; 
		}
		$request->session()->put('cart', $cart);
			
		return $cart;
	}
	public function clearAllItem(Request $request){

		$cart = [];
		$request->session()->put('cart', $cart);

		return $cart;
	}

	public function plan_asking(Request $request){
		// $this->validate($request, [
            // 'email' => 'required',
            // 'rating' => 'required',
        // ]);
		$model = new AskingQuery();
		$model->title = $request->title;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->phone = $request->area_code.$request->mobile;
		$model->query_type = $request->plan;
		if($request->contact_type =='mobile'){
			$model->asking = 'call customer first';
		}else{
			$model->asking = 'email customer first';
		}
		
		$model->save();
		if($model->save()){
			return Redirect::back()->with("modal_message_success", "Submit Success <br> We will reply to you as soon as possible");
		}else{
			return Redirect::back()->with("modal_message_error", "Submit Error");
		}
	}	
	
}
