<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    public function getRandom()
    {
        try {
            $response = Http::get('https://api.quotable.io/random');
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => 'Could not catch any quotes!',
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ],
                500
            );
        }
    }

    // store the random quotes

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'author' => 'required|string',
        ]);

        $quote = $request->user()->quotes()->create([
            'content' => $request->content,
            'author' => $request->author,
        ]);

        return response()->json($quote, 201);
    }

    // return quotes to authenticated user

    public function index(Request $request)
    {
        $quotes = $request->user()->quotes()->get();
        return response()->json($quotes);
    }

    // delete quotes
    public function destroy(Request $request, $id)
    {
        $quote = $request->user()->quotes()->find($id);

        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        $quote->delete();
        return response()->json(['message' => 'Quote deleted']);
    }
}
