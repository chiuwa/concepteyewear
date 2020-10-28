<?php

namespace App\Http\Controllers;
use App\Ken;

class TestController extends Controller
{
    public function profile(){
		
		$name = Ken::where('username', 'chiuwabbg')
               ->first();
			
		$hotels = $name->username;
		return view('pages.welcome')
            ->with('hotels', $hotels);
	}
	
	public function show()
    {
          $slug = request()->segment(1);
          $page = \TCG\Voyager\Models\Page::where('slug', $slug)
              ->firstOrFail();
      
          return view('pages.show-page', [
              'page' => $page,
          ]);
    }
	
		public function showPost()
    {
          $slug = request()->segment(1);
          $page = \TCG\Voyager\Models\Post::where('slug', $slug)
              ->firstOrFail();
		
          return view('pages.show-page', [
              'page' => $page,
          ]);
    }
}
