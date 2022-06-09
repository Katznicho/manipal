<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModel;
use App\Models\User;

class DashBoardController extends Controller
{
    public function index(Request $request){
         $total_users = User::count();
         $total_comments = CommentModel::count();
         $total_approved_comments = CommentModel::where('approved', '=', 1)->count();
        $total_unapproved_comments = CommentModel::where('approved', '=', 0)->count();
        return view('admin.index', compact('total_users','total_comments','total_approved_comments','total_unapproved_comments'));

    }
}
