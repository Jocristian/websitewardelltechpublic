<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostServicesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'overview' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category' => 'required|in:mobile,web',
        ]);

        // Simpan gambar
        $photoPath = $request->file('photo')->store('service_photos', 'public');

        // Simpan data ke DB
        Service::create([
            'user_id' => Auth::id(),
            'price' => $request->price,
            'overview' => $request->overview,
            'description' => $request->description,
            'category' => $request->category,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Service berhasil ditambahkan!');
    }
}
