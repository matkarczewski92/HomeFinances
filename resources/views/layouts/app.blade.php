<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HomeFinances</title>
        <script src="https://kit.fontawesome.com/c530abb7f2.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous" defer></script>


        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navbar.css'])
  </head>
  <body>
    @include('layouts.nav')
    <main class="py-4 me-3 ">
        <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 " style="margin-left: -20px;position: fixed;top: 0px;width:50px;z-index:10;background-image: linear-gradient(0.75turn,rgba(255, 82, 47, 0)   ,rgba(255, 82, 47, 0)   , rgba(87, 87, 87, 0.294));">
            <div  style="position: absolute;top: 50%;width: 100%; margin-left:5px">
                <a href="{{url()->previous()}}"><i class="fa-solid fa-chevron-left fa-2xl" style="color: gray"></i></a>
            </div>
        </div>

        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </main>
  </body>
</html>
