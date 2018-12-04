require('./bootstrap');
window.Vue = require('vue');
require('./settings');

Vue.component('std-alert', require('./components/Alert.vue'));
Vue.component('std-button', require('./components/ActionButton.vue'));
Vue.component('std-remove-image', require('./components/RemoveImage.vue'));
Vue.component('images', require('./components/Images.vue'));

Vue.component('roles-table', require('./views/roles/RolesTable.vue'));
Vue.component('roles-details', require('./views/roles/RoleDetails.vue'));
Vue.component('prx-alert', require('./components/Alert.vue'));
Vue.component('products-table', require('./views/products/ProductsTable.vue'));
Vue.component('product-details', require('./views/products/ProductDetails.vue'));
Vue.component('categories-table', require('./views/categories/CategoriesTable.vue'));
Vue.component('category-details', require('./views/categories/CategoryDetails.vue'));
Vue.component('types-table', require('./views/types/TypesTable.vue'));
Vue.component('type-details', require('./views/types/TypeDetails.vue'));

Vue.component('page-item-table', require('./views/page-items/PageItemTable.vue'));
Vue.component('page-item-details', require('./views/page-items/PageItemDetails.vue'));

Vue.component('page-table', require('./views/pages/PageTable.vue'));
Vue.component('page-details', require('./views/pages/PageDetails.vue'));

Vue.component('admins-table', require('./views/administrators/AdminsTable.vue'));
Vue.component('admin-details', require('./views/administrators/AdminDetails.vue'));

Vue.component('carousels-table', require('./views/carousels/CarouselsTable.vue'));
Vue.component('carousel-details', require('./views/carousels/CarouselDetails.vue'));

Vue.component('repair-request-table', require('./views/repairrequest/RepairRequestTable.vue'));
Vue.component('repair-request-details', require('./views/repairrequest/RepairRequestDetails.vue'));


Vue.component('permission-list', require('./views/permission/PermissionsList.vue'));

const app = {
	init() {
		this.setupVue();
	},

	setupVue() {
		new Vue({
		    el: '#app',

		    methods: {
		    	runDatatable(ref = null, elem = 'datatable', method = 'fetch') {
		            const table = this.$refs[ref].$refs[elem];

		            if (!table.empty) {
		                table[method]();
		            }
		        },

		        runComponent(ref = null, method = 'run') {
		            const elem = this.$refs[ref];

		            if (!elem.hasInit) {
		                elem[method]();
		            }
		        },
		    }
		});
	}
};

app.init();
