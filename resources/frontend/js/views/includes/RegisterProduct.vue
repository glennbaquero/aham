<template>
	<div class="vertical-align">
		<div class="h__reg-container animate-up">
			<p class="h__title">Register your product now!</p>
			<p class="h__desc">Register your product to 1 year free basic warranty or try our extended warranty plan! We've got you covered!</p>
			<select class="select" v-model="product" @change="validate(product[1])">
				<option disabled selected>Model Number</option>
				<option v-for="product in products" :value="[product.id, product.extended_amount]"> {{ product.model }}</option>
			</select>
			<div class="tool-tip home" data-tooltip-title="Content here" data-tooltip-position="right" v-show="show"><i class="color--red fa fa-exclamation-circle"></i></div>
			<div class="button">
				<a class="btn btn-blue" @click="redirect(product[0])"><p>Basic Warranty</p></a>
				<a class="rw__btn btn outline--blue inlineBlock-parent relative" @click="redirect(product[0], 1)">
					<div class="btn-img--1" style="margin-right: -3px;"><img class="img-fit" src="storage/819byteslogo.png" style="height: 130%; top: 69%"></div><p>Extended Warranty</p>
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
				product: null,
				show: false
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