<?php

namespace App\Http\Controllers;

use App\Models\AccBalance;
use Illuminate\Http\Request;

class AccBalanceController extends Controller
{
    public function index()
    {
        return view('acc-balance', [
            'list' => AccBalance::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create-acc-balance');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $balance = new AccBalance();
        $balance->account_id = $request->account_id;
        $balance->value = $request->value;
        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $balance->created_at = $out;
        $balance->save();

        return redirect()->route('accbalance.index');
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
        return view('forms.create-acc-balance', [
            'edit' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $balance = AccBalance::find($id);
        $balance->account_id = $request->account_id;
        $balance->value = $request->value;
        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $balance->created_at = $out;
        $balance->save();

        return redirect()->route('accbalance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $bal = AccBalance::where('id', $id);
        $bal->delete();

        return redirect()->route('accbalance.index');
    }
}
