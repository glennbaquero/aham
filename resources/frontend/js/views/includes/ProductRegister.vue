<template>
	<div class="vertical-align">
		<div class="rw__container center-align animate-up">
			<p class="rw__title">Not yet registered to a warranty plan?</p>
			<form class="rw__form">
				<div class="rw__form-row">
					<select class="select" v-model="product">
						<option disabled selected>Model Number</option>
						<option v-for="product in products" :value="product.id"> {{ product.model }}</option>
					</select><div class="tool-tip register" data-tooltip-title="Content here" data-tooltip-position="right"><i class="color--red fa fa-exclamation-circle"></i></div>
				</div>
				
				<div class="rw__form-row">
					<div class="button">
						<a class="btn btn-white" @click="redirect(product)"><p>Basic Warranty</p></a
						><a class="btn outline--white" @click="redirect(product, 1)">
							<div class="btn-img--1"><img class="img-fit" src="storage/logo-white.png"><p style="margin-left: 90%">Extended Warranty</p></div></a>
						<!-- <a class="btn btn-blue" @click="redirect(product)"><p>Basic Warranty</p></a>
						<a class="rw__btn btn outline--blue inlineBlock-parent relative" @click="redirect(product, 1)">
							<div class="btn-img--1"><img class="img-fit" src="storage/logo-white.png"></div><p>Extended Warranty</p>
						</a> -->
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			products: Array,
			extendedurl: String,
			basicurl: String
		},

		data() {
			return {
				product: null
			}
		},

		mounted() {

		},

		methods: {
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