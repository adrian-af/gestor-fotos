<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PictureController;

class SearchController extends Controller
{
    public function index()
    {
        $picture = Picture::all();
        return view('pictures.list',["pictures" => Auth::user()->pictures]);
    }
    public function search(Request $request)
    {
        if($request->has('search'))
        {
            $search = $_GET['search'];
            $pictures = Picture::where('name', 'LIKE', '%' .$search .'%')->get();
            //return response()->json($pictures);
            return view('pictures.list', ["pictures" => Auth::user()->pictures]);
        }
        else
        {
            $pictures = Picture::all();
            return view('pictures.list', ["pictures" => Auth::user()->pictures]);
        }

       /*  foreach($pictures as $picture)
        {
            $output .= "<p id='output'>" .$picture->id ."</p>";
            $output .= "<p>" .$picture->picture_name ."</p>";
        } */
        return $search;
    }

}

