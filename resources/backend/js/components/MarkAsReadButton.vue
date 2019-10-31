<template>
	<button class="btn btn-primary" data-dismiss="modal" @click="markAsRead" v-show="message.read_at == null"> Mark as read</button>
</template>

<script>
	import { EventBus } from '../EventBus.js'
	export default{
		props: {
			message: Object,
			url: String
		},

		methods: {
			markAsRead() {
				axios.get(this.url)
					.then(response => {
						EventBus.$emit('notification-read', response.data)
					})
			}
		}
	}
</script>