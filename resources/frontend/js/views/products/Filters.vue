<template>
	<div class="filters__container">
		<button @click.prevent="toggle = !toggle" type="button" class="btn btn-blue">Show Filters</button>

		<transition name="fade">
			<div v-show="toggle" class="product__filters__holder">
				<div class="c__form mb-3">
					<form @submit.prevent="filter">
						<div class="c__form-row">
							<p class="bold">Search by keyword</p>
							<input v-model="search" class="input-text" type="text" name="Search" placeholder="Enter keyword...">
						</div>
						<button class="btn btn-blue" type="submit" style="display: none;">Search</button>
					</form>
				</div>
				<ul>
					<p class="bold">Filter by Categories</p>
					<template v-for="category in categories">
						<li class="col col-xs-6 col-sm-4 col-md-3">
							<label>
								<input @change="filter" type="checkbox" name="categories" v-model="selectedCategories" :value="category.id"> {{ category.name }}
							</label>
						</li>
					</template>
				</ul>
			</div>
		</transition>
	</div>
</template>

<script>

export default {
	props: {
		fetchurl: String,
	},

	data() {
		return {
			toggle: false,

			categories: [],
			selectedCategories: [],
			search: null,
		}
	},

	mounted() {
		this.init();
	},

	methods: {
		init() {
			this.fetch();
		},

		filter() {
			this.$emit('onfilter', {
				categories: this.selectedCategories,
				search: this.search,
			});
		},

		fetch() {
			axios.post(this.fetchurl)
			.then(response => {
				const data = response.data;
				this.categories = data.categories;
			}).catch(error => {
				console.log(error);
			});
		},
	},
}
</script>