<?php

namespace App\Livewire\Planning;

use App\Models\BudgetPlan;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\Component;

class CreateForm extends Component
{
    public $formType;
    public $formShow;
    public $formCategory;
    public $dateFrom;
    public $dateTo;
    public $title;
    public $value;
    public $editId;
    public $edit;
    public $dateFromMin;

    public function render()
    {
        if (!empty($this->edit)) {
            $this->edit();
        }

        return view('livewire.planning.create-form', [
            'categories' => $this->type(),
        ]);
    }

    public function edit()
    {
        $tr = BudgetPlan::find($this->edit);
        $this->formCategory = $tr->category;
        $this->formType = $tr->type;
        $this->value = $tr->value;
        $this->title = $tr->title;
        $expDate = Carbon::createFromFormat('Y-m-d', $tr->exp_date)->format('Y-m');
        $this->dateTo = $expDate;
        $this->editId = $this->edit;
        $this->edit = '';
        $dateFrom = Carbon::createFromFormat('Y-m-d H:i:s', $tr->created_at)->format('Y-m');
        $this->dateFrom = $dateFrom;
        $this->formShow = ($this->formCategory) ? 1 : '';
    }

    public function type()
    {
        return Category::where('type', $this->formType)->get();
    }

    public function category()
    {
        $plan = BudgetPlan::where('category', $this->formCategory)->where('type', $this->formType)->orderBy('exp_date', 'desc');
        if (!$this->editId) {
            $plan = $plan->where('id', '<>', $this->editId);
        }
        $planCount = $plan->count();
        $planGetLast = $plan->first();

        if ($planCount != 0 and $planGetLast->exp_date != null) {
            $dateFrom = Carbon::createFromFormat('Y-m-d', $planGetLast->exp_date)->addDay()->format('Y-m');
            if ($this->editId) {
                // $this->dateFrom = $dateFrom;
                // $this->dateTo = $dateFrom;
            }
        }
        $this->formShow = ($this->formCategory) ? 1 : '';
    }
}
