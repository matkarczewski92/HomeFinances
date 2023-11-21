<?php

namespace App\Livewire\Home;

use App\Models\BudgetPlan;
use App\Models\Finances;
use Livewire\Component;

class PlanningStats extends Component
{
    public function render()
    {
        return view('livewire.home.planning-stats', [
            'categories' => $this->getActivPlanning(),
        ]);
    }

    public function getActivPlanning()
    {
        $firstDayThisMonth = date('Y-m-01');
        $lastDayThisMonth = date('Y-m-t');

        $plans = BudgetPlan::where('created_at', '<=', $lastDayThisMonth)->where('exp_date', '>', $firstDayThisMonth)->get();

        foreach ($plans as $p) {
            $details = BudgetPlan::find($p->id);
            $plan = BudgetPlan::where('category', $p->category)->sum('value');
            $period = Finances::where('type', $p->type)->where('category', $p->category)
                ->where('group', 2)
                ->whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth])
                ->sum('value');
            // dd($plans);
            $data[$p->category] = [$details, $plan, $period];
        }

        return $data ?? [];
    }
}
