<template>
	<div class="c__sc-row animate-up">
		<div class="c__sc-col">
			<p class="c__title">Authorized Service Centers</p>
			
			<div class="c__sc-container">
				<select @change="change" v-model="location_id" class="select">
					<option :value="null">Please select a location</option>
					<template v-for="location in locations">
						<option :value="location.id">{{ location.name }}</option>
					</template>
				</select>
				<div class="c__sc-holder">
					<p class="c__sc-name">{{ location.name }}</p>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-map-marker-alt"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Address</p>
							<p class="c__desc">{{ location.address }}</p>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-envelope"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Email Address</p>
							<a :href="'mailto:' + email" class="c__desc d-block mb-1" v-for="email in location.emails">{{ email }}</a>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-phone"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Contact Details</p>
							<a :href="'tel:' + contact" class="c__desc d-block mb-1" v-for="contact in location.contacts">{{ contact }}</a>
						</div>
					</div>
				</div>
			</div>
		</div
		><div class="c__sc-col">
			<google-map ref="map"
			:locations="locations">
			</google-map>
		</div>
	</div>
</template>
<script>
import GMap from '../components/Map';

export default {
	props: {
		fetchurl: {},
	},

	components: {
		'google-map': GMap,
	},

	data() {
		return {
			locations: [],
			location_id: null,
			location: {},
		};
	},

	mounted() {
		this.init();
	},

	methods: {
		init() {
			this.fetch();
		},

		fetch() {
			axios.post(this.fetchurl)
			.then(response => {
				const data = response.data;
				this.locations = data.locations;

				if (this.locations.length > 0) {
					this.location = this.locations[0];
					this.location_id = this.locations[0].id;
				}
			}).catch(error => {
				console.log(error);
			});
		},

		change() {
			this.location = this.locations.filter((location) => { return location.id === this.location_id  })[0];
			this.$refs.map.change(this.location.latitude, this.location.longitude);
		},
	},
}
</script>