<nav class="d-flex flex-column vh-100 flex-shrink-0 p-3  shadow-lg" style="width: 250px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto  text-decoration-none">
      <svg class="bi me-2" width="40" height="32"> </svg> <span class="fs-4 title">Home<sub>Finances</sub></span></a><hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ (request()->segment(1) == 'home' || request()->segment(1) == '') ? 'active' : '' }}" aria-current="page">
            <i class="bi bi-house"></i><span class="ms-2 ">Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('income') }}" class="nav-link {{ (request()->segment(1) == 'income') ? 'active' : '' }}">
            <i class="bi bi-feather"></i><span class="ms-2">Dochody</span>
          </a>
        </li>
        <li>
            <a href="{{ route('costs') }}" class="nav-link {{ (request()->segment(1) == 'costs') ? 'active' : ''}}">
                <i class="bi bi-cash"></i><span class="ms-2">Koszty</span>
            </a>
        </li>
        <hr>
        <li>
            <a href="{{ route('loans') }}" class="nav-link {{ (request()->segment(1) == 'loans') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i><span class="ms-2">Kredyty</span>
            </a>
        </li>
        <li>
            <a href="{{ route('fixedcosts') }}" class="nav-link {{ (request()->segment(1) == 'fixedcosts')  ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i><span class="ms-2">Cykliczne</span>
            </a>
        </li>
        <hr>
        <li>
          <a href="{{ route('savings.index') }}" class="nav-link {{ (request()->segment(1) == 'savings') ? 'active' : '' }}">
            <i class="bi bi-piggy-bank"></i><span class="ms-2">Oszczędności</span>
          </a>
        </li>
        <li>
          <a href="{{ route('budget') }}" class="nav-link {{ (request()->segment(1) == 'budget') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i><span class="ms-2">Budżet</span>
          </a>
        </li>
        <li>
          <a href="{{ route('map') }}" class="nav-link {{ (request()->segment(1) == 'map') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i><span class="ms-2">Mapa</span>
          </a>
        </li>
      </ul>
          <hr>
          <div class="dropdown text-center">
            <a href="#" class=" align-items-center text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ Auth::user()?->avatar }}" alt="" width="136" height="136" class="rounded-circle me-2"> <br>
              <strong> {{ ucfirst(Auth::user()?->name) }} </strong><br/>
              @can('admin-level')<small>Administrator</small>@endcan
            </a>

            <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1">
              <li>
                <a class="dropdown-item" href="#">Profile</a>
              </li>
              @can('admin-level')
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('settings') }}">Ustawienia</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Użytkownicy</a>
              </li>
              @endcan
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   Wyloguj
               </a>
              </li>
            </ul>

          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>

  </nav>
