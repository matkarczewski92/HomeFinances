<?php

namespace App\Livewire\Finances;

use App\Models\Category;
use App\Models\Finances;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $data;
    public $title;
    public $type;
    public $group;
    public $filterDateFrom;
    public $filterDateTo;
    public $filterCategory;

    public function render()
    {
        return view('livewire.finances.transactions-list', [
            'datas' => $this->filter(),
            'categories' => Category::where('type', $this->type)->get(),
        ]);
    }

    public function filter()
    {
        if ($this->group == 1 or $this->group == 3) {
            $order_row = 'payment_day';
            $order = 'asc';
        } else {
            $order_row = 'created_at';
            $order = 'desc';
        }
        $lastDayOfMonth = date('Y-m-t');
        $dateFrom = (empty($this->filterDateFrom)) ? '0000-01-01' : $this->filterDateFrom;
        $dateTo = (empty($this->filterDateTo)) ? '2999-01-01' : $this->filterDateTo;
        $category = (!empty($this->filterCategory)) ? ['category', $this->filterCategory] : ['category', '!=', ''];
        $group = (!empty($this->group)) ? ['group', $this->group] : ['group', '!=', ''];
        $saving = ($this->group == 2) ? ['group', '4'] : ['group', $this->group];
        $savingCat = ($this->group == 2) ? ['category', null] : ['category', '!=', ''];
        $datas = Finances::where('type', $this->type)
        ->orderBy($order_row, $order)
        ->where(function ($query) use ($lastDayOfMonth) {
            $query->where('exp_date', null)
            ->orWhere('exp_date', '>=', $lastDayOfMonth);
        })
        ->where(function ($query) use ($category, $savingCat) {
            $query->where([$category])->orWhere([$savingCat]);
        })
        ->where(function ($query) use ($group, $saving) {
            $query->where([$group])->orWhere([$saving]);
        })
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->paginate(25);

        return $datas;
    }
}
