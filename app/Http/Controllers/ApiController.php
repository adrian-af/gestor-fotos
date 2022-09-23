<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Picture;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function users(Request $request)
    {
        if($request->has('email_verified_at'))
        {
            $users = User::where('email_verified_at', true)->get();
        }
        else
        {
            $users = User::all();
        }
        return response()->json($users);
    }
    public function login(Request $request)
    {
        $response = ['status' =>0, 'msg'=>''];
        $data = json_decode($request->getContent());
        $user = User::where('email', $data->email)->first();
        if($user)
        {
            if(Hash::check($data->password, $user->password))
            {
                $token = $user->createToken("example");
                $response['status'] = 1;
                $response['msg'] = $token->plainTextToken;
            }
            else
            {
                $response['msg'] = "Credenciales incorrectas";
            }
        }
        else
        {
            $response['msg'] = "Usuario no encontrado.";
        }
        return response()->json($response);
    }

    public function search(Request $request)
    {
        if(isset($_GET['search']))
        {
            $search = $_GET['search'];
            $pictures = Picture::where('picture_name', 'LIKE', '%' .$search .'%')->get();
            return response()->json($pictures);
        }
        else
        {
            $pictures = Picture::all()->get();
            return response()->json($pictures);
        }

       /*  foreach($pictures as $picture)
        {
            $output .= "<p id='output'>" .$picture->id ."</p>";
            $output .= "<p>" .$picture->picture_name ."</p>";
        } */
        return $search;
    }
}
