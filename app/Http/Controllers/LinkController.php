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

    public function store(Request $request): \Illuminate\Http\RedirectResponse | null
    {
        $request->validate([
            'original_url' => 'required|url',
            'redirect_limit' => 'integer|min:0',
        ]);

        $shortened = $this->generateUniqueShortUrl(8);

        Link::create([
            'original_url' => $request->original_url,
            'shortened_url' => $shortened,
            'redirect_limit' => $request->redirect_limit
        ]);

        return redirect()->route('link.index')->with([
            'original_url' => $request->original_url,
            'shortened_url'=> $shortened
        ]);
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

        if($this->is_limit_reached($link)){
            return response()->view('limit_reached', [], 404);
        }

        $link->increment('access_count');

        return redirect($link->original_url);
    }

    public function is_limit_reached($link)
    {
        if ($link->redirect_limit !== null && $link->access_count >= $link->redirect_limit) {
            return true;
        }
    }
}
