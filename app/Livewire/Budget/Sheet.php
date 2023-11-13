<?php

namespace App\Livewire\Budget;

use App\Models\Category;
use App\Models\Finances;
use Carbon\Carbon;
use Livewire\Component;

class Sheet extends Component
{
    public function render()
    {
        return view('livewire.budget.sheet', [
            'incomeCategory' => Category::where('type', 'i')->get(),
            'costCategory' => Category::where('type', 'c')->get(),
            'dataIncome' => $this->getFinancesData('i'),
            'dataCost' => $this->getFinancesData('c'),
            'sumIncome' => $this->getFinancesSum('i'),
            'sumCost' => $this->getFinancesSum('c'),
            'months' => $this->getMonths(),
        ]);
    }

    public function getMonths()
    {
        for ($i = -1; $i <= 10; ++$i) {
            $newDateTime = Carbon::now()->addMonths($i)->format('m-Y');
            $dates[] = $newDateTime;
        }

        return $dates;
    }

    public function getFinancesData($type = 'i')
    {
        $data = Category::where('type', $type)->get();

        foreach ($data as $d) {
            unset($dates);
            $return[$d->id] = $this->getMonths();
        }
        foreach ($return as $cat => $value) {
            foreach ($value as $val) {
                $month = substr($val, 0, 2);
                $year = substr($val, -4);
                $dbt[$month] = $this->getFinanceSum($month, $year, $cat, 'category');
            }
            $return[$cat] = $dbt;
        }

        return $return;
    }

    public function getFinancesSum($type = 'i')
    {
        $data = Category::where('type', $type)->get();

        foreach ($data as $d) {
            unset($dates);
            $return[$d->id] = $this->getMonths();
        }
        $dates = $this->getMonths();
        foreach ($dates as $val) {
            $month = substr($val, 0, 2);
            $year = substr($val, -4);
            $dbt[$val] = $this->getFinanceSum($month, $year, $type, 'type');
        }

        return $dbt;
    }

    public function getFinanceSum(int $month, $year, $category, $type)
    {
        $monthNumber = (empty($month)) ? date('m') : $month;
        $month = str_pad($monthNumber, 2, '0', STR_PAD_LEFT);
        $lastDay = date('t');
        $firstDayThisMonth = date($year.'-'.$month.'-01');
        $lastDayThisMonth = date($year.'-'.$month.'-t');

        $period = Finances::where($type, $category)
        ->where(function ($qr) use ($firstDayThisMonth, $lastDayThisMonth, $lastDay) {
            $qr->where(function ($query) use ($firstDayThisMonth, $lastDayThisMonth) {
                $query->where('group', 2)
                ->whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth]);
            });
            $qr->orWhere(function ($query) use ($lastDay, $firstDayThisMonth, $lastDayThisMonth) {
                $query->where('group', 1)
                ->where('payment_day', '<=', $lastDay)
                ->where('created_at', '<=', $lastDayThisMonth)
                ->where(function ($dateQeury) use ($firstDayThisMonth) {
                    $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                    ->orWhere('exp_date', '=', null);
                });
            });
            $qr->orWhere(function ($query) use ($lastDay, $firstDayThisMonth, $lastDayThisMonth) {
                $query->where('group', 3)
                ->where('payment_day', '<=', $lastDay)
                ->where('created_at', '<=', $lastDayThisMonth)
                ->where(function ($dateQeury) use ($firstDayThisMonth) {
                    $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                    ->orWhere('exp_date', '=', null);
                });
            });
        })->sum('value');

        return $period;
    }
}
