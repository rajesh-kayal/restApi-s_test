<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiControlle extends Controller
{
    public function getAll(){
        $users= DB::table('_api_users')
                        ->get(); //select * FROM _api_users;
        return response()->json([$users]);
    }
    public function insert(Request $req){
        $users=DB::table('_api_users')->insert([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'phone' =>$req->input('phone'),
            'address' => $req->input('address'),
        ]);
        if($users){
            return response()->json(['message'=>'data inserted successfully']);
        }else{
            return response()->json(['message' => 'data not inserted']);
        }
    }
    public function getId($id){
        $usersId=DB::table('_api_users')->where('id',$id)->get();
        return response()->json($usersId[0]);
    }
    public function edit($id,Request $req){
        if($req->isMethod('put') || $req->isMethod('patch')){
            $users = DB::table('_api_users')->where('id',$id)->update([
                'name' => $req->input('name'),
                'email' => $req->input('email'),
                'phone' => $req->input('phone'),
                'address' => $req->input('address'),
            ]);
            if ($users) {
                return response()->json(['message' => 'data updated successfully']);
            } else {
                return response()->json(['message' => 'data not updated']);
            }
        }else{
            return response()->json(['message' => $req->__METHOD__ . ' is not supported for this route']);
        }
    }
    public function delete($id,Request $req){
        if($req->isMethod('delete')){
            //start delete
            $affectedRows = DB::table('_api_users')->where('id', $id)->delete();
            if ($affectedRows) {
                return response()->json(['message' => 'user data deleted successfully']);
            } else {
                return response()->json(['message' => 'user data not deleted']);
            }
            //end delete
            //extra
        }else{
            return response()->json(['message' => $req->__METHOD__ . ' is not supported for this route']);
        }
    }
}
