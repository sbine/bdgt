<title>bdgt</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('meta-description', 'big finance tools in a small package')">
<meta name="keywords" content="budget,bdgt,app,finance,financial,money">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" type="image/png" href="/favicon.png">

@vite('resources/css/app.css')

@yield('css')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">

<script>window.Locale = "{{ app()->getLocale() }}";</script>
