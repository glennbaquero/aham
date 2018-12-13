<template>
	<div>

	<loader
    :loading="loading"
    ></loader>

	<template v-for="category in categories">
		<p class="p__title">{{ category.name }}</p>
			<div class="p__holder">
				<div class="p__col" v-for="(product, key) in category.products" v-if="key < 4">
					<div class="p__img-holder" v-for="image in product.images">
						<img class="img-fit" :src="renderImage(image.image)">
					</div>
					<div class="p__details">
						<p class="p__code">{{ product.model }}</p>
						<p class="p__name">{{ product.name }}</p>
						<ul class="p__specs">
							<li v-html="product.specification"></li>
						</ul>
					</div>
					<a :href="view+product.id" class="btn outline--blue"><p>View Specs</p></a>
				</div>
			</div>
			<div class="center-align">
				<a class="btn btn-blue" :href="redirectto+category.id"><p>View all</p></a>
			</div>
		</template>
	</div>
</template>
<script>
	import Loader from '../../../../backend/js/components/Loader.vue';

	export default{
		props : {
			fetchurl: String,
		},

	    components: {
	        'loader': Loader
	    },

		data() {
			return {
	            loading: false,
				categories: {},
				redirectto: 'products/category/',
				view: 'products/view/'
			}
		},

		mounted() {
			this.init();
		},

		methods : {

			init() {
	            this.fetch();
	    	},

			fetch() {
	            this.load(true);

				axios.get(this.fetchurl)
					.then(response => {
						this.categories = response.data.categories;
					}).catch(error => {
		                console.log(error);
		    		}).then(() => {
		                this.load(false);
		            });
			},

	        load(value) {
	            this.loading = value;
	        },

	        renderImage(image) {
	        	return 'storage/' + image;
	        }
		}
	}
</script>