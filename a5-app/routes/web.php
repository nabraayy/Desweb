<?php

use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('welcome')
    ->with('fichero', Fichero::all());
});
Route::get('/login',function(){
    return view('login');
});

Route::post('/upload',function(Request $request
){
     
     $fichero= new Fichero();

     $fichero->path=$request->file('uploaded_file')->store();
     $fichero->name=$request->file('uploaded_file')->getClientOriginalName();
     $fichero->user_id =Auth::user()->id;
     $fichero->save();
     return redirect('/');
});
Route::post('login',function(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}
);
Route::get('/logout',function(Request $request){
    
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
});


Route::get('/download/{f}', function(Fichero $f){

    return Storage::download($f->path, $f->name);
});
Route::get('/delete/{f}',function(Fichero $f){
    Storage::delete($f->path);
    Fichero::destroy($f->id);

    return redirect('/');
})->can('delete','fichero');
