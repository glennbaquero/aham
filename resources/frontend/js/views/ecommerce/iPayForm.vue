<template>
	<form :id="id" name="ePayment" method="POST" :action="gateway.url">
	    <input type="hidden" name="MerchantCode" :value="gateway.code">
	    <input type="hidden" name="PaymentId" :value="gateway.paymentId">
	    <input type="hidden" name="ProdDesc" :value="gateway.details">
	    <input type="hidden" name="Signature" :value="gateway.signature">
	    <input type="hidden" name="ResponseURL" :value="gateway.return_url">
	    <input type="hidden" name="BackendURL" :value="gateway.backend_url">
	    <input type="hidden" name="Lang" value="UTF-8">

		<input type="hidden" name="RefNo" :value="invoice.application_number">
	    <input type="hidden" name="Amount" :value="gateway.amount">
	    <input type="hidden" name="UserName" :value="user.firstname + '' + user.lastname">
	    <input type="hidden" name="UserEmail" :value="user.email">
	    <input type="hidden" name="UserContact" :value="user.contact">
	    <input type="hidden" name="Currency" :value="gateway.currency">
	</form>
</template>

<script>
export default {
	props: {
		id: {
			type: String,
			default: 'ipayform',
		},
	},

	data() {
		return {
			form: null,

			gateway: {},
			invoice: {
				extra: {}
			},
			user: {},
		}
	},

	mounted() {
		this.setup();
	},

	methods: {
		setup() {
			this.form = $('#' + this.id);
		},

		init(gateway, invoice, user) {
			this.gateway = gateway;
			this.invoice = invoice;
			this.user = user;

			this.$nextTick(() => {
				this.form.submit();
			});
		},
	},
}
</script>