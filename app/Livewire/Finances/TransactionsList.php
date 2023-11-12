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

        $dateFrom = (empty($this->filterDateFrom)) ? '0000-01-01' : $this->filterDateFrom;
        $dateTo = (empty($this->filterDateTo)) ? '2999-01-01' : $this->filterDateTo;
        $category = (!empty($this->filterCategory)) ? ['category', $this->filterCategory] : ['category', '!=', ''];
        $group = (!empty($this->group)) ? ['group', $this->group] : ['group', '!=', ''];
        $datas = Finances::where('type', $this->type)
        ->orderBy($order_row, $order)
        ->where([$category, $group])
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->paginate(25);

        return $datas;
    }
}
