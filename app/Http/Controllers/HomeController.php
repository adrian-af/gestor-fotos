<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        $var = $request->search ."<br>";
        return $var;
    }
}
