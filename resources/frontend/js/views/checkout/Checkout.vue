<template>
<div class="ch__container animate-up" id="form">
	<loader
    :loading="loading"
    ></loader>
	<div class="ch__col--1">
		<p class="ch__title">Checkout</p>
			<div class="ch__form-row">
				<label>Application Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.application_number" :disabled="disabled">
				<img src="">
			</div>
			<!-- <div class="ch__form-row">
				<label>Payment</label>
				<input class="input-text" type="text" name="" v-model="item.payment">
			</div>
			<div class="ch__form-row">
				<label>Bank</label>
				<input class="input-text" type="text" name="" v-model="item.bank">
				<img src="">
			</div> -->
		<p class="ch__sub-title">Payment Method</p>
		<div class="check-box">
			<label class="checkbox-lbl font--2">Paypal
				<input type="radio" name="payment_method" v-model="payment_method" :value="payment_method">
				<span class="checkmark"></span>
			</label>
		</div>
	</div
	><div class="ch__col--2">
		<div class="ch__form">
			<p class="ch__title">Your Product</p>
			<div class="ch__form-row">
				<label>Model Number</label>
				<input class="input-text" type="text" name="model" v-model="item.product.model" :disabled="disabled">
				<input class="input-text" type="hidden" name="invoice_id" v-model="item.invoice.id">
			</div>
			<div class="ch__form-row">
				<label>Serial Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.serial_number" :disabled="disabled">
			</div>
			<div class="ch__form-row">
				<label>Contract Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.contract_number" :disabled="disabled">
			</div>
			<div class="ch__form-row">
				<label>Discount Code</label>
				<input class="input-text error discount_code" type="text" name="" v-model="discount" @keyup="discountCode">
				<div class="right-align">
					<p @click="validate" class="btn btn-gray">Check Discount Code</p>
					<label style="color:#fb0000" v-show="enabled">Please check the discount code to proceed to the payment</label>
				</div>
			</div>
			<div class="ch__form-row inlineBlock-parent by-2">
				<div>
					<p class="ch__title">Total:</p>	
				</div
				><div class="right-align">
					<p class="ch__title">{{ (item.product.extended_amount - discounted_amount) < 0 ? 0 : item.product.extended_amount - discounted_amount }}</p>
					<input type="hidden" name="total_price" readonly :value="(item.product.extended_amount - discounted_amount) < 0 ? 0 : item.product.extended_amount - discounted_amount">
					<input type="hidden" name="discount" readonly :value="discounted_amount">
				</div>
			</div>
		</div>
		<div class="check-box">
			<label class="checkbox-lbl font--2"><b>Agree to</b> Terms & Conditions & AHAMCorp Privacy Policy
				<input type="checkbox" name="agree" v-model="agree">
				<span class="checkmark"></span>
			</label>
		</div>
		<div class="center-align">
			<button class="btn btn-blue" @click="submit()" :disabled="enabled" v-if="showSubmit"><p>Submit</p></button>
			<a href="user/products" class="btn outline--blue"><p>Back</p></a>
		</div>
	</div>	

	<ipayform ref="ipayform"
	:id="'ipayform'">
	</ipayform>	
</div>
</template>
<script>
    import Loader from '../../components/Loader.vue';
	import ipayform from '../ecommerce/iPayForm';
	import prx_paypal_mixin from '../../../../../public/vendor/praxxys/ecommerce/paypal/js/vue-mixin.js';

	export default {
		props : {
			fetchurl: String,
			checkouturl: String
		},

		components: {
			ipayform,
			'loader': Loader,
		},

		mixins: [prx_paypal_mixin],

		data() {
			return {
				item: {},
				discount_available:{},
    			loading:false,
    			payment_method: 1,
    			discounted_amount: 0,
    			disabled:true,
    			discount: null,
    			enabled: false,
    			agree: false,
    			showSubmit: false
			}
		},

		watch: {
			agree(val) {
				this.showSubmit = val;
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
				axios.get(this.fetchurl)
					.then(response => {
						this.item = response.data.invoice_item;
						this.discount_available = response.data.discounts;
					})
			},
			/**
			 * iPay88 code
			 * 
			 */
			// submit() {
			// 	if(this.loading) return;

			// 	this.loading = true;
			// 	var totalPrice = (this.item.product.extended_amount - this.discounted_amount)  < 0 ? 0 : this.item.product.extended_amount - this.discounted_amount;

			// 	let formData = new FormData();

			// 	formData.append('invoice_id', this.item.invoice.id);
			// 	formData.append('model', this.item.product.model);
			// 	formData.append('serial_number', this.item.invoice.serial_number);
			// 	formData.append('contract_number', this.item.invoice.contract_number);
			// 	formData.append('amount', this.item.product.extended_amount);
			// 	formData.append('payment_method', this.payment_method);
			// 	formData.append('total_price', totalPrice);
			// 	formData.append('discount', this.discounted_amount);

			// 	axios.post(this.checkouturl, formData)
			// 		.then(response => {
			// 			const data = response.data;

			// 			if(data.redirectUrl) {
			// 				window.location.href = data.redirectUrl;
			// 			}

			// 			let invoice = data.invoice;
			// 			let user = data.user;
			// 			this.$refs.ipayform.init(data.gateway, invoice, user, this.item.product.extended_amount);
		 //    			this.loading = false;
			// 		}).catch(errors => {
			// 			this.loading = false;
			// 			swal('Error!', errors, 'error');
			// 		})
			// },
			submit() {
				this.PRXPayPalSubmit(this.buildItems(), this.item.invoice.reference_code, 'PHP');
			},

			buildItems() {
				const items = []; 
				// var total = parseFloat(this.item.total_price);
				var total = this.item.product.extended_amount - this.discounted_amount;
				items.push({name: this.item.product.model, price: total, qty: 1});
				return items;
			},

			validate() {
				var $this = this,
					total = this.discounted_amount;

				if(!this.discount_amount) {
					$this.discount_available.forEach(function(e){
						if(e.discount_code == $('.discount_code').val()) {
							swal('Discount Code Match!', 'Discount code is match to your credentials', 'success');
							$this.discounted_amount = e.discount_amount;
							$this.enabled = false;
						} else if ($('.discount_code').val() === '') {
							swal('Oooops!', 'Enter code!', 'error');
							$this.enabled = true;
						} else {
							swal('Oooops!', 'Discount code is not match to your credentials', 'error');
							$this.enabled = true;
						}

					});
				} 

				return this.discounted_amount;
			},

			discountCode() {
				if(this.discount) {
					this.enabled = true;
				} else {
					this.enabled = false;
				}
			}

		}
	}
</script>