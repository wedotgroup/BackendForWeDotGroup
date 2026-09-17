<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>We Dot Group · Admin Panel</title>
  <link rel="icon" type="image/png" href="{{ asset('logo/favicon.PNG') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans antialiased">
  <div class="flex h-screen overflow-hidden">
    @include('layouts.sidebar')
    <div class="flex-1 flex flex-col overflow-hidden">
      @include('layouts.topbar')
      <main class="flex-1 overflow-y-auto p-6 bg-slate-100">
       @yield('content')
      </main>
    </div>
  </div>
@include("layouts.footer")
</body>
</html>
