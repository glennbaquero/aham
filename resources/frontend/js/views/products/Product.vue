<template>
	<div class="p__col">
		<div class="p__img-holder">
			<img class="p__product-img" :src="item.image">
		</div>
		<div class="p__details">
			<p class="p__code">{{ item.model }}</p>
			<p class="p__name">{{ item.name }}</p>
			<ul class="p__specs">
				<li v-html="item.specification"></li>
			</ul>
		</div>
		<a :href="item.actions.view" class="btn outline--blue"><p>View Specs</p></a>
	</div>
</template>

<script>
export default{
	props : {
		item: {},
	},

	data() {
		return {

		}
	},

	mounted() {

	},

	methods : {

	}
}
</script>