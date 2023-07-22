<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TodoController extends Controller
{
    public function getAll(){
        $user=DB::table('todos')->get();
        return response()->json($user);
    }
    public function TodoId($id){
        $user=DB::table('todos')->where('todo_id',$id)->get();
        return response()->json($user[0]);
    }
    public function insert(Request $req){
        $affectedRows=DB::table('todos')->insert([
            'title'     =>$req->input('t1'),
            'description'=>$req->input('t2')
        ]);
        if($affectedRows){
            return response()->json(['success' => 'data inserted successfull']);
        }else{
            return response()->json(['error' => 'data not inserted']);
        }
    }
    public function edit($id,Request $req){
        if($req->isMethod('PUT') || $req->isMethod('PATCH')){
            $affectedRows = DB::table('todos')->where('todo_id',$id)->update([
                'title'     => $req->input('t1'),
                'description' => $req->input('t2')
            ]);
            if ($affectedRows) {
                return response()->json(['success' => 'data updated successfull']);
            } else {
                return response()->json(['error' => 'data not updated']);
            }
        }else{
            return response()->json(['message'=>$req.__METHOD__.'is not supported']);
        }
    }
    public function delete($id){
        $affectedRows=DB::table('todos')->where('todo_id',$id)->delete();
        if ($affectedRows) {
            return response()->json(['success' => 'data deleted successfull']);
        } else {
            return response()->json(['error' => 'data not deleted']);
        }
    }
}
