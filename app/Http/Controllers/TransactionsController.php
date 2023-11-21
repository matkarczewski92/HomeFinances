<?php

namespace App\Http\Controllers;

use App\Models\Finances;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create-transaction');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fn = new Finances();
        $fn->category = $request->category;
        $fn->type = $request->type;
        $fn->group = $request->group;
        $fn->title = $request->title;
        $fn->value = $request->value;
        $in = date_create($request->created_at);
        $out = date_create($in->format('Y-m-01'));
        $fn->created_at = ($request->group == 1 or $request->group == 3) ? $out : $request->created_at;
        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $fn->exp_date = ($request->group == 1 or $request->group == 3) ? $out : $request->exp_date;
        $fn->payment_day = $request->payment_day;
        $fn->annotations = $request->annotations;
        $fn->saving = $request->saving;
        $fn->save();

        if ($request->group == 1) {
            $route = 'fixedcosts';
        } elseif ($request->group == 3) {
            $route = 'loans';
        } elseif ($request->group == 4) {
            $route = 'savings.index';
        } elseif ($request->group == 2) {
            $route = match ($request->type) {
                'i' => 'income',
                'c' => 'costs',
            };
        }

        return redirect()
            ->route($route);
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
        return view('forms.create-transaction', [
            'edit' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Finances::find($id);
        $transaction->category = $request->category;
        $transaction->group = $request->group;
        $transaction->saving = $request->saving;
        $transaction->type = $request->type;
        $transaction->value = $request->value;
        $transaction->title = $request->title;
        $transaction->annotations = $request->annotations;
        $transaction->payment_day = $request->payment_day;
        $in = date_create($request->created_at);
        $out = date_create($in->format('Y-m-01'));
        $transaction->created_at = ($request->group == 1 or $request->group == 3) ? $out : $request->created_at;
        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $transaction->exp_date = ($request->group == 1 or $request->group == 3) ? $out : $request->exp_date;
        $transaction->save();
        // dd($request);

        if ($request->group == 1) {
            $route = 'fixedcosts';
        } elseif ($request->group == 3) {
            $route = 'loans';
        } elseif ($request->group == 4) {
            $route = 'savings.index';
        } elseif ($request->group == 2) {
            $route = match ($request->type) {
                'i' => 'income',
                'c' => 'costs',
            };
        }

        return redirect()
            ->route($route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Finances::where('id', $id)->delete();

        return redirect()->back();
    }
}
