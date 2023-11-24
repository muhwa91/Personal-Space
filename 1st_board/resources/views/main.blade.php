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
                                    <h2>챔피언 기획 해설: 흐웨이</h2>
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
                                        <article class="box excerpt">
                                            <a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
                                            <div>
                                                <header>
                                                    <span class="date">11월 23일</span>
                                                    <h3><a href="#">13.23 패치노트</a></h3>
                                                </header>
                                                <p>이번 패치에서는 조정이 필요한 몇몇 챔피언과, 크산테에 적용된 변경 사항과 같이 지난 패치에 변경한 일부 사항을 조정하는 데 집중했습니다. 
                                                    2024년 14.1 패치에서는 대규모 변경 사항이 예정되어 있습니다. 
                                                    이를 다듬고 준비하는 데 더욱더 집중하고 있어 이번 패치와 13.24 패치는 평소보다 더 작고 단순할 것이라는 점을 말씀드립니다!</p>
                                            </div>
                                        </article>

                                    <!-- Excerpt -->
                                        <article class="box excerpt">
                                            <a href="#" class="image left"><img src="images/pic05.jpg" alt="" /></a>
                                            <div>
                                                <header>
                                                    <span class="date">11월 22일</span>
                                                    <h3><a href="#">13.22 패치노트 (수정)</a></h3>
                                                </header>
                                                <p>이번 패치에 Heartsteel 스킨으로 확 튀어보거나 새로운 신화급 빅히트 True Damage 에코를 확인하거나 신화급 상점에 교체된 상품을 확인해 보세요. 
                                                    지난 9월 항저우 아시안게임 리그 오브 레전드 종목에서 금메달을 획득한 선수들을 축하하기 위한 “제19회 항저우 아시안게임 금메달 아이콘” 도 이번 패치 기간 내에 출시됩니다. 
                                                    그리고 무작위 총력전과 돌격! 넥서스도 조정됩니다!</p>
                                            </div>
                                        </article>

                                    <!-- Excerpt -->
                                        <article class="box excerpt">
                                            <a href="#" class="image left"><img src="images/pic06.jpg" alt="" /></a>
                                            <div>
                                                <header>
                                                    <span class="date">11월 21일</span>
                                                    <h3><a href="#">13.21 패치노트 (수정)</a></h3>
                                                </header>
                                                <p>전반적으로 초반부터 격차를 벌리는 속도가 줄어들고 플레이어 간 교전이 증가했으며 평균적으로 게임 시간이 약간 길어져서 이전 패치의 주요 목표는 달성했지만, 
                                                    게임 후반에 강해지는 챔피언은 게임 초반에 강한 챔피언보다 승률이 높아 밸런스 조정이 필요해졌습니다.</p>
                                            </div>
                                        </article>

                                </section>
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