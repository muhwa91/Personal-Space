<template>
  <!-- 헤더 -->
  <div class="header">
    <ul>     
      <li v-if="$store.state.flgTabUI !== 0" class="header-button header-button-left" @click="listMove()">취소</li>      
      <li><img class="logo" alt="Vue logo" src="/css/logo.png"></li>
      <li v-if="$store.state.flgTabUI === 1"
      @click="addBoard()"
      class="header-button header-button-right">작성</li>
    </ul>
  </div>
  <!-- <p>{{ $store.state.phptest }}</p> vuex 연동 확인용 -->

  <!-- 컨테이너 -->
  <ContainerComponent></ContainerComponent>

  <!-- 더보기 버튼 -->
  <button @click="listadd()"
  v-if="$store.state.flgBtnMoreView && $store.state.flgTabUI === 0">더보기</button>

  <!-- 푸터 -->
  <div class="footer">
    <div class="footer-button-store">
      <label for="file" class="label-store">+</label>
      <input @change="updateImg" accept="image/*" type="file" id="file" class="input-file">
    </div>
  </div>
  

</template>

<script>
import ContainerComponent from './ContainerComponent.vue';

export default {
  name: 'AppComponent',
  components: {
    ContainerComponent,
  },
  created() {
    // store actions 함수 호출
    this.$store.dispatch('actionGetBoardList');
    // 1. [APP]store 접근 위해 this 사용
    // 2. [store]store 접근하여 dispatch 메소드 사용하여 action 영역 내 actionGetBoardList 메소드 호출
    // 2-1. actionGetBoardList(context) : store 접근용으로 고정 파라미터 context 설정
    // 2-2. url 선언, header 선언(권한 여부)
    // 2-3. axios.get : get메소드 axios(서버&DB 송수신)
    // 2-4. array 내 객체로 데이터 전송 받은 데이터를 res.data에 저장
    // 2-5. store 접근, mutation 영역 내 setBoardList 메소드 호출하여 res.data 파라미터로 전달
    // 2-6. setBoardList(state, data) : state 접근용으로 고정 파라미터 state 설정, 두번째 파라미터 res.data 전달
    // 2-7. state 접근, boardData : [] 내 res.data 저장
    // 2-8. state 접근, lastBoardId: 0 내 array로 넘어온 객체 총 3개, 길이3-1=2/ data[2].id 인덱스 2번의 id 값이 저장
    // App 상속받는 ContainerComponent, ContainerComponent 상속받는 PostComponent 내 for문 실행
    // [PostComponent]res.data 저장한 boardData img, likes, name, content, created_at 출력
  },
  methods: {
    updateImg(e) { // 작성 페이지 이동 및 이미지 관리
      const file = e.target.files;
      const imgURL = URL.createObjectURL(file[0]); // 브라우저에 임시저장      
      this.$store.commit('setImgURL', imgURL); // 작성 영역에 이미지를 표시하기 위한 데이터 저장
      // 1. [App]store 접근 위해 this 사용
      // 2. [store]store 접근 하여 commit 메소드 사용하여 mutation 접근
      // 2-1. mutation 영역 내 setImgURL 메소드 호출하여 url에 imgURL 파라미터로 전달
      // 2-2. setImgURL(state, url) : state 접근용으로 고정 파라미터 state 설정, 두번째 파라미터 imgURL 전달
      // 2-3. state 접근, 초기화 세팅해놓은 imgURL에 파라미터로 전달받은 imgURL을 저장
      // 즉, 이미지파일을 선택하였을 때(change 이벤트) updateImg메소드 호출 
      this.$store.commit('setPostFileData', file[0]); // 작성 처리 시 보낼 파일 데이터 저장
      // 1. [App]store 접근 위해 this 사용
      // 2. [store]store 접근 하여 commit 메소드 사용하여 mutation 접근
      // 2-1. mutation 영역 내 setPostFileData 메소드 호출하여 file에 file[0] 파라미터로 전달
      // 2-2. setPostFileData(state, file) : state 접근용으로 고정 파라미터 state 설정, 두번째 파라미터 file[0] 전달
      // 2-3. state 접근, null 세팅해놓은 postFileData에 파라미터로 전달받은 file[0]을 저장
      // 즉, 이미지 파일을 file[0]에 저장하여 작성 처리 시 보낼 파일 데이터 저장
      this.$store.commit('setFlgTabUI', 1); // 작성 ui 변경을 위한 플래그 수정
      // 1. [App]store 접근 위해 this 사용
      // 2. [store]store 접근 하여 commit 메소드 사용하여 mutation 접근
      // 2-1. mutation 영역 내 setFlgTabUI 메소드 호출하여 num에 1 파라미터로 전달
      // 2-2. setFlgTabUI(state, num) : state 접근용으로 고정 파라미터 state 설정, 두번째 파라미터 1 전달
      // 2-3. state 접근, 0 세팅해놓은 flgTabUI에 파라미터로 전달받은 1을 저장
      // 플래그 설정하여 if문 실행 가능하도록 설정
      e.target.value = ''; // 이벤트 타겟 초기화
    },
    listMove() {
      this.$store.commit('setFlgTabUI', 0);
    },
    addBoard() { // 글 작성 처리
      this.$store.dispatch('actionPostBoardAdd');
    },
    listadd() { // 더보기 처리
      this.$store.dispatch('actionGetBoardListAdd');
    },
  }
}
</script>
