<?php

namespace App\Http\Controllers;

use App\Models\Finances;
use Illuminate\Http\Request;

class CostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('costs', [
            'data' => Finances::where('type', 'c')->where('group', 2)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}