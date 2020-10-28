<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class FindSisterController extends Controller
{

    public function index(){

        return view('sister.index');

    }
}
