<?php

namespace App\Livewire\Savings;

use App\Models\Savings;
use Livewire\Component;

class CreateSaving extends Component
{
    public $title;
    public $value;
    public $exp_date;
    public $editId;

    public function render()
    {
        if (isset($_GET['saving'])) {
            $this->fillFormEdit();
        }

        return view('livewire.savings.create-saving');
    }

    public function fillFormEdit()
    {
        $saving = Savings::find($_GET['saving']);

        $this->title = $saving->title;
        $this->value = $saving->value;
        $this->exp_date = $saving->exp_date;
        $this->editId = $saving->id;
    }
}
