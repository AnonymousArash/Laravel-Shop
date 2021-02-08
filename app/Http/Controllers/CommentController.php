<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $Comment=Comment::orderby('id','DESC')->paginate(10);
        return View('comment.index',['Comment'=>$Comment]);
    }
    public function change_state(Request $request)
    {
      $id=$request->get('id');
        $value=$request->get('value');
        if(DB::table('comment')->where('id',$id)->update(['state'=>$value]))
        {
            if($value==0)
            {
                return 'ok';
            }
            else
            {
                return 'no';
            }
        }
        else
        {
            return 'error';
        }
    }
    public function create(Request $request)
    {
        $Comment=new Comment($request->all());
        $Comment->state=1;
        $Comment->name=Auth::user()->name.' '.Auth::user()->fname;
        $Comment->time=time();
        $Comment->save();

        return redirect()->back();
    }
    public function delete($id)
    {
        DB::table('comment')->where('id',$id)->delete();
        DB::table('comment')->where('parent_id',$id)->delete();
        return redirect()->back();
    }
}
