<header id="header">

    <div class="inner">
        <h1 id="logo">연습 게시판</h1>

        <nav id="nav">
            <ul>
                @auth
                <li class="current_page_item"><a href="#">Home</a></li>
                <li><a href="#">토론장</a></li> 
                {{-- 토론장은 게시판 형식으로 만들기 --}}
                <li><a href="{{route('user.logout.get')}}">로그아웃</a></li>
                @endauth
                @guest
                <li><a href="{{route('user.register.get')}}">회원가입</a></li>
                @endguest
            </ul>
        </nav>
    </div>
    
</header>