<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
class InstallController extends Controller
{
   public function admin()
   {
      return View('admin.install');
   }
   public function create(Request $request)
   {
      User::create([
           'username' => $request->get('username'),
           'email' => $request->get('email'),
           'password' => bcrypt($request->get('password')),
           'role'=>'admin'
       ]);
       return redirect('install/finish');
   }
    public function finish()
    {
        return View('admin.finish');
    }
}
