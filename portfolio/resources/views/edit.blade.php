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



<!-- Page section -->
<section class="page-section community-page set-bg" data-setbg="/img/community-bg.jpg">
    <div class="community-warp spad">
        <div class="container">            
            <ul class="community-post-list">
                <li>
                    <div class="community-post">
                        <form method="POST" action="{{ route('communityboard.update', ['communityboard' => $data->community_id])}}">
                            @csrf
							@method('PUT')
                            <textarea id="community_content" name="community_content" class="feedback-input" spellcheck="false" autocomplete="off" placeholder="Comment">{{$data->community_content}}</textarea>
                            <input type="submit" value="UPDATE"/>
                        </form>
                    </div>
                </li>                
            </ul>
        </div>
    </div>
</section>
<!-- Page section end -->
</main>
@endsection