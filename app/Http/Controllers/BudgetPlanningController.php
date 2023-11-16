<?php

namespace App\Http\Controllers;

use App\Models\BudgetPlan;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->getData();

        return view('planning', [
            'catArray' => $this->getData(),
            'plans' => BudgetPlan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create-plann');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fn = new BudgetPlan();
        $in = date_create($request->created_at);
        $out = date_create($in->format('Y-m-01'));
        $fn->created_at = $out;
        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $fn->exp_date = $out;
        $fn->title = $request->title;
        $fn->category = $request->category;
        $fn->type = $request->type;
        $fn->value = $request->value;
        $fn->save();

        return redirect()
            ->route('planning.index');
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
        return view('forms.create-plann', [
            'edit' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fn = BudgetPlan::find($id);
        $in = date_create($request->created_at);
        $out = date_create($in->format('Y-m-01'));
        $fn->created_at = $out;

        $in = date_create($request->exp_date);
        $out = date_create($in->format('Y-m-t'));
        $fn->exp_date = $out;
        $fn->category = $request->category;
        $fn->title = $request->title;
        $fn->type = $request->type;
        $fn->value = $request->value;
        $fn->save();

        return redirect()
            ->route('planning.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = BudgetPlan::where('id', $id);
        $plan->delete();

        return redirect()
        ->route('planning.index');
    }

    public function getData()
    {
        $categoriesIncome = Category::where('type', 'i')->get();
        foreach ($categoriesIncome as $type) {
            $income[] = $type;
        }
        $categoriesCost = Category::where('type', 'c')->get();
        foreach ($categoriesCost as $type) {
            $cost[] = $type;
        }
        $types['i'] = $income;
        $types['c'] = $cost;

        return $types;
    }
}
