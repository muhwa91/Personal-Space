@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'Main')
{{-- title로 Login 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main>
    <!-- Banner -->
    <div id="banner">
        <h2><strong>LEAGUE</strong> of <br><strong>LEGENDS</strong></h2><br>							
        <a href="#" class="button large icon solid fa-check-circle">무료로 플레이하기</a>
    </div>

    <!-- Main Wrapper -->
    <div id="main-wrapper">					
        <div class="wrapper style2">
            <div class="inner">
                <!-- Feature 2 -->
                <section class="container box feature2">
                    <div class="row">
                        <div class="col-6 col-12-medium">
                            <section>
                                <header class="major">
                                    <h2>별 수호자 지난 이야기</h2>
                                    <p>세상이 시작될 때 태초의 별이 우주와 온 생명을 창조했습니다.</p>
                                </header>
                                <p>매력적인 별 수호자들은 살아있는 초신성처럼 신비한 힘으로 우주에 존재하는 공포의 존재를 쳐부숩니다. 
                                하지만 환상적인 힘에는 대가가 있습니다. 
                                별 수호자들은 태초의 별의 의지를 지켜야 하며 소멸되거나 추락할 때까지 그 의지를 위해 싸워야 한다는 것입니다.</p>
                                <footer>
                                    <a href="#" class="button medium icon solid fa-arrow-circle-right">세계관 둘러보기</a>
                                </footer>
                            </section>
                        </div>
                        <div class="col-6 col-12-medium">
                            <section>
                                <header class="major">
                                    <h2>챔피언 기획 해설 : 흐웨이</h2>
                                    <p>예술가와 창작가는 보통 무언가를 만들고자 하는 욕구가 무엇보다 강합니다.</p>
                                </header>
                                <p>흐웨이는 아이오니아의 작은 섬 코이엔에 있는 사원에서 어린 시절을 보내며 예술과 회화를 갈고닦았습니다. 
                                작은 방앗간이 있는 유명한 예술 사원에서는 생도들이 예술 마법의 힘을 다루는 데 필요한 정밀함과 균형을 터득하고자 수련합니다.</p>
                                <footer>
                                    <a href="#" class="button medium alt icon solid fa-info-circle">새로운 챔프 알아보기</a>
                                </footer>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="wrapper style3">
            <div class="inner">
                <div class="container">
                    <div class="row">
                        <div class="col-8 col-12-medium">

                            <!-- Article list -->
                                <section class="box article-list">
                                    <h2 class="icon fa-file-alt"></h2>
                                    <!-- Excerpt -->
                                @php
                                    $limitdata = $data->take(3);
                                    // DB에서 받아온 값을 3개만 출력하기 위해 take(3)사용
                                @endphp                                
                                    @forelse($limitdata as $item)
                                        <article class="box excerpt">
                                            <a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
                                            <div>
                                                <header>
                                                    <span class="date">11월 23일</span>
                                                    <h3><a href="#">{{$item->d_title}}</a></h3>
                                                </header>
                                                <p>{{$item->d_content}}</p>
                                                <a href="{{route('board.show', ['board' => $item->d_id])}}" class="button alt icon solid fa-file-alt">자세히 보기</a>
                                                {{-- board.show라우트의 url은 board/{board}이므로, url상에서 동적으로 변하는 값으로 설정하기 위해
	                                            세그먼트 파라미터인 {board}에 $item->d_id 설정
			                                    (배열표기법을 사용하여 {board} 세그먼트 파라미터에 $item->d_id 아규먼트 전달) --}}
                                            </div>
                                        </article>                
                                </section>
                                    @empty
                                    <div>게시글 없음</div><br>
                                    @endforelse
                                <a href="{{route('board.create')}}" class="button medium icon solid fa-arrow-circle-right">글 작성</a>  
                                
                        </div>
                        <div class="col-4 col-12-medium">
                            <!-- Spotlight -->
                            <section class="box spotlight">
                                <h2 class="icon fa-file-alt">공지사항</h2>
                                <article>
                                    <a href="#" class="image featured"><img src="images/pic07.jpg" alt=""></a>
                                    <header>
                                        <h3><a href="#">T1 월드 챔피언십 우승 기념 이벤트</a></h3>
                                        <p>11월 24일</p>
                                    </header>
                                    <p>플레이어 여러분, T1이 오랜 시간을 지나 마침내 월드 챔피언십의 가장 높은 자리에 올라섰습니다.
                                        월드 챔피언 T1의 우승을 축하하는 이벤트를 만나보세요!</p>
                                    <p>T1 선수단의 여정에 함께한 모든 챔피언과 스킨을 2주 간 50% 할인합니다.
                                        금주 초 공지를 통해 안내드렸던 것처럼, 13.10 패치 이후 출시된 스킨 및 전설급/초월급/ e스포츠 스킨, 
                                        신화급/프레스티지 스킨은 할인 목록에서 제외되었습니다. 단, 이 경우 선수가 플레이했던 챔피언의 최신 스킨을 대체 할인하고, 
                                        해당 스킨명에 *을 표시해두었으니 참고 부탁드립니다.                                            
                                        이벤트는 11월 24일(금) 11시부터 12월 8일(금) 11시까지 진행됩니다.</p>
                                    <footer>
                                        <a href="#" class="button alt icon solid fa-file-alt">자세히 보기</a>
                                    </footer>
                                </article>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection