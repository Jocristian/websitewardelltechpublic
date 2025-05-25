<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolio_images', 'public');
        }

        // Simpan data ke DB
        Portfolio::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Hapus file gambar jika ada
        if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()->back()->with('success', 'Portfolio berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url',
            'category' => 'required|in:web,mobile'
        ]);


        // Cek apakah user upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($portfolio->image && Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            // Upload gambar baru
            $portfolio->image = $request->file('image')->store('portfolio_images', 'public');
        }

        // Update data lainnya
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->link = $request->link;
        $portfolio->save();

        return redirect()->back()->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function showMyPortfolios()
        {
            $user = auth()->user();

            // Ambil semua portofolio yang dibuat oleh user yang sedang login
            $portfolios = $user->portfolios()->latest()->get(); // diasumsikan relasi sudah dibuat

            return view('sections.myportfolios', compact('portfolios'));
    }

    public function show($id) {
        $portfolio = Portfolio::findOrFail($id);
        $user = User::find($portfolio->user_id);
        return view('pages.portfoliodetail', compact('portfolio', 'user'));
    }


}
