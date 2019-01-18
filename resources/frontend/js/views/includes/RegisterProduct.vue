<template>
	<div class="vertical-align">
		<div class="h__reg-container animate-up">
			<p class="h__title">Register your product now!</p>
			<p class="h__desc">Register your product to 1 year free basic warranty or try our extended warranty plan! We've got you covered!</p>
			<select class="select" v-model="product">
				<option disabled selected>Model Number</option>
				<option v-for="product in products" :value="product.id"> {{ product.model }}</option>
			</select>
			<div class="tool-tip home" data-tooltip-title="Content here" data-tooltip-position="right"><i class="color--red fa fa-exclamation-circle"></i></div>
			<div class="button">
				<a class="btn btn-blue" @click="redirect(product)"><p>Basic Warranty</p></a>
				<a class="rw__btn btn outline--blue inlineBlock-parent relative" @click="redirect(product, 1)">
					<div class="btn-img--1"><img class="img-fit" src="storage/logo-white.png"></div><p>Extended Warranty</p>
				</a>
			</div>
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
				console.log(extended);
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