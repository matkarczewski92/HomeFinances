<?php

namespace App\Http\Controllers;

use App\Models\Finances;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MapController extends Controller
{
    public function index()
    {
        return view('map', [
            'income' => $this->getMapData($this->getdayArray(), 'i'),
            'cost' => $this->getMapData($this->getdayArray(), 'c'),
            'dateSheet' => $this->getdayArray(),
        ]);
    }

    public function getdayArray(int $month = null, $year = null): array
    {
        $dateC = Carbon::now();
        $year = (empty($year)) ? $year = $dateC->year : $year;
        $month = (empty($month)) ? $month = $dateC->month : $month;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($i = 1; $i <= $daysInMonth; ++$i) {
            $day = sprintf('%02d', $i);
            $array[] = date("Y-$month-$day");
        }

        return $array ?? [];
    }

    public function getFinanceSum(string $date, string $type): float
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $day = $date->day;
        $year = $date->year;
        $month = $date->month;

        $lastDay = date('t');
        $firstDayThisMonth = date($year.'-'.$month.'-01');
        $lastDayThisMonth = date($year.'-'.$month.'-t');
        $date = $date->format('Y-m-d');

        $finances = Finances::where('type', $type)
        ->where(function ($query) use ($date, $lastDayThisMonth, $day) {
            $query->where(function ($qr) use ($date) {
                $qr->where('group', 2)
                ->where('created_at', $date);
            })->orWhere(function ($qr) use ($lastDayThisMonth, $day) {
                $qr->where(function ($query) {
                    $query->where('group', 1)->orWhere('group', 3);
                })
                ->where('payment_day', '=', $day)
                ->where('created_at', '<=', $lastDayThisMonth)
                ->where(function ($dateQeury) use ($lastDayThisMonth) {
                    $dateQeury->where('exp_date', '>=', $lastDayThisMonth)
                    ->orWhere('exp_date', '=', null);
                });
            });
        })
        ->sum('value');

        return (float) $finances;
    }

    public function getFinanceByDay(string $date, string $type): Collection
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $day = $date->day;
        $year = $date->year;
        $month = $date->month;

        $lastDay = date('t');
        $firstDayThisMonth = date($year.'-'.$month.'-01');
        $lastDayThisMonth = date($year.'-'.$month.'-t');
        $date = $date->format('Y-m-d');

        $finances = Finances::where('type', $type)
        ->where(function ($query) use ($date, $lastDayThisMonth, $day) {
            $query->where(function ($qr) use ($date) {
                $qr->where('group', 2)
                ->where('created_at', $date);
            })->orWhere(function ($qr) use ($lastDayThisMonth, $day) {
                $qr->where(function ($query) {
                    $query->where('group', 1)->orWhere('group', 3);
                })
                ->where('payment_day', '=', $day)
                ->where('created_at', '<=', $lastDayThisMonth)
                ->where(function ($dateQeury) use ($lastDayThisMonth) {
                    $dateQeury->where('exp_date', '>=', $lastDayThisMonth)
                    ->orWhere('exp_date', '=', null);
                });
            });
        })
        ->get(['id', 'title', 'value']);

        return $finances;
    }

    public function getMapData($dateArray, string $type): array
    {
        foreach ($dateArray as $date) {
            $value = $this->getFinanceSum($date, $type) ?? 0;
            $finances = $this->getFinanceByDay($date, $type);

            $return[$date] = [$value, $finances];
        }

        return $return;
    }
}
