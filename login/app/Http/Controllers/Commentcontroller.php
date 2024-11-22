<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Commentcontroller  extends Controller{

    function index(){
        //session()->forget('comments');
        return view('index')
            ->with('superarray', session(('comments')));
    }

    function create(){
        return view('create');
    }

    function store(Request $request){
        session()->push('comments', $request->comentario);
        return redirect('comments');
    }

    function show(string $commentid){
        return view('show')
        -> with('texto',session('comments')[$commentid])
        ->with('id',$commentid)
        
        ;
    }

    function edit(string $commentid){
        return view('edit')
        ->with('cid',session('comments')[$commentid])
        ->with('id', $commentid)
        ;
    }

    function update(Request $request, string $commentid){
        session('comments')[$commentid]=$request->comment;
        session()->put('comments',session('comments'));
        return session('comments');
        ;
    }
    function delete(string $commentid){
        array_splice(session('comments'),$commentid,1);
        return session('comments');
    }


}
