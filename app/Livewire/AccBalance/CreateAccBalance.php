<?php

namespace App\Livewire\AccBalance;

use App\Models\AccBalance;
use App\Models\AccountList;
use Carbon\Carbon;
use Livewire\Component;

class CreateAccBalance extends Component
{
    public $title;
    public $value;
    public $date;
    public $edit;
    public $showForm;

    public function render()
    {
        if (!empty($this->edit)) {
            $this->fillFormEdit();
        } else {
            $this->date = Carbon::now()->subMonth()->format('Y-m-t');
        }

        return view('livewire.acc-balance.create-acc-balance', [
            'accounts' => AccountList::all(),
        ]);
    }

    public function fillFormEdit()
    {
        $saving = AccBalance::find($this->edit);
        $this->showForm = 1;
        $this->title = $saving->account_id;
        $this->value = $saving->value;
        $this->date = $saving->created_at->format('Y-m-d');
        $this->edit = $saving->id;
    }

    public function check()
    {
        if (!empty($this->title)) {
            $this->showForm = 1;
        } else {
            $this->showForm = '';
        }
    }
}
