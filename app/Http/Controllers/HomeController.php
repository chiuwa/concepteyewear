<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use Session;
use App\AskingQuery;
use App\Order;
use App\OrderDetail;
use App\Product;
use DB;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;
use App\mail\OrderShipped;
use App\mail\OrderShippedToAdmin;
use App\mail\EnquireToAdmin;
use App\User;
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

	public static function getOrder() {
		
		if (!Auth::check()) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
		}

		$user = Auth::user();


		$order = Order::with('order_detail')
		->where('status', '<>', 'Complete Order')
		->where('user_id','=',$user->id)
		->get();

		if($order){
			$order =count($order);
		}else{
			$oder = 0 ;
		}

		return $order;					
		exit();
	}

	public static function getCart(){
		
		if (!Auth::check()) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
		}

		$cart = Session::get('cart');

		if($cart){
			$cart =count($cart);
		}else{
			$cart = 0 ;
		}

		return $cart;					
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



	public function about(){

		return view('about');
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
		$images['frame'] = $frames;
		$images['temple'] = $temples;
		$images['len'] = $lens;

		return view('makeOwn', ['lens' => $lens,'frames'=>$frames,'temples'=>$temples,'images'=>$images]);
	}

	public function findOwn(Request $request){


		$validator = Validator::make($request->all(), [
			'len_color_options' => 'bail|required',
			'frame_color_options' => 'bail|required',
			'temple_color_options' => 'bail|required',
		]);

		if (!$validator->passes()) {
			return redirect()->back()->withErrors(['fail' => 'Missing required options']);
		}

		$data = DB::table('product') 
		->join('lens_color','lens_color.id','=','product.lens_type_id')
		->join('lens','lens.id','=','lens_color.len_id')		
		->join('frames_color','frames_color.id','=','product.frames_type_id')
		->join('frames','frames.id','=','frames_color.frames_id')
		->join('temples_color','temples_color.id','=','product.temples_type_id')
		->join('temples','temples.id','=','temples_color.temples_id')
		->where('lens_type_id', '=', $request->len_color_options)
		->where('frames_type_id', '=', $request->frame_color_options)
		->where('temples_type_id', '=', $request->temple_color_options)
		->select('product.*','lens.name_en as lens_name_en','lens.name_zh as lens_name_zh','lens_color.color_image as lens_color','lens_color.color_name as len_color_name','lens_color.image as len_color_image','frames_color.color_image as frames_color','frames.name_en as frames_name_en','frames.name_zh as frames_name_zh','frames_color.color_name as frames_color_name','frames_color.image as frames_color_image','temples_color.color_image as temples_color','temples.name_en as temples_name_en','temples.name_zh as temples_name_zh','temples_color.color_name as temples_color_name','temples_color.image as temples_color_image')	
		->orderBy('id', 'DESC')	
		->get();


		if(!isset($data[0]) ){

			$lens = DB::table('lens_color')
			->where('id','=',$request->len_color_options)
			->first();

			$frames = DB::table('frames_color')
			->where('id','=',$request->frame_color_options)
			->first();

			$temples = DB::table('temples_color')
			->where('id','=',$request->temple_color_options)
			->first();
			if($lens->color_name!==''){
				$l_n = $lens->color_name;
			}else{
				$l_n = 'Lens';
			}
			if($frames->color_name!==''){
				$f_n = $frames->color_name;
			}else{
				$f_n = 'Frames';
			}
			if($temples->color_name!==''){
				$t_n = $temples->color_name;
			}else{
				$t_n = 'Temples';
			}

			$model = new Product();
			$name = $l_n.'-'.$f_n.'-'.$t_n.'_'.'G'.time();
			$model->product_name = $name;
			$model->product_name_en = $name;
			$model->price = 12 ; 
			if(isset($lens->option_price)&&$lens->option_price!=0){
				$model->price = 12 + $lens->option_price ; 
			}
			$model->created_at = date("Y-m-d H:i:s");    
			$model->updated_at = date("Y-m-d H:i:s");    
			$model->product_code = uniqid();
			$model->lens_type_id = $request->len_color_options;
			$model->frames_type_id = $request->frame_color_options;
			$model->temples_type_id = $request->temple_color_options;
			$model->description = 'Make Own Generator Product';
			$model->save();

			$data = DB::table('product') 
			->join('lens_color','lens_color.id','=','product.lens_type_id')
			->join('lens','lens.id','=','lens_color.len_id')		
			->join('frames_color','frames_color.id','=','product.frames_type_id')
			->join('frames','frames.id','=','frames_color.frames_id')
			->join('temples_color','temples_color.id','=','product.temples_type_id')
			->join('temples','temples.id','=','temples_color.temples_id')
			->where('lens_type_id', '=', $request->len_color_options)
			->where('frames_type_id', '=', $request->frame_color_options)
			->where('temples_type_id', '=', $request->temple_color_options)
			->select('product.*','lens.name_en as lens_name_en','lens.name_zh as lens_name_zh','lens_color.color_image as lens_color','lens_color.color_name as len_color_name','lens_color.image as len_color_image','frames_color.color_image as frames_color','frames.name_en as frames_name_en','frames.name_zh as frames_name_zh','frames_color.color_name as frames_color_name','frames_color.image as frames_color_image','temples_color.color_image as temples_color','temples.name_en as temples_name_en','temples.name_zh as temples_name_zh','temples_color.color_name as temples_color_name','temples_color.image as temples_color_image')	
			->orderBy('id', 'DESC')	
			->get();

			$request->session()->put('own_product', $data);
			return redirect()->route('find_out_product');
		}else{
			$request->session()->put('own_product', $data);
			return redirect()->route('find_out_product');

		}
	}

	public function getLensColor(Request $request){
		$data= [] ;
		$data = DB::table('lens_color') 
		//->where('len_id', '=', $request->option)
		->orderBy('sort_order', 'desc')
		->orderBy('updated_at', 'desc')
		->get();

		return $data;

	}


	public function getFramesColor(Request $request){
		$data= [] ;
		$data = DB::table('frames_color') 
		->where('frames_id', '=', $request->option)
		->orderBy('sort_order', 'desc')
		->orderBy('updated_at', 'desc')
		->get();

		return $data;

	}

	public function getTemplesColor(Request $request){
		$data= [] ;
		$data = DB::table('temples_color') 
		//->where('temples_id', '=', $request->option)
		->orderBy('sort_order', 'desc')
		->orderBy('updated_at', 'desc')
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
	

	public function enquire(){


		$files = glob('storage/lookbook/*.*');
		$images = [];
		for($i = 0; $i < count($files); $i++){
			$images[$i] = $files[$i];    
		}
		
		return view('enquire',['images'=>$images]);
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
		$model->query_type = 'standard';
		$model->asking = $request->query_question;
		$model->save();
		if($model->save()){
/*
			$data['name'] =$model->title.' '.$model->name;
			$data['email'] =$model->email;
			$data['id'] =$model->id;
			$data['mobile'] =$model->phone;
			$data['enquire'] =$model->asking;
*/

			//Mail::to('info@cms.com.hk')->queue(new EnquireToAdmin($data));
			
			\Mail::send('emails.to_admin_enquire_email', $admin_offer = ['name' =>$model->title.' '.$model->name, 'email' => $model->email,'id'=>$model->id,'mobile'=>$model->phone,'enquire'=>$model->asking], function ($message) use ($admin_offer) {
				$message->to('info@cem.com.hk')->subject('Enquire By '.'('.$admin_offer['email'].') ');
			});
			
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
				if(isset($value['type']) && $value['type'] =='case' ){
					$data = DB::table('product') 
					->where('product.id', '=', $key)
					->select('product.*','product.id as product_id')
					->first();
				}else{
					$data = DB::table('product') 
					->join('lens_color','lens_color.id','=','product.lens_type_id')
					->where('product.id', '=', $key)
					->select('product.*','lens_color.*','product.id as product_id')
					->first();
				}


				$cart[$key]['id'] = $data->product_id;
				$cart[$key]['product_name'] = $data->product_name;
				$cart[$key]['product_name_en'] = $data->product_name_en;
				$cart[$key]['description'] = $data->description;
				$cart[$key]['price'] = $data->price;
				$cart[$key]['color'] = $data->color;
				$cart[$key]['color_name'] = $data->color_name;

				if(isset($value['type']) && $value['type'] =='case' ){
					$cart[$key]['product_image'] = '';
					if($data->product_image_1!=''){
						$cart[$key]['product_image'] =$data->product_image_1;
					}
				}else{
					if($data->product_image_1!=''){
						$cart[$key]['product_image'] = $data->product_image_1;
					}else{
						$cart[$key]['product_image'] = $data->image;
					}
				}	

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
		$order_number = $this->getOrder();
		return view('user_profile',['user'=>$user,'order_number'=>$order_number]);
	}


	public function order(){

		if (!Auth::check()) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
		}

		$user = Auth::user();
		$order_number = $this->getOrder();

		$order = Order::with('order_detail')
		->with('order_detail.product')
		->leftjoin('users','users.id','=','order.follow_up_user_id')
		->where('order.user_id','=',$user->id)
		->select('order.*','users.name as follow_name')
		->orderby('order.updated_at','DESC')
		->get();

	

		return view('order',['user'=>$user,'order'=>$order,'order_number'=>$order_number]);
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
		$user->address =$request->address;
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

	public function submitOrder(Request $request){

		$user = Auth::user();
		$order = new Order();
		$total_price = 0 ; 
		$total_qty = 0 ; 

		try{
			foreach ($request->cart as $key => $value) {
				$product[$key] = DB::table('product') 
				->where('id', '=', $key)
				->first();

				$total_price = (($product[$key]->price) * (  $value['qty'])) + $total_price;
				$total_qty = $total_qty + $value['qty'];
				if($value['qty'] < 50){
					Session::flash('message', 'Each item min 50 qty'); 
					Session::flash('alert-class', 'alert-danger'); 
					return Redirect::to('shopping_cart')
					->withErrors(['fail' => 'Min 100 total qty for each order']);
				}
				if($product[$key]->product_code == 'eye_glasses_case'){
					if($value['qty'] < 100){
					Session::flash('message', 'Case min 100 qty'); 
					Session::flash('alert-class', 'alert-danger'); 
					return Redirect::to('shopping_cart')
					->withErrors(['fail' => 'Case min 100 qty']);
					}
				}
			}

			if($total_qty < 100){
				Session::flash('message', 'Min 100 total qty for each order'); 
				Session::flash('alert-class', 'alert-danger'); 
				return Redirect::to('shopping_cart')
				->withErrors(['fail' => 'Min 100 total qty for each order']);
			}
			
			$order->user_id = $user->id ; 
			$order->total_price = $total_price ; 
			$order->status = 'In Progress';
			$order->created_at = date('Y-m-d H:i:s');
			$order->updated_at = date('Y-m-d H:i:s');
			$order->save();
			foreach ($request->cart as $key => $value) {
				$order_detail  = new OrderDetail();
				$order_detail->order_id = $order->id;
				$order_detail->product_id = $key ; 
				$order_detail->product_price = $product[$key]->price ; 
				$order_detail->product_qty = $value['qty']; 
				$order_detail->detail_price = (($value['qty'])*($product[$key]->price)); 
				if(isset($value['model_name'])){
					$order_detail->model_name = $value['model_name']; 
				}
				if(isset($value['model_dc'])){
					$order_detail->model_dc = $value['model_dc']; 
				}
				$order_detail->created_at = date('Y-m-d H:i:s');
				$order_detail->updated_at = date('Y-m-d H:i:s');
				$order_detail->save();
			}

			$cart = [];
			$request->session()->put('cart', $cart);

			$order = Order::with('order_detail')
			->with('order_detail.product')
			->leftjoin('users','users.id','=','order.user_id')
			->where('order.id','=',$order->id)
			->where('order.user_id','=',$user->id)
			->select('order.*','users.name as customer_name')
			->first();

			$js_order = json_encode($order->toArray());
/*
			$data['orders'] =$js_order;
			$data['email'] =$user->email;
			$data['order_id'] =$order->id;
			$data['total_price'] =$order->total_price;
			$data['address'] =$user->address;

			Mail::to($user->email)->queue(new OrderShipped($data));

			Mail::to('info@cms.com.hk')->queue(new OrderShippedToAdmin($data));
*/

			\Mail::send('emails.order_email', $offer = ['customer_name'=>$order->customer_name,'email'=>$user->email,'order_id' => $order->id, 'total_price' => $order->total_price,'address'=>$user->address,'orders'=>$js_order], function ($message) use ($offer) {
				$message->to($offer['email'])->subject('Order #'.$offer['order_id']);
			});
			\Mail::send('emails.admin_order_email', $admin_offer = ['email'=>$user->email,'order_id' => $order->id, 'total_price' => $order->total_price,'address'=>$user->address,'orders'=>$js_order], function ($message) use ($admin_offer) {
				$message->to('info@cem.com.hk')->subject('New Order #'.$admin_offer['order_id']);
			});
			

			return Redirect::intended('order');
		}catch(Exception $e){
			return Redirect::back()->with("error",$e->getMessage());
		}
	}



	public function clearAllItem(Request $request){

		$cart = [];
		$request->session()->put('cart', $cart);

		return $cart;
	}



	public function addEyeCase(Request $request){

		$data = DB::table('product') 
		->where('product_code', '=', 'eye_glasses_case')
		->first();
		$item_id = $data->id;
		
		$cart = Session::get('cart');

		if(isset($cart[$item_id])){
			$cart[$item_id]['qty'] = $cart[$item_id]['qty']+50;
		}else{
			$cart[$item_id]['qty'] = 100; 
		}
		$cart[$item_id]['type'] = 'case'; 
		$request->session()->put('cart', $cart);

		return $cart;
	}


	public function updateOrder(Request $request){
		if (!Auth::check()) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
		}
		if(request('receipt_image')==null){
			return Redirect::to('order');
			session()->flash('error', 'Please upload receipt file first');
			//->withErrors(['fail' => 'Please upload receipt file first']);
		}
		try{
			$order_id = request('order_id');
			$imagePath = request('receipt_image')->store("uploads/receipt/{$order_id}", 'public');
			$image = Image::make(public_path("storage/{$imagePath}"))->resize(900, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$image->save(public_path("storage/{$imagePath}"), 60);

			$image->save();
        // Save Purchase Order Data
        // Attach User Data

			$order = DB::table('order') 
			->where('id', '=', $order_id)
			->update(['receipt_image' =>  $imagePath,'status' => 'Under Review']); 


		//session()->flash('success', 'Order Update Success');
        // Redirect Route
			return redirect('order');
		}catch(Exception $e){
			return Redirect::back()->with("error",$e->getMessage());
		}
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
	
	public function order_detail($id){
		if (!Auth::check()) {
			return Redirect::to('home')
			->withErrors(['fail' => 'Please Login First']);
		}

		$user = Auth::user();


		$order = Order::with('order_detail')
		->with('order_detail.product')
		->where('order.id','=',$id)
		->where('order.user_id','=',$user->id)
		->orderby('order.updated_at','DESC')
		->first();


		if(!$order){
			return Redirect::back()->with("error",'Order id error');
		}

		return view('order_detail',['user'=>$user,'order'=>$order]);

	}


	public function productView(Request $request){

		$data = DB::table('product') 
		->where('product.id', '=', $request->product_id)
		->join('lens_color','lens_color.id','=','product.lens_type_id')
		->join('lens','lens.id','=','lens_color.len_id')		
		->join('frames_color','frames_color.id','=','product.frames_type_id')
		->join('frames','frames.id','=','frames_color.frames_id')
		->join('temples_color','temples_color.id','=','product.temples_type_id')
		->join('temples','temples.id','=','temples_color.temples_id')	
		->select('product.*','lens.name_en as lens_name_en','lens.name_zh as lens_name_zh','lens_color.color_image as lens_color','lens_color.color_name as len_color_name','lens_color.image as len_color_image','frames_color.color_image as frames_color','frames.name_en as frames_name_en','frames.name_zh as frames_name_zh','frames_color.color_name as frames_color_name','frames_color.image as frames_color_image','temples_color.color_image as temples_color','temples.name_en as temples_name_en','temples.name_zh as temples_name_zh','temples_color.color_name as temples_color_name','temples_color.image as temples_color_image')	
		->first();


		return json_encode($data);
		exit();

	}
	
	public function forget_pw(){
		
		return view('auth.forget_pw');
	}
	public function goToNewPw(Request $request){
		$user= User::where('users.email', '=', $request->email)
		->first();
		if (!$user){
			return Redirect::back()->withErrors(['fail' => 'With out This Email Data']);
		}else{
			return redirect()->route('password.email', ['email' => $request->email]);
		}

	}
}



