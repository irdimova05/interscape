<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function createFile($request, $folderName)
    {
        $file = $request->file('file');
        $path = Storage::disk('public')->putFile($folderName, $file);
        return File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'user_id' => auth()->user()->id,
        ])->id;
    }
}
