<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the guests.
     */
    public function index()
    {
        return Guest::all();
    }

    /**
     * Store a newly created guest in storage.
     */
    public function store(Request $request)
    {
        $guest = Guest::create($request->toArray());
        return response()->json($guest, 201);
    }

    /**
     * Display the specified guest.
     */
    public function show(Guest $guest)
    {
        return $guest;
    }

    /**
     * Update the specified guest in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $guest->update($request->toArray());
        return $guest;
    }

    /**
     * Remove the specified guest from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->noContent();
    }
}
