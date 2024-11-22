<?php

use App\Models\Files;
use Faker\Core\File;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

//aqui hacemos las rutas de nuestra querida pagina 
// la primera es de el inicio de la pagina principal que saldra al usuario 

Route::get('/', function () {
    return view('welcome')->with('files', Files::all());
});

Route::get('/index', function(){
    return view('welcome');
   });

// esta ruta es para la introducción de archivos a la pagina web,
Route::post('/upload', function(Request $request)
{      //creacion de un nuevo objeto modelo
    $file= new Files();
    //gestionamos el archivo recibido, accedemos al archivo enviado en el formulario con el nombre indicado, con el metodo store guardamos en el amacen. este metodo devuleve la ruta relativa del archivo almacenado
    $file->path=$request->file('uploaded_file')->store();
    
    $file->name=$request->file('uploaded_file')->getClientOriginalName();
    $file->user_id=Auth::user()->id;
    //guardamos en la base de datos
    $file->save();
    //lo redirigimos a la pagina principal
    return redirect('/');
   
});

Route::post('/dowload/{a}', function(Files $a){
    return Storage::download($a->path,$a->name);
});

Route::get('/login', function(){
    return view('login');
});

Route::post('/login', function(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' =>['required'],
    ]);
    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records',
    ])->onlyInput('email');
});

Route::get('/register',function(){
    return view('register');
});

Route::get('/delete/{f}',function(Files $f){
    Storage::delete($f->path);
    Files::destroy($f->id);
})->can('delete','file');

Route::get('logout',function(Request $request){
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});