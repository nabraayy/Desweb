<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);
    
        $file = $request->file('file');
        $path = $file->store('files', 'public');
    
        $fileModel = new File();
        $fileModel->name = $file->getClientOriginalName();
        $fileModel->path = $path;
        $fileModel->size = $file->getSize();
        $fileModel->user_id = auth()->id;
        $fileModel->save();
    
        return redirect()->back()->with('success', 'File uploaded successfully');
    }
    public function download($id, File $file) {
        $file = File::findOrFail($id);
    
        // Validar autorización
        // $this->$file->authorize('download', $file);
    
        return response()->download(storage_path("app/private/{$file->path}"), $file->name);
    }
    
    
}
