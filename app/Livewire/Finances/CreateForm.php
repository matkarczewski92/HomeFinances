<?php

namespace App\Livewire\Finances;

use App\Models\Category;
use App\Models\Finances;
use App\Models\Group;
use App\Models\Savings;
use Carbon\Carbon;
use Livewire\Component;

class CreateForm extends Component
{
    public $formType;
    public $formCategory;
    public $formGroup;
    public $formSavings;
    public $formSavingsShow;
    public $formShow;
    public $date;
    public $edit;
    public $editId;
    public $title;
    public $annotations;
    public $value;
    public $payment_day;

    public function render()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        if (!empty($this->edit)) {
            $this->edit();
        }
        if (isset($_GET['saving'])) {
            $this->savingFillForm();
        }

        return view('livewire.finances.create-form', [
            'categories' => $this->type(),
            'groups' => Group::all(),
            'savings' => Savings::all(),
        ]);
    }

    public function edit()
    {
        $tr = Finances::find($this->edit);
        $this->formGroup = $tr->group;
        $this->formCategory = $tr->category;
        $this->formType = $tr->type;
        $this->formSavings = $tr->saving;
        if (!empty($tr->saving)) {
            $this->formSavingsShow = 1;
        }
        $this->title = $tr->title;
        $this->date = $tr->created_at->format('Y-m-d');
        $this->annotations = $tr->annotations;
        $this->value = $tr->value;
        $this->payment_day = $tr->payment_day;
        $this->editId = $this->edit;
        $this->edit = '';
    }

    public function group()
    {
        if ($this->formGroup == 4) {
            $this->formSavingsShow = 1;
            $this->formCategory = '';
        } else {
            $this->formSavings = '';
            $this->formSavingsShow = '';
        }
    }

    public function type()
    {
        return Category::where('type', $this->formType)->get();
    }

    public function category()
    {
        $this->formShow = ($this->formCategory) ? 1 : '';
    }

    public function savings()
    {
        $this->formShow = 1;
    }

    public function savingFillForm()
    {
        $saving = Savings::find($_GET['saving']);
        $this->formGroup = 4;
        $this->formType = 'c';
        $this->formSavingsShow = 1;
        $this->formSavings = $_GET['saving'];
    }
}
