<template>
	<div class="">
		<div class="usr__search inlineBlock-parent">
			<i @click.prevent="search" class="fa fa-search"></i>
			<input @keydown.enter="search" v-model="search_value" class="input-text" placeholder="Search Model No." type="text" name="">
		</div>
		<div class="mb-5 usr__tbl-holder">
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
				<tr v-for="item in items" v-if="item.product && item.invoice">
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
					<td v-if="!item.invoice.has_notified">
						<a :href="extend+item.id" v-if="item.invoice.warranty_type === 0 && item.product.extended_amount">Apply for Extended Warranty</a>
						<img :src="renderImage()" v-if="item.invoice.warranty_type === 1">
					</td>
					<td v-else>
						<img :src="renderExpiredImage()" v-if="item.invoice.warranty_type === 1" height="75"><br>
						<a :href="extend+item.id" v-if="item.invoice.warranty_type === 0 || item.invoice.has_notified">Apply for Extended Warranty</a>
					</td>
				</tr>

			</table>
		</div>

		<template v-if="items.length > 0">
				
	    	<pagination ref="page"
	        :fetchurl="url"
	        :autofetch="true"
	        :visible="true"

	        @total="init"
	        @paginate="fetch"
	        ></pagination>

		</template>
	</div>
</template>
<script>
import Pagination from '../../components/Pagination'; 

export default {
	props : {
		fetchurl: String
	},

	components: {
		'pagination': Pagination,
	},

	data() {
		return {
			loading: false,
			url: null,
			filters: {},
			search_value: null,

			items: {},
			extend: 'user/checkout/',
		}
	},

	mounted() {
		this.init();
	},

	methods : {
		init(total = null) {
			this.total = total;
			this.url = this.fetchurl;
			this.fetch();
		},

		search:function() {
            this.filters = Object.assign(this.filters, { search: this.search_value });
            this.fetch();
        },

		fetch: function(link = null) {

            /* Check loading */
            this.loading = true;

            /*
            |-------------------------------------------------------------
            | @var URL
            |-------------------------------------------------------------
            |
            | The first LINK is received from the pagination component.
            | The second FILTEREDURL is received from parent component
            | that handles filters and searches. The third FETCHURL is
            | the initial route hardcoded in blade.
            |
            | Prioritizes leftmost variable if it has a value.
            |
            */
            var url = link || this.url;

            axios.post(this.getURL(url), this.filters)
            .then(response => {

                /* Emit data for parent component to render */
                this.items = response.data.items;

                if (this.items.length > 0) {
	                /* Update pagination */
	                if (this.$refs.page) {
		                this.$refs.page.pagination = response.data.pagination;
	                }
                }
                /* Check item length */
                this.empty = this.items.length ? false : true;
            }).catch(error => {
            	console.log(error);
            }).then(() => {
            	this.loading = false;
            });
        },

        renderImage() {
        	return 'storage/2xlogo.png';
        },

        renderExpiredImage() {
        	return 'storage/expired.jpg';
        }
	} 
}
</script>