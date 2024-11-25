<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  </head>
  <body>
    <div class="alert ntc" role="alert"
        style="opacity: 0; max-width: 300px; width: 100%; float: right; position : fixed; top: 2rem; right: 1rem; z-index: 9999;">
        <span id="msg"> Opps.. something wrong.</span>
    </div>
    
    <section class="d-flex">
      <div class="">
        @include('layouts.sidebar')
      </div>
      <div class="w-100">
        @yield('content')
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function Msg(text, tipe = 'alert-info') {
            $("#msg").text(text);
            $(".ntc")
                .removeClass('alert-info alert-danger alert-success') 
                .addClass(tipe)
                .css('opacity', 1);

            setTimeout(() => {
                $(".ntc").fadeOut(1000, function() {
                    $(this).css('opacity', 0);
                });
            }, 2000);
        }


        if("{{ Session::has('success') }}") {
            Msg('{{ Session::get('success') }}', 'alert-success');
        }
    </script>
  </body>
</html>