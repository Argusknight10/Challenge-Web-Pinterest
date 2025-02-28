<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $photos = Photo::query()
            ->select('id', 'slug', 'title', 'description','created_at', 'image')
            ->latest();

        if ($request->query('q')) {
            $photos->search($request->query('q'));
        }

        return view('home', [
            'photos' => $photos->paginate(20)->appends($request->query())
        ]);
    }

    public function create()
    {
        return view('home');
    }

    public function store(StorePhotoRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('photos', 'public');
        }

        Photo::create($validatedData);

        return redirect()
            ->route('home')
            ->with('success', 'Artikel berhasil dibuat');
    }

    public function show(Photo $photo)
    {
        return view('show', [
            'photo' => $photo,
        ]);
    }    

    public function edit(Photo $photo)
    {
        return view('home', [
            'photo' => $photo
        ]);
    }

    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $request->validated();

        $validatedData = $request->all();

        if ($validatedData['title'] !== $photo->title) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        if ($request->hasFile('image')) {
            // don't remove if image generate by seeder
            if ($photo->image !== 'photos/photo-test.png') {
                Storage::delete($photo->image);
            }

            $validatedData['image'] = $request->file('image')->store('photos', 'public');
        }

        $photo->update($validatedData);

        return redirect()
            ->route('home')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(Photo $photo)
    {
        Storage::delete($photo->image);
        $photo->delete();
        return redirect()
            ->route('home')
            ->with('success', 'Photo berhasil dihapus');
    }
}

