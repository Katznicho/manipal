<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModel;

class WelcomeController extends Controller
{
    //
    public function welcome(){
        $comments= CommentModel::where('approved', '=', true)->get();
        return view('welcome', compact('comments'));
    }


    public function addcomment(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required',
        ]);

        $details =
        [
           'name'=>$request->name,
           'comment'=>$request->comment,
        ];
        $res = CommentModel::create($details);

        return redirect()->route('welcome')
        ->with('success', "comment added  created successfully");


    }
}
