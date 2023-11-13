<div class="row contentInfoBox">
    <div class="row infoBoxGroup">
        <div class="col-xl-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Dochody', 'acutal' => $incomeActual, 'period' => $incomePeriod])
        </div>
        <div class="col-xl-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Koszty', 'acutal' => $costActual, 'period' => $costPeriod])
        </div>
        <div class="col-xl-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Kredyty', 'acutal' => $loanActual, 'period' => $loanPeriod])
        </div>
        <div class="col-xl-2 col-sm-1 rounded-2 infoBox shadow">
            @include('components.info-shot-single', ['title' => 'Bilans', 'acutal' => $budgetActual, 'period' => $budgetPeriod])
        </div>
    </div>
  </div>
