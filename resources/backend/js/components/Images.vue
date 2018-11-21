<template>
	<div>
	    <template v-for="(item, key) in items">
	    	<div @click="remove(item.url)" class="d-inline pr-3">
	        	<img :src="item.path" class="img-thumbnail img-responsive d-inline image-remove" width="75" height="75">
			</div>
	    </template>
    </div>
</template>
<script>
	export default {
		props: {
			items: Array,
		},

		methods: {
			remove(url) {
				if(confirm('Do you want to remove the image from slider?')) {
					axios.post(url)
					.then(response => {
						this.$emit('on-delete');
					});
				}
			}
		}
	}
</script>