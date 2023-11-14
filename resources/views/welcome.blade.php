<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HomeFinances</title>
        <script src="https://kit.fontawesome.com/c530abb7f2.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/guest.css'])
    </head>
    <body>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="loginDiv rounded-4 shadow-lg">
            <p class="title-center mt-3">Logowanie</p>
            <div class="mb-3 me-4 ms-4">
              <label for="" class="form-label ">Login</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control shadow" placeholder="" aria-describedby="helpId" required>
            </div>
            <div class="mb-5 me-4 ms-4">
                <label for="" class="form-label">Hasło</label>
                <input type="password" name="password" id="password" class="form-control shadow" placeholder="" aria-describedby="helpId" required>
            </div>
            <div class="d-grid gap-2 m-4 ">
                <button class="btn btn-success shadow" type="submit">Zaloguj</button>
              </div>
          </div>
        </form>
    </body>
</html>
