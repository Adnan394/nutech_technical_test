<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  </head>
  <body style="height: 100vh; overflow-x:hidden">
    <div class="row">
        <div class="col">
            <div class="text-center px-5" style="margin-top: 5%">
                <p class="fw-bold px-x"><i class="bi bi-bag-check-fill me-2"></i>SIMS Web App</p>
                <h3 class="px-5 mb-5">Masuk atau buat akun untuk memulai</h3>
                <form action="{{ route('register.store') }}" method="POST" class="w-100 px-5" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="nama" placeholder="Masukan nama anda" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" placeholder="@ Masukan email anda" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="posisi" placeholder="Masukan Posisi Anda" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" placeholder="Masukan password anda" class="form-control" id="">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <button type="submit" class="btn btn-danger rounded-0 w-100 mb-3">Submit</button>
                    <p class="text-center">Have Account? <a href="{{ route('login') }}">Login</a></p>
                </form>
            </div>
        </div>
        <div class="col p-0" style="width:100%; height: 100vh; background-image: url({{ asset('assets/img/login-frame.png') }}); background-size: cover; background-position: center">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>