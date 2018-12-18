<template>
	<div class="usr__container">
		<div class="usr__search inlineBlock-parent">
			<i class="fa fa-search"></i>
			<input class="input-text" placeholder="Search Model No." type="text" name="">
		</div>
		<table>
			<tr>
				<th>Appliance</th>
				<th>Model No.</th>
				<th>Serial No.</th>
				<th>Purchase Date</th>
				<th>Registered Date</th>
				<th>Contract No.</th>
				<th>Registered Warranty</th>
				<th>Apply</th>
			</tr>
			<tr v-for="item in items">
				<td>
					<div class="tbl__img-holder">
						<img :src="item.product_image">
					</div>
					<p>{{ item.product.name }}</p>
				</td>
				<td>
					<p>{{ item.product.model }}</p>
				</td>
				<td>
					<p> {{ item.invoice.serial_number }} </p>
				</td>
				<td>
					<p> {{ item.invoice.purchase_date }} </p>
				</td>
				<td>
					<p> {{ item.created_at }} </p>
				</td>
				<td>
					<p>{{ item.invoice.contract_number }}</p>
				</td>
				<td>
					<p>{{ item.invoice.warranty_type === 1 ? 'Extended Warranty' : 'Basic Warranty' }}</p>
				</td>
				<td>
					<a :href="extend+item.id" v-if="item.invoice.warranty_type === 0">Apply for Extended Warranty</a>
				</td>
			</tr>

		</table>
	</div>
</template>
<script>
	export default {
		props : {
			fetchurl: String
		},

		data() {
			return {
				items:{},
				extend:'user/checkout/',
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
						this.items = response.data.items;
					})
			}
		} 
	}
</script>