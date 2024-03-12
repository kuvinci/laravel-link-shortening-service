<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            'expiration_hours' => 'required|integer|min:1|max:24',
        ]);

        $shortened = $this->generateUniqueShortUrl(8);

        $expirationHours = $request->input('expiration_hours', 24);
        $expiresAt = now()->addHours($expirationHours);

        Link::create([
            'original_url' => $request->original_url,
            'shortened_url' => $shortened,
            'redirect_limit' => $request->redirect_limit,
            'expires_at' => $expiresAt,
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
            return response()->view('404', [
                'title' => 'Redirect limit reached'
            ], 404);
        }

        if($this->is_expired($link)){
            return response()->view('404', [
                'title' => 'Link Expired'
            ], 404);
        }

        $link->increment('access_count');

        return redirect($link->original_url);
    }

    public function is_limit_reached($link): bool
    {
        if ($link->redirect_limit !== null && $link->access_count >= $link->redirect_limit) {
            return true;
        }

        return false;
    }
    public function is_expired($link): bool
    {
        $carbonExpiresAt = Carbon::parse($link->expires_at);
        if($link->expires_at !== null && $carbonExpiresAt->isPast()){
            return true;
        }

        return false;
    }
}
