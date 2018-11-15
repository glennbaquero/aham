require('./bootstrap');
window.Vue = require('vue');
require('./settings');

Vue.component('roles-table', require('./views/roles/RolesTable.vue'));
Vue.component('roles-details', require('./views/roles/RoleDetails.vue'));
Vue.component('prx-alert', require('./components/Alert.vue'));

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
