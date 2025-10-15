<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminController extends Controller
{
    public function index()
    {
        $comics = Comic::orderBy('id', 'desc')->get();
        return view('admin.dashboard', compact('comics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'type' => 'required|string',
            'status' => 'required|string',
            'age_rating' => 'nullable|string|max:10',
            'synopsis' => 'nullable|string',
            'chapters' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:10',
            'rank' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'cover_banner' => 'nullable|image|mimes:jpg,jpeg,png|max:6144',
        ]);

        $coverImageUrl = null;
        $coverBannerUrl = null;

        // ✅ Upload cover ke Cloudinary (jika ada)
        if ($request->hasFile('cover_image')) {
            $uploaded = Cloudinary::upload(
                $request->file('cover_image')->getRealPath(),
                ['folder' => 'readr/covers']
            );
            $coverImageUrl = $uploaded->getSecurePath();
        }

        // ✅ Upload banner ke Cloudinary (jika ada)
        if ($request->hasFile('cover_banner')) {
            $uploadedBanner = Cloudinary::upload(
                $request->file('cover_banner')->getRealPath(),
                ['folder' => 'readr/banners']
            );
            $coverBannerUrl = $uploadedBanner->getSecurePath();
        }

        // ✅ Simpan data komik ke database
        Comic::create([
            'title' => $request->title,
            'author' => $request->author,
            'type' => $request->type,
            'status' => $request->status,
            'age_rating' => $request->age_rating ?? '13+',
            'synopsis' => $request->synopsis ?? 'No synopsis available.',
            'chapters' => $request->chapters ?? 0,
            'rating' => $request->rating ?? 0.0,
            'rank' => $request->rank ?? 0,
            'cover_image' => $coverImageUrl,
            'cover_banner' => $coverBannerUrl,
        ]);

        // ✅ Redirect kembali ke dashboard
        return redirect()
            ->route('admin.dashboard')
            ->with('success', '✅ Komik berhasil diupload ke Cloudinary!');
    }
}
