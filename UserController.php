<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //

    public function signup(Request $req){
         //dd($req->all());
           //return response()->json($req->all());
           $name       = $req->input('name');
           $phone      = $req->input('phone');
           $email      = $req->input('email');
           $pass1      = $req->input('pass1');

           $hash       = password_hash($pass1,PASSWORD_DEFAULT);

           $data = [
               'name'   =>$name,
               'phone'  =>$phone,
               'email'  =>$email,
               'pass1'  =>$hash

           ];

           $affectedRows = DB::table('users')->insert($data);
           if($affectedRows == 1)
              return response()->json(['message'=>'success']);
           else 
              return response()->json(['message'=>'error']);

    }

    public function login(Request $req){
          // return response()->json($req->all());
             $user = DB::table('users')->where('email',$req->input('email'))->get();
             if(empty($user[0]))
                return response()->json(['message'=>'user doesnot exists !']);
                else 
             {
                $db_old_hashed_pass = $user[0]->pass1;
                $check = password_verify($req->input('pass1'),$db_old_hashed_pass);
                if($check){
                    //if user loggedIn is successfull
                     $req->session()->put('USER',$user[0]->name);
                     $req->session()->put("USER-ID",$user[0]->user_id);
                     $req->session()->put('login_time',date('d-m-y h:i:sA'));
                     $req->session()->put('IP',$_SERVER['REMOTE_ADDR']);
                     return response()->json(['message'=>'success']);
                }else 
                    return response()->json(['message'=>'Wrong Cridentials !!']);

    }
}

   public function logout(Request $req){
      $req->session()->flush();
      return response()->json(['message'=>'success']);

   }
}

