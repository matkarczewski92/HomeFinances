<?php

namespace App\Livewire\Budget;

use App\Models\AccBalance;
use App\Models\BudgetPlan;
use App\Models\Category;
use App\Models\Finances;
use Carbon\Carbon;
use Livewire\Component;

class Sheet extends Component
{
    public $compareDate;
    public $compareMonth;

    public function render()
    {
        if (!empty($this->compareDate)) {
            $month = substr($this->compareDate, -2);
            $year = substr($this->compareDate, 0, 4);
            $compareIncome = $this->getFinancesData('i', $month, $year);
            $compareCost = $this->getFinancesData('c', $month, $year);
            $compareIncomeSum = $this->getFinancesSum('i', $month, $year);
            $compareCostSum = $this->getFinancesSum('c', $month, $year);
            $this->compareMonth = $month.'-'.$year;
        }

        return view('livewire.budget.sheet', [
            'incomeCategory' => Category::where('type', 'i')->get(),
            'costCategory' => Category::where('type', 'c')->get(),
            'dataIncome' => $this->getFinancesData('i'),
            'dataCost' => $this->getFinancesData('c'),
            'dataBalance' => $this->getAccBalance(),
            'sumIncome' => $this->getFinancesSum('i'),
            'sumCost' => $this->getFinancesSum('c'),
            'compareIncomeSum' => $compareIncomeSum ?? [],
            'compareCostSum' => $compareCostSum ?? [],
            'compareIncome' => $compareIncome ?? [],
            'compareCost' => $compareCost ?? [],
            'months' => $this->getMonths(),
        ]);
    }

    public function getMonths($month = null, $year = null): array
    {
        if (is_null($month) && is_null($year)) {
            for ($i = -3; $i <= 8; ++$i) {
                $newDateTime = Carbon::now()->addMonths($i)->format('m-Y');
                $dates[] = $newDateTime;
            }
        } else {
            $newDateTime = Carbon::createFromDate($year, $month, 1)->format('m-Y');
            $dates[] = $newDateTime;
        }

        return $dates;
    }

    public function getAccBalance()
    {
        $dates = $this->getMonths();
        foreach ($dates as $date) {
            $newData = Carbon::createFromFormat('m-Y', $date);
            $month = $newData->month;
            $year = $newData->year;
            $return[$date] = $this->lastAccBalance($month, $year);
        }

        return $return;
    }

    public function getFinancesData($type, $month = null, $year = null): array
    {
        $data = Category::where('type', $type)->get();
        if (!is_null($month) && !is_null($year)) {
            foreach ($data as $d) {
                unset($dates);
                $return[$d->id] = $this->getMonths($month, $year);
            }
        } else {
            foreach ($data as $d) {
                unset($dates);
                $return[$d->id] = $this->getMonths();
            }
        }
        foreach ($return as $cat => $value) {
            foreach ($value as $val) {
                $month = substr($val, 0, 2);
                $year = substr($val, -4);
                $dbt[$val] = $this->getFinanceSum($month, $year, $cat, 'category');
            }
            $return[$cat] = $dbt;
        }

        return $return;
    }

    public function getFinancesSum(string $type, $month = null, $year = null): array
    {
        $data = Category::where('type', $type)->get();

        if (!is_null($month) && !is_null($year)) {
            foreach ($data as $d) {
                unset($dates);
                $dates = $this->getMonths($month, $year);
            }
        } else {
            $dates = $this->getMonths();
        }

        foreach ($dates as $val) {
            $month = substr($val, 0, 2);
            $year = substr($val, -4);
            if ($type == 'i') {
                $additional = $this->lastAccBalance($month);
            } else {
                $additional = 0;
            }
            $dbt[$val] = $this->getFinanceSum($month, $year, $type, 'type') + $additional;
        }

        return $dbt;
    }

    public function getFinanceSum(int $month, $year, $category, string $type): int
    {
        $monthNumber = (empty($month)) ? date('m') : $month;
        $month = str_pad($monthNumber, 2, '0', STR_PAD_LEFT);

        $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $firstDayThisMonth = date($year.'-'.$month.'-01');
        $lastDayThisMonth = date($year.'-'.$month.'-'.$lastDay);
        $actualDate = Carbon::now()->format('Y-m');
        $compareDate = $year.'-'.$month;
        $planned = 0;

        if ($compareDate > $actualDate) {
            $planned = BudgetPlan::where($type, $category)->where('exp_date', '>=', $lastDayThisMonth)->where('created_at', '<=', $firstDayThisMonth)->sum('value');
        }

        $period = Finances::where($type, $category)
        ->where(function ($qr) use ($firstDayThisMonth, $lastDayThisMonth, $lastDay) {
            $qr->where(function ($query) use ($firstDayThisMonth, $lastDayThisMonth) {
                $query->where('group', 2)
                ->where(function ($query) use ($firstDayThisMonth, $lastDayThisMonth) {
                    $query->where('created_at', '>=', $firstDayThisMonth)
                    ->where('created_at', '<=', $lastDayThisMonth);
                });
            });
            $qr->orWhere(function ($query) use ($lastDay, $lastDayThisMonth) {
                $query->where(function ($query) {
                    $query->where('group', 1)->orWhere('group', 3);
                })
                ->where('payment_day', '<=', $lastDay)
                ->where('created_at', '<=', $lastDayThisMonth)
                ->where(function ($dateQeury) use ($lastDayThisMonth) {
                    $dateQeury->where('exp_date', '>=', $lastDayThisMonth)
                    ->orWhere('exp_date', '=', null);
                });
            });
        })->sum('value');

        return $period + $planned;
    }

    public function lastAccBalance($currentMonth = null, $currentYear = null)
    {
        $currentMonth = (is_null($currentMonth)) ? Carbon::now()->subMonth()->month : $currentMonth - 1;
        $currentYear = (is_null($currentYear)) ? Carbon::now()->year : $currentYear;
        $return = AccBalance::whereMonth('created_at', $currentMonth)->whereYear('created_at', $currentYear)->sum('value');
        // dd($currentYear);

        return $return;
    }
}
