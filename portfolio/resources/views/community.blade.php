@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'community')
{{-- title로 Login 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main>

<!-- Latest news section -->
<div class="latest-news-section">
    <div class="ln-title">Latest News</div>
    <div class="news-ticker">
        <div class="news-ticker-contant">
            <div class="nt-item"><span class="new">new</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
            <div class="nt-item"><span class="strategy">strategy</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
            <div class="nt-item"><span class="racing">racing</span>Isum dolor sit amet, consectetur adipiscing elit. </div>
        </div>
    </div>
</div>
<!-- Latest news section end -->


<!-- Page info section -->
<section class="page-info-section set-bg" data-setbg="img/page-top-bg/4.jpg">
    <div class="pi-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 text-white">
                    <h2>Our Community</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page info section -->


<!-- Page section -->
<section class="page-section community-page set-bg" data-setbg="img/community-bg.jpg">
    <div class="community-warp spad">
        <div class="container">            
            <ul class="community-post-list">
                <li>
                    <div class="community-post">
                        <form method="POST" action="{{ route('communityboard.store')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Session::get('id') }}">
                            <textarea id="community_content" name="community_content" class="feedback-input" spellcheck="false" autocomplete="off" placeholder="Comment"></textarea>
                            <input type="submit" value="SUBMIT"/>
                        </form>
                    </div>
                </li>
                @forelse ($data as $item)
                <form method="POST" action="{{ route('communityboard.destroy', ['communityboard' => $item->community_id]) }}">
                    @csrf
                    @method('DELETE')
                    <li>
                        <div class="community-post">
                            <div class="author-avator set-bg"></div>
                            <div class="post-content">
                                <h5>{{$item->name}}</h5>
                                <div class="post-date">{{$item->created_at}}</div>
                                <p>{{$item->community_content}}</p>
                            </div>
                            @if(session('id') === $item->user_id)
                            <div class="user-panel-community-container">
                                <div class="user-panel-community">                         
                                    <button>delete</button>              
                                </div>
                                <div class="user-panel-community">  
                                    <button type="button"><a href="{{ route('communityboard.edit', ['communityboard' => $item->community_id]) }}">edit</a></button> 
                                </div>
                            </div>
                            @endif
                        </div>
                    </li>
                </form>
                @empty                    
                @endforelse
            </ul>                         
            <div class="site-pagination sp-style-2">
                <span class="active">01</span>
                <a href="#">02</a>
                <a href="#">03</a>                                               
            </div>                                            
        </div>
    </div>
</section>
<!-- Page section end -->
</main>
@endsection