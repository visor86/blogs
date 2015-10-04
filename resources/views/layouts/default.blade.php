<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css" type="text/css"/>
    <link rel="stylesheet" href="/css/animate.css" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/js/scripts.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
</head>
<body>
<header>
    <div class="row header">
        <div class="row header">
            <div class="c11 header-logo">
                <a href="{{URL::to('/')}}"><img src="/images/logo-header.png" width="166" height="17" alt="Semrush"></a>
            </div>
            <div class="c1 rss">
                <a href=""><img src="/images/rss-logo.png" height="16" width="16" alt="rss">RSS</a>
            </div>
        </div>
    </div>
</header>
<div class="main">
    @yield('content')
</div>
<footer>
    <div class="row">
        <div class="c12">
            <div class="footer-logo">
                <img src="/images/logo-footer.png" width="200" height="20" alt="Semrush">
            </div>
            <div class="footer-copy">
                &copy; 2008–{{ date('Y')  }} SEMrush. All rights reserved.
            </div>
        </div>
    </div>
</footer>
</body>
</html>