<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\NoticiaStoreRequest;
use App\Http\Requests\VotoStoreRequest;
use App\Models\Noticia;
use App\Models\Voto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->with('noticias',Noticia::all());
});

Route::get('/enviar', function () {
    return view('enviar');
});


Route::post('/store',function(NoticiaStoreRequest $noticasStoreRequest){
    $noticia= new Noticia();
    $noticia->fill($noticasStoreRequest->validated());
    $noticia->user_id=Auth::id();

    $noticia->save();

    return redirect('/');
});

Route::get('/dashboard', function () {
    return view('dashboard')->with('noticias',Auth::user()->noticias);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/noticia/{noticia}', function(Noticia $noticia){
 return view('show')->with('noticia',$noticia);
});

Route::post('/votar',function(VotoStoreRequest $VotoStoreRequest){
    $VotoStoreRequest->validated();
    $voto=new Voto;
    $voto->noticia_id= $VotoStoreRequest->noticia_id;
    $voto->user_id=Auth::user()->id;

    $voto->save();
    return redirect('/');
});

require __DIR__.'/auth.php';
