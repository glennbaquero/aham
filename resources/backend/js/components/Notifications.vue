<template>
	<li class="dropdown messages-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <i class="fa fa-envelope"></i>
		  <span class="label label-success">{{ unreadNotifications.length }}</span>
		</a>
		<ul class="dropdown-menu">
		  <li class="header">You have {{ unreadNotifications.length }} {{ unreadNotifications.length <= 1 ? 'unread message' : 'unread messages' }} </li>
		  <li>
		    <ul class="menu">
		        <li v-for="unreadNotification in unreadNotifications"><!-- start message -->
		          <a data-toggle="modal" :data-target="'#modal-default'+unreadNotification.id">
		            <h4>
		              {{ unreadNotification.data['firstname'] + ' ' + unreadNotification.data['lastname'] }}
		              <small><i class="fa fa-clock-o"></i> {{ parseDate(unreadNotification.created_at) }}</small>
		            </h4>
		            <p>{{ unreadNotification.data['message'] }}</p>
		          </a>
		        </li>
		    </ul>
		  </li>
		  <li class="header">You have {{ readNotifications.length }} {{ readNotifications.length <= 1 ? 'read message' : 'read messages' }} </li>
		  <li>
		    <ul class="menu">
		        <li v-for="readNotifications in readNotifications"><!-- start message -->
		          <a data-toggle="modal" :data-target="'#modal-default'+readNotifications.id">
		            <h4>
		              {{ readNotifications.data['firstname'] + ' ' + readNotifications.data['lastname'] }}
		              <small><i class="fa fa-clock-o"></i> {{ parseDate(readNotifications.created_at) }}</small>
		            </h4>
		            <p>{{ readNotifications.data['message'] }}</p>
		          </a>
		        </li>
		    </ul>
		  </li>
		</ul>
	</li>
</template>
<script>
	import { EventBus } from '../EventBus.js'
	export default {
		props: {
			fetchUrl: String
		},

		data() {
			return {
				unreadNotifications: [],
				readNotifications: [],
			}
		},

		created() {
			EventBus.$on('notification-read', data => {
				this.fetchNotifications();
			})
		},

		mounted() {
			this.fetchNotifications();
		},

		methods: {
			fetchNotifications() {
				axios.get(this.fetchUrl)
					.then(response => {
						this.unreadNotifications = response.data.unreadNotifications;
						this.readNotifications = response.data.readNotifications;
					})
			},

			parseDate(date) {
				return moment(date).format('MMMM DD, YYYY')
			}
		}

	}
</script>