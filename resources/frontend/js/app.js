require('./bootstrap');
window.Vue = require('vue');
require('./script');

Vue.component('product-list', require('./views/products/Product.vue'));

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
