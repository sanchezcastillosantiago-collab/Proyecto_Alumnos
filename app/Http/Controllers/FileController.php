<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = FileUpload::orderBy('created_at', 'desc')->get();
        return view('files.index-files', compact('files'));
    }

    public function create()
    {
        return view('files.upload-files');
    }

    public function store(StoreFileRequest $request)
    {
        $saved = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('uploads', 'public');
            $record = FileUpload::create([
                'user_id' => auth()->id(),
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
            $saved[] = $record;
        }

        return redirect()->route('files.index')->with('success', 'Archivos subidos correctamente.');
    }

    public function download(FileUpload $file)
    {
        if (!Storage::disk('public')->exists($file->path)) {
            abort(404);
        }
        return Storage::disk('public')->download($file->path, $file->original_name);
    }

    public function destroy(FileUpload $file)
    {
        // remove storage
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }
        $file->delete();
        return redirect()->route('files.index')->with('success', 'Archivo eliminado.');
    }

    public function replace(Request $request, FileUpload $file)
    {
        $request->validate(['file' => 'required|file|max:51200']);

        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $new = $request->file('file');
        $path = $new->store('uploads', 'public');
        $file->update([
            'original_name' => $new->getClientOriginalName(),
            'path' => $path,
            'mime' => $new->getClientMimeType(),
            'size' => $new->getSize(),
        ]);

        return redirect()->route('files.index')->with('success', 'Archivo reemplazado.');
    }
}
