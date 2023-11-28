require('./bootstrap');

import { createApp } from 'vue';
import AppComponent from '../components/AppComponent.vue';
import store from './store';

createApp({
	components : {
		AppComponent,
	}
})
	.use(store)
	.mount('#app')