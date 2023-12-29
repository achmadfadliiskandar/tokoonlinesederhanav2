<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  </head>
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <style>
    #tempakiri{
      background-color:{{session('sidebar')}}
    }
    .navbar{
      background-color:{{session('navbar')}}
    }
    footer{
      background-color:{{session('footer')}}
    }
    @media only screen and (max-width: 1000px) {
    .offcanvas{
        background-color:{{session('sidebar')}}
    }
  }
  </style>
  <body>
    <!-- bagian body -->
    <div class="container-fluid" id="tampung">
    <div class="row">
    @include("layouts.sidebar")
    <!-- for navbar template admin -->
    @include("layouts.navbar")
<!-- for section -->
<div class="container-fluid">
@yield('section')
</div>
<!-- end section -->
</div>
@include("layouts.footer")
    </div>
  </div>
    </div>
    <!-- bagian body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  </body>
  <script>
    $('#example').DataTable();
  </script>
</html>
