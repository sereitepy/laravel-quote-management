<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    public function getRandom() {
        try {
            $response = Http::get('https://api.quotable.io/random');
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error'=>'Could not catch any quotes!'], 500);
        }
    }
}
