<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Staffing Management')</title>
    <meta charset='utf-8'>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='/css/staffing.css' type='text/css' rel='stylesheet'>

    @stack('head')
</head>
<body>

@if(session('alert'))
    <div class='flashAlert'>{{ session('alert') }}</div>
@endif

<header>
    <a href='/'><img width="180" height="80" src='/images/project-staffing.jpg' id='logo' alt='Staffing Management'></a>
	 <h2 class="text-capitalize" ><strong>Staffing Management System</strong> </h2>
    @include('modules.nav')
</header>

<section id='main'>
    @yield('content')
</section>

<footer>
    <a href='http://github.com/prashantsmore/p4'><i class="fab fa-github"></i> View on Github</a>
</footer>

@stack('body')

</body>
</html>