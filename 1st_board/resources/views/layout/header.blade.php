<header id="header">

    <div class="inner">
        <h1 id="logo">연습 게시판</h1>

        <nav id="nav">
            <ul>
                @auth
                <li class="current_page_item"><a href="index.html">Home</a></li>
                <li><a href="#">토론장</a></li>
                @endauth
                <li><a href="{{route('user.login.get')}}">로그인</a></li>
                <li><a href="#">회원가입</a></li>
            </ul>
        </nav>
    </div>
    
</header>