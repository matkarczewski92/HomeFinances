<div class="row contentInfoBox">
    <div class="row infoBoxGroup">
        <div class="col-lg-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Dochody', 'acutal' => $incomeActual, 'period' => $incomePeriod])
        </div>
        <div class="col" style="max-width:25px !important; margin-left: -15px;margin-right: -10px; margin-top: 85px">
            <span class="title">-</span>
        </div>
        <div class="col-lg-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Koszty', 'acutal' => $costActual, 'period' => $costPeriod])
        </div>
        <div class="col" style="max-width:25px !important; margin-left: -15px;margin-right: -10px; margin-top: 85px">
            <span class="title">-</span>
        </div>
        <div class="col-lg-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Kredyty', 'acutal' => $loanActual, 'period' => $loanPeriod])
        </div>
        <div class="col" style="max-width:25px !important; margin-left: -15px;margin-right: -10px; margin-top: 85px">
            <span class="title">=</span>
        </div>
        <div class="col-lg-2 col-sm-1 rounded-2 infoBox shadow border border-2 @if ($budgetPeriod<0) border-danger @else border-success @endif">
            @include('components.info-shot-single', ['title' => 'Bilans', 'acutal' => $budgetActual, 'period' => $budgetPeriod])
        </div>
    </div>
  </div>
