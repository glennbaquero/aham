<template>
<div class="ch__container animate-up" id="form">
	<loader
    :loading="loading"
    ></loader>
	<div class="ch__col--1">
		<p class="ch__title">Checkout</p>
			<div class="ch__form-row">
				<label>Application Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.application_number">
				<img src="">
			</div>
			<div class="ch__form-row">
				<label>Payment</label>
				<input class="input-text" type="text" name="" v-model="item.payment">
			</div>
			<div class="ch__form-row">
				<label>Bank</label>
				<input class="input-text" type="text" name="" v-model="item.bank">
				<img src="">
			</div>
		<p class="ch__sub-title">Payment Method</p>
		<div class="check-box">
			<label class="checkbox-lbl font--2">iPay88
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
				<input class="input-text" type="text" name="model" v-model="item.product.model">
				<input class="input-text" type="hidden" name="invoice_id" v-model="item.invoice.id">
			</div>
			<div class="ch__form-row">
				<label>Serial Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.serial_number">
			</div>
			<div class="ch__form-row">
				<label>Contact Number</label>
				<input class="input-text" type="text" name="" v-model="item.invoice.contract_number">
			</div>
			<div class="ch__form-row">
				<label>Discount Code</label>
				<input class="input-text error" type="text" name=""><img src="">
			</div>
			<div class="ch__form-row inlineBlock-parent by-2">
				<div>
					<p class="ch__title">Total:</p>	
				</div
				><div class="right-align">
					<p class="ch__title">{{ item.product.extended_amount }}</p>
				</div>
			</div>
		</div>
		<div class="check-box">
			<label class="checkbox-lbl font--2"><b>Agree to</b> Terms & Conditions & AHAMCorp Privacy Policy
				<input type="checkbox" name="agree">
				<span class="checkmark"></span>
			</label>
		</div>
		<div class="center-align">
			<button class="btn btn-blue" @click="submit()"><p>Submit</p></button>
			<a href="" class="btn outline--blue"><p>Back</p></a>
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

	export default {
		props : {
			fetchurl: String,
			checkouturl: String
		},

		components: {
			ipayform,
			'loader': Loader,
		},

		data() {
			return {
				item: {},
    			loading:false,
    			payment_method: 1
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
					})
			},

			submit() {
				if(this.loading) return;

				this.loading = true;

				let formData = new FormData();

				formData.append('invoice_id', this.item.invoice.id);
				formData.append('model', this.item.product.model);
				formData.append('serial_number', this.item.invoice.serial_number);
				formData.append('contract_number', this.item.invoice.contract_number);
				formData.append('amount', this.item.product.extended_amount);
				formData.append('payment_method', this.payment_method);

				axios.post(this.checkouturl, formData)
					.then(response => {
						const data = response.data;

						if(data.redirectUrl) {
							window.location.href = data.redirectUrl;
						}

						let invoice = data.invoice;
						let user = data.user;
						this.$refs.ipayform.init(data.gateway, invoice, user);
		    			this.loading = false;
					}).catch(errors => {
						this.loading = false;
						swal('Error!', errors, 'error');
					})
			}
		}
	}
</script>