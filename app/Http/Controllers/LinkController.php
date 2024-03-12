<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shortened = $this->generateUniqueShortUrl(8);

        Link::create([
            'original_url' => $request->original_url,
            'shortened_url' => $shortened,
        ]);

        return redirect()->route('link.index')->with('shortened_url', url("/{$shortened}"));
    }

    private function generateUniqueShortUrl(int $length): string
    {
        do {
            $shortened = Str::random($length);
        } while (Link::where('shortened_url', $shortened)->count() > 0);

        return $shortened;
    }

    public function show($shortened)
    {
        $link = Link::where('shortened_url', $shortened)->firstOrFail();

        return redirect($link->original_url);
    }
}
