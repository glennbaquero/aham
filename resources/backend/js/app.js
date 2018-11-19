require('./bootstrap');
window.Vue = require('vue');
require('./settings');

Vue.component('roles-table', require('./views/roles/RolesTable.vue'));
Vue.component('roles-details', require('./views/roles/RoleDetails.vue'));
Vue.component('prx-alert', require('./components/Alert.vue'));
Vue.component('products-table', require('./views/products/ProductsTable.vue'));
Vue.component('product-details', require('./views/products/ProductDetails.vue'));
Vue.component('categories-table', require('./views/categories/CategoriesTable.vue'));
Vue.component('category-details', require('./views/categories/CategoryDetails.vue'));
Vue.component('types-table', require('./views/types/TypesTable.vue'));
Vue.component('type-details', require('./views/types/TypeDetails.vue'));


const app = {
	init() {
		this.setupVue();
	},

	setupVue() {
		new Vue({
		    el: '#app'
		});
	}
};

app.init();
