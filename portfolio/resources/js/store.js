// vuex 기본형태
import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
	state() { // state : data 저장영역
		return {
			boardData : [], // 게시글 저장용
			flgTabUI: 0, // 탭ui용 플래그
			imgURL: '', // 작성탭 표시용 이미지 URL 저장용
			postFileData: null, // 글 작성 파일데이터 저장용
			lastBoardId: 0, // 가장 마지막 로드 된 게시글 번호 저장용
			flgBtnMoreView: true, // 더보기 버튼 활성여부 플래그
		}
	},

	// mutations : 데이터 수정용 함수 저장 영역
	// state에 작성시 mutations 필수 작성
	mutations: {
		// 초기 데이터 세팅
		setBoardList(state, data) { // mutations 고정 파라미터1 : state(data 저장영역) 
			state.boardData = data;
			state.lastBoardId = data[data.length - 1].id;
			// 배열로 받아오기 때문에 인덱스-1 해주면 
		},
		// 탭ui 세팅
		setFlgTabUI(state, num) {
			state.flgTabUI = num;
		},
		// URL 세팅
		setImgURL(state, url) {
			state.imgURL = url;
		},
		// 글 작성 파일데이터 세팅
		setPostFileData(state, file) {
			state.postFileData = file;
		},
		// 작성된 글 삽입용
		setUnshiftBoard(state, data) {
			state.boardData.unshift(data);
			// unshift 배열 내 데이터 인덱스 0번부터 삽입 
			// ex)0 1 2 > 0 1 2 3 인덱스 0번에 새로 삽입하기때문에 인덱스 하나 더 늘어남
			// 작성을 하게 되면 리로딩 되지 않기 때문에 작성할때 마다 인덱스가 늘어남
			// 새로고침으로 리로딩 하면 인덱스 3번까지만 출력
		},
		// 더보기 데이터 추가
		setPushBoard(state, data) {
			state.boardData.push(data);
			state.lastBoardId = data.id;
		},
		// 더보기 버튼 활성화
		setflgBtnMoreView(state, boo) {
			state.flgBtnMoreView = boo;
		},
		setClearAddData(state) {
			state.imgURL = '';
			state.postFileData = null;
		},
	},

	// actions : ajax로 서버에 데이터를 요청할 때 or 시간 함수 등 비동기 처리 정의
	actions: {
		// 초기 게시글 데이터 획득 ajax처리(기존 fetch 사용)
		actionGetBoardList(context) { // actions 고정 파라미터1 : context(store 접근용)
			const url = '/api/boards';
			const header = {
				headers: {
					'Authorization': 'Bearer meerkat'
				}
			};
			axios.get(url, header)
			.then(res => {
				// console.log(res);
				console.log(res.status);
				context.commit('setBoardList', res.data);
				// res.data : array 내 객체로 데이터 전송
				// commit() : mutations 호출용 메소드, state에는 자동세팅&data에 res.date 전달
				// url에서 받아온 레스폰스 데이터를 setBoardList 파라미터 전달하여
				// state 내 게시글 저장용으로 세팅해둔 배열 내에 데이터 저장
			})
			.catch(err => {
				console.log(err);
			})
		},
		// 글 작성 처리
		actionPostBoardAdd(context) {
			const url = '/api/boards';
			const header = {
				headers: {
					'Authorization': 'Bearer meerkat',
					'Content-Type': 'multipart/form-data',
				}
			};
			// const data = {
			// 	name: '외않돼는대',
			// 	img: context.state.postFileData,
			// 	content: document.getElementById('content').value,
			// };
			const formData = new FormData();
			formData.append('name', '되나');
			formData.append('img', context.state.postFileData);
			formData.append('content', document.getElementById('content').value);
			
			axios.post(url, formData, header)
			.then(res => {
				// 작성글 데이터 저장
				context.commit('setUnshiftBoard', res.data);
				// 리스트 UI로 전환
				context.commit('setFlgTabUI', 0);
				// 작성 후 초기화 처리
				context.commit('setClearAddData');
			})
			.catch(err => {
				console.log(err);
			});
		},
		actionGetBoardListAdd(context) {
			const paramurl = context.state.lastBoardId
			const url = '/api/boards/' + paramurl;
			const header = {
				headers: {
					'Authorization': 'Bearer meerkat',
				}
			};			
			
			axios.get(url, header)
			.then(res => {
				if(res.data) { // 데이터가 있을 경우
					context.commit('setPushBoard', res.data);
				} else { // 데이터가 없을 경우
					context.commit('setflgBtnMoreView', false);
				}
				// commit() : mutations 호출용 메소드, state에는 자동세팅&data에 res.data 전달
				// url에서 받아온 레스폰스 데이터를 setBoardList 파라미터 전달하여
				// state 내 게시글 저장용으로 세팅해둔 배열 내에 데이터 저장
			})
			.catch(err => {
				console.log(err);
			});
		}
	}
});

export default store;
