<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class UploadHelper
{
    public static function UploadImage(UploadedFile $file,string $folder = 'images',string $disk = 'public')
    {
        //nama unique
        $filename = Str::random(20) .'.'. $file->getClientOriginalExtension();

        //simpan ke public
        return $file->storeAs($folder,$filename,$disk);

    }

    //delete
    public static function deleteFile(?string $path,string $disk = 'public'): void
    {
        if (!empty($path) && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

}


