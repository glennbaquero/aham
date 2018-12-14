require('./bootstrap');
window.Vue = require('vue');
require('./script');

Vue.component('product-list', require('./views/products/Product.vue'));
Vue.component('user-profile', require('./views/userprofile/UserProfile.vue'));
Vue.component('basic-warranty', require('./views/warranties/BasicWarranty.vue'));

const app = {
	init() {
		this.setupVue();
	},

	setupVue() {
		new Vue({
		    el: '#app',
		});
	}
};

app.init();
