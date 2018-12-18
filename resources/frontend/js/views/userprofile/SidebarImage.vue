<template>
	<div>
		<div class="usr__img-holder">
			<img class="img-fit" :src="renderImage(details.user_image)">
		</div><p class="usr__name">{{ details.firstname }} {{ details.lastname }}</p>
	</div>
</template>
<script>
	export default {
		props : {
			fetchurl: String,
		},

		data() {
			return {
				details: {},
			}
		},

		mounted() {
			this.fetch();
		},

		methods : {
			fetch() {
				axios.get(this.fetchurl)
					.then(response => {
						this.details = response.data.details;
					});
			},

			renderImage(img) {
				return 'storage/' + img;
			}
		}
	}
</script>