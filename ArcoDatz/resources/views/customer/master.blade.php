<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <nav>@include('customer.nav')</nav>
    <title>Pet Clinic</title>
  @include('layouts.header')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  </head>
  <body>

    <div class="container">@yield('content')</div>
    <!--   <script src="{{ asset('js/app.js') }}" type="text/js"></script> -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
  </body>
</html>
