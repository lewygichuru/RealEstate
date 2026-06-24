<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Facades\Image;
use App\Models\File;
use App\Models\Album;
use App\Models\User;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class GalleryController extends Controller
{

    public function album()
    {
        $albums = Album::latest('created_at')->with('files')->get();

        return view('admin.galleries.album', compact('albums'));
    }


    public function albumStore(Request $request)
    {
        Album::create([
            'title' => $request->name,
            'model_type' => User::class,
            'model_id' => Auth::id(),
            'order' => 0,
        ]);
        return back();
    }


    public function albumGallery(string $id)
    {
        $album_id = $id;

        $galleries = File::latest('created_at')
            ->where('model_type', '=', Album::class, 'and')
            ->where('model_id', '=', $album_id, 'and')
            ->get();

        return view('admin.galleries.gallery',compact('galleries','album_id'));
    }


    public function Gallerystore(Request $request)
    {
        $albumid = $request->input('albumid');

        $files = $request->file('file');

        if ($files) {
            if (!Storage::disk('public')->exists('gallery')) {
                Storage::disk('public')->makeDirectory('gallery');
            }

            $currentDate = Carbon::now()->toDateString();

            foreach ((array) $files as $image) {
                $imagename = 'gallery-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                $imagegallery = (string) Image::read($image)->toJpeg();
                Storage::disk('public')->put('gallery/' . $imagename, $imagegallery);

                File::create([
                    'model_type' => Album::class,
                    'model_id'   => $albumid,
                    'file_name'  => $imagename,
                    'original_name' => $image->getClientOriginalName(),
                    'file_path'  => Storage::url('gallery/' . $imagename),
                    'size'       => $image->getSize(),
                    'mime_type'  => $image->getClientMimeType(),
                ]);
            }
        }

        Toastr::success('message', 'Images uploaded successfully.');

        return back();
    }

}
