require('./bootstrap');
window.Vue = require('vue');
require('./script');

Vue.component('product-page', require('./views/products/ProductPage.vue'));
Vue.component('user-profile', require('./views/userprofile/UserProfile.vue'));
Vue.component('user-image', require('./views/userprofile/SidebarImage.vue'));
Vue.component('basic-warranty', require('./views/warranties/BasicWarranty.vue'));
Vue.component('extended-warranty', require('./views/warranties/ExtendedWarranty.vue'));
Vue.component('contact-us', require('./views/contactus/ContactUs.vue'));
Vue.component('checkout', require('./views/checkout/Checkout.vue'));
Vue.component('user-products-table', require('./views/userproducts/UserProductsTable.vue'));

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
