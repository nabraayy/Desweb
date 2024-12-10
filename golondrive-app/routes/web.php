<?php

use App\Http\Controllers\FileController;
use App\Models\File as ModelsFile;
use App\Models\File;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

//aqui hacemos las rutas de nuestra querida pagina 
// la primera es de el inicio de la pagina principal que saldra al usuario 

Route::get('/', function () {
    return view('welcome')->with('files', File::all());
})->name('home');

Route::get('/index', function(){
    return view('welcome');
   });

// esta ruta es para la introducción de archivos a la pagina web,
   Route::post('/upload', function(Request $request)
    {      //creacion de un nuevo objeto modelo
     $file= new File();
    
     $file->path=$request->file('uploaded_file')->store();
    
     $file->name=$request->file('uploaded_file')->getClientOriginalName();
     $file->user_id=Auth::user()->id;
    
     $file->save();
    
     return redirect('/');
   

    })->can('upload',File::class);

Route::get('/dowload/{a}', function(File $a){
 
   return Storage::download($a->path,$a->name);

})->name('download');

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

Route::post('/register', function(Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect(route('home', absolute: false));
});

Route::get('/delete/{f}',function(File $f){
    Storage::delete($f->path);
    ModelsFile::destroy($f->id);
    return redirect('/');
})->can('delete','file');

Route::get('logout',function(Request $request){
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});
Route::get('/share',function(Request $request){
    $request->validate(['file_ids' => 'required']);
    return view('share')->with('file',File::find(array_keys($request->file_ids)))
    ->with('users',User::all());
});
Route::middleware(['auth'])->group(function () {
    Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');
    Route::get('/download/{id}', [FileController::class, 'download'])->name('file.download');
});
