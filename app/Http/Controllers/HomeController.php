<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()
            ->select('id', 'slug', 'title', 'image', 'description', 'created_at')
            ->paginate(10);

        return view('home', [
            'title' => 'Home',
            'photos' => $photos
        ]);
    }
}

