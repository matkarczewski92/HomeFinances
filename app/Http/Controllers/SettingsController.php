<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class SettingsController extends Controller
{
    public function index()
    {
        if (!Gate::allows('admin-level')) {
            abort(403);
        }

        return view('settings');
    }
}
