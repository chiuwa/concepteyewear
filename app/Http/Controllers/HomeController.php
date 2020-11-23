<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
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

		$images['len'] = $lens;
		$images['frame'] = $frames;

		return view('makeOwn', ['lens' => $lens,'frames'=>$frames,'images'=>$images]);
	}

	public function findOwn(Request $request){
		
		print_r($_POST);
		die();
	}

	public function contact(){


		return view('contact');
	}
	
	
	public function asking(Request $request){

	
		// $this->validate($request, [
            // 'email' => 'required',
            // 'rating' => 'required',
        // ]);
		$model = new AskingQuery();
		$model->title = $request->title;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->phone = $request->phone;
		$model->query_type = $request->query_type_name;
		$model->asking = $request->query_question;
		$model->save();
		if($model->save()){
			return Redirect::back()->with("modal_message_success", "Submit Success <br> We will reply to you as soon as possible");
		}else{
			return Redirect::back()->with("modal_message_error", "Submit Error");
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
	
}
