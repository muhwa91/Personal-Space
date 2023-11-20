<template>
  <div class="nav">
    <div class="nav_img">
      <img src="@/assets/img/headerNav_logo.png" alt="">
    </div>
    <div class="nav_a">
      <a v-for="item in headerNav" :key="item">{{ item }}</a>
    </div>
  </div>








</template>

<script>
// import data from './assets/js/common.js';


export default {
  data() {
    return {
      headerNav : ['게임정보', '새소식', '다운로드', 'E스포츠', '이벤트', '알아보기', '유니버스', '라이엇 스토어', '고객지원'],
    }
  },
  methods: {

  }
}
</script>

<style>
@import url(./assets/css/common.css);


</style>
