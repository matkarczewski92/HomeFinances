<?php

namespace App\Livewire\Finances;

use App\Models\Finances;
use Carbon\Carbon;
use Livewire\Component;

class InfoShot extends Component
{
    public $incomeActual;
    public $incomePeriod;
    public $costActual;
    public $costPeriod;
    public $loanActual;
    public $loanPeriod;
    public $budgetActual;
    public $budgetPeriod;

    public function render()
    {
        $this->incomeActual = number_format($this->getSum('i')[0], 2, '.', ',');
        $this->incomePeriod = number_format($this->getSum('i')[1], 2, '.', ',');
        $this->costActual = number_format($this->getSum('c')[0], 2, '.', ',');
        $this->costPeriod = number_format($this->getSum('c')[1], 2, '.', ',');
        $this->loanActual = number_format($this->getSum('l')[0], 2, '.', ',');
        $this->loanPeriod = number_format($this->getSum('l')[1], 2, '.', ',');
        $this->budgetActual = number_format($this->getSum('i')[0] - $this->getSum('c')[0] - $this->getSum('l')[0], 2, '.', ',');
        $this->budgetPeriod = number_format($this->getSum('i')[1] - $this->getSum('c')[1] - $this->getSum('l')[1], 2, '.', ',');

        return view('livewire.finances.info-shot');
    }

    public function getSum(string $type, int $month = null)
    {
        $transactionType = ($type == 'i') ? 'i' : 'c';
        $monthNumber = (empty($month)) ? date('m') : $month;
        $month = str_pad($monthNumber, 2, '0', STR_PAD_LEFT);
        $actualDay = date('d');
        $lastDay = date('t');
        $actualDate = Carbon::now()->format('Y-'.$month.'-d');
        $firstDayThisMonth = date('Y-'.$month.'-01');
        $lastDayThisMonth = date('Y-'.$month.'-t');

        $actual = Finances::where('type', $transactionType)
            ->where(function ($qr) use ($firstDayThisMonth, $actualDate, $actualDay, $type) {
                if ($type != 'l') {
                    $qr->where(function ($query) use ($firstDayThisMonth, $actualDate) {
                        $query->where('group', 2)
                        ->whereBetween('created_at', [$firstDayThisMonth, $actualDate]);
                    });
                }
                if ($type == 'c' or $type == 'i') {
                    $qr->orWhere(function ($query) use ($actualDay, $firstDayThisMonth) {
                        $query->where('group', 1)
                        ->where('payment_day', '<=', $actualDay)
                        ->where('created_at', '<=', $firstDayThisMonth)
                        ->where(function ($dateQeury) use ($firstDayThisMonth) {
                            $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                            ->orWhere('exp_date', '=', null);
                        });
                    });
                }
                if ($type == 'l' or $type == 'i') {
                    $qr->orWhere(function ($query) use ($actualDay, $firstDayThisMonth) {
                        $query->where('group', 3)
                        ->where('payment_day', '<=', $actualDay)
                        ->where('created_at', '<=', $firstDayThisMonth)
                        ->where(function ($dateQeury) use ($firstDayThisMonth) {
                            $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                            ->orWhere('exp_date', '=', null);
                        });
                    });
                }
            })
            ->sum('value');

        $period = Finances::where('type', $transactionType)
        ->where(function ($qr) use ($firstDayThisMonth, $lastDayThisMonth, $lastDay, $type) {
            if ($type != 'l') {
                $qr->where(function ($query) use ($firstDayThisMonth, $lastDayThisMonth) {
                    $query->where('group', 2)
                    ->whereBetween('created_at', [$firstDayThisMonth, $lastDayThisMonth]);
                });
            }
            if ($type == 'c' or $type == 'i') {
                $qr->orWhere(function ($query) use ($lastDay, $firstDayThisMonth, $lastDayThisMonth) {
                    $query->where('group', 1)
                    ->where('payment_day', '<=', $lastDay)
                    ->where('created_at', '<=', $lastDayThisMonth)
                    ->where(function ($dateQeury) use ($firstDayThisMonth) {
                        $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                        ->orWhere('exp_date', '=', null);
                    });
                });
            }
            if ($type == 'l' or $type == 'i') {
                $qr->orWhere(function ($query) use ($lastDay, $firstDayThisMonth, $lastDayThisMonth) {
                    $query->where('group', 3)
                    ->where('payment_day', '<=', $lastDay)
                    ->where('created_at', '<=', $lastDayThisMonth)
                    ->where(function ($dateQeury) use ($firstDayThisMonth) {
                        $dateQeury->where('exp_date', '>', $firstDayThisMonth)
                        ->orWhere('exp_date', '=', null);
                    });
                });
            }
        })
            ->sum('value');

        return [$actual, $period];
    }
}
