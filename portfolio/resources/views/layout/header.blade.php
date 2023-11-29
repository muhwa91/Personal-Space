<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header section -->
<header class="header-section">
    <div class="container">
        <!-- logo -->
        <a class="site-logo" href="index.html">
            <img src="img/logo.png" alt="">
        </a>
        <div class="user-panel">
            @guest
            <a href="{{ route('login.get') }}">Login</a>  /  <a href="{{ route('register.get') }}">Register</a>                
            @endguest
            @auth
            <a href="{{ route('logout.get') }}">Logout</a>
            @endauth
        </div>
        <!-- responsive -->
        <div class="nav-switch">
            <i class="fa fa-bars"></i>
        </div>
        <!-- site menu -->
        <nav class="main-menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('games.link.get') }}">Games</a></li>
                <li><a href="{{ route('blog.link.get') }}">Blog</a></li>
                <li><a href="{{ route('forums.link.get') }}">Forums</a></li>
                <li><a href="{{ route('contact.link.get') }}">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
<!-- Header section end -->