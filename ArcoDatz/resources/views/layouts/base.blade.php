<!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title></title>
 </head>
 <body>
   
 @yield('body')
 @include('layouts.header')
 <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
<!-- {{--  <script src="{{ mix('js/app.js') }}"></script> --}} -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
 </body>
 </html>