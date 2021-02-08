<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class AdminController extends Controller
{
    public function index()
    {
        return View('admin.amar');
    }
}
