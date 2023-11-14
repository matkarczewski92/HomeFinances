<?php

namespace App\Http\Controllers;

use App\Models\Finances;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('income', [
            'data' => Finances::where('type', 'i')->where('group', 2)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
