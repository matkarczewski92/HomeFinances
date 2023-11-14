<?php

namespace App\Http\Controllers;

use App\Models\Finances;

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
}
