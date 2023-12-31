<?php

namespace App\Http\Controllers;

use App\Models\Savings;
use Illuminate\Http\Request;

class SavingssController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('savings', [
            'toColect' => Savings::where('colected', null)->get(),
            'colected' => Savings::where('colected', '<>', null)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create-saving');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $saving = new Savings();
        $saving->title = $request->title;
        $saving->value = $request->value;
        $saving->exp_date = $request->exp_date;
        $saving->save();

        return redirect()
            ->route('savings.index');
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
        $saving = Savings::find($id);
        $saving->colected = null;
        $saving->save();

        return redirect()
        ->route('savings.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $saving = Savings::find($id);
        $saving->title = $request->title;
        $saving->value = $request->value;
        $saving->exp_date = $request->exp_date;
        $saving->save();

        return redirect()
        ->route('savings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $saving = Savings::find($id);
        if (is_null($saving->colected)) {
            $saving->colected = 1;
            $saving->save();
        } else {
            $saving->delete();
        }

        return redirect()
        ->route('savings.index');
    }
}
