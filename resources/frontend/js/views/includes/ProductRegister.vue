<template>
	<div class="vertical-align">
		<div class="rw__container center-align animate-up">
			<p class="rw__title">Not yet registered to a warranty plan?</p>
			<form class="rw__form">
				<div class="rw__form-row">
					<select class="select" v-model="product" @change="validate(product[1])">
						<option disabled selected>Model Number</option>
						<option v-for="product in products" :value="[product.id, product.extended_amount]" > {{ product.model }}</option>
					</select><div class="tool-tip register" data-tooltip-title="This product is not available for Extended Warranty" data-tooltip-position="right" v-show="show"><i class="color--red fa fa-exclamation-circle"></i></div>
				</div>
				
				<div class="rw__form-row">
					<div class="button">
						<a class="btn btn-white" @click="redirect(product[0])"><p>Basic Warranty</p></a
						><a class="btn outline--white" @click="redirect(product[0], 1)">
							<div class="btn-img--1"><img class="img-fit" src="storage/logo-white.png" style="height: 142%; left: 37%"><p style="margin-left: 90%">Extended Warranty</p></div></a>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			products: {
				id: null,
				extended_amount: null
			},
			extendedurl: String,
			basicurl: String
		},

		data() {
			return {
				product: null,
				show:false
			}
		},

		mounted() {

		},

		methods: {
			validate(extended) {
				if(!extended) {
					this.show = true;
				} else {
					this.show = false;
				}
			},

			redirect(id, extended) {
				if(!id) {
					return;
				}
				if(extended) {
					window.location.href = this.extendedurl +'/'+ id
				} else{
					window.location.href = this.basicurl +'/'+ id
				}
			}
		}
	}
</script>