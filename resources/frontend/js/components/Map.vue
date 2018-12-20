<template>
	<div :id="id" :class="cssClass"></div>
</template>

<script>
export default {
	props: {
		id: {
			default: 'gMap',
			type: String,
		},

		css: {
			default: 'gmap',
			type: String,
		},

		locations: {},
	},

	watch: {
		locations(newValue, oldValue) {
			this.markers = newValue ? newValue : this.locations;
		},
	},

	data() {
		return {
			map: null,
			cssClass: null,
			markers: [],
			infowindow: null,
		};
	},

	mounted() {
		this.setup();
		setTimeout(() => {
			this.init();
		}, 500);
	},

	methods: {
		setup() {
			this.cssClass = this.css;

			this.map = new google.maps.Map(document.getElementById(this.id), {
				center: new google.maps.LatLng(14.6353332, 121.0126084),
				zoom: 15
			});

			this.infowindow = new google.maps.InfoWindow();
		},

		init() {
		    if (this.markers.length > 0) {
				this.change(this.markers[0].latitude, this.markers[0].longitude)
			}
		},

		change(lat, lng) {

			if (!lat || !lng) {
				return;
			}

			const $this = this;

			// this.map.clearOverlays();
			this.map.setCenter(new google.maps.LatLng(lat, lng));

		    let gMarker;

		    this.markers.forEach((marker) => {
		    	gMarker = new google.maps.Marker({
					position: new google.maps.LatLng(marker.latitude, marker.longitude),
					map: $this.map
				});

				google.maps.event.addListener(gMarker, 'click', ((gMarker) => {
					return function() {
						$this.infowindow.setContent(marker.name);
						$this.infowindow.open($this.map, gMarker);
					}
				})(gMarker));
		    });
		},
	},
}
</script>