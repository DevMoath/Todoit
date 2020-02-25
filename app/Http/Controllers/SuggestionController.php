<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class SuggestionController extends Controller
{
    public function store()
    {
        Log::alert('suggestion', request()->except('_token'));
        return back()->with('success', __('Thanks for your suggestion 💙'));
    }
}
