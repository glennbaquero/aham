<template>
	<div>
		<div>
			<ul id="breadcrumb" class="bc-border" style="margin-top: 0px; margin-left: 0px; list-style: none">
		        <li><a href="/"><i class="icon ion-ios-home"> </i></a></li>
		        <li><a href="/products" class="active"><span class="icon icon-double-angle-right"></span> Products</a></li>
		    </ul>
		</div>

		<loader
	    :loading="loading"
	    ></loader>

	    <filter-box
	    @onfilter="updateFilters"
	    :fetchurl="filterurl">
	    </filter-box>

    	<div class="p__holder">
	    	<template v-for="item in items">

	    		<product-box 
				:item="item">
				</product-box>

	    	</template>
			
			<template v-if="items.length > 0">
				
		    	<pagination ref="page"
		        :fetchurl="url"
		        :autofetch="true"
		        :visible="true"

		        @total="init"
		        @paginate="fetch"
		        ></pagination>

			</template>

	    	<p v-show="items.length < 1">No products found.</p>
		</div>

	</div>
</template>

<script type="text/javascript">

import Loader from '../../components/Loader'; 
import Pagination from '../../components/Pagination'; 
import Product from './Product'; 
import Filters from './Filters'; 

export default {

	components: {
		'product-box': Product,
		'filter-box': Filters,
		'loader': Loader,
		'pagination': Pagination,
	},

	props: {
		fetchurl: String,
		filterurl: String,
		params: {},
	},

	data() {
		return {
			loading: false,
			items: [],
			filters: {},
			url: null,
			empty: false,
			total: null,
            sort: 'id',
            asc: true,
		};
	},

	computed: {

	},

	mounted() {
		this.init();
	},

	methods: {
		init(total = null) {
			this.total = total;
			this.url = this.fetchurl;
			this.fetch();
		},

		updateFilters(filters) {
			this.filters = filters;
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

                this.$nextTick(() => {
                	if (this.items.length > 0) {
	                	let el = this.$refs.page;
	                	console.log(el);
		                if (el) {
			                /* Update pagination */
			                el.pagination = response.data.pagination;
		                }
	                }
                }, 1000);
                
                
                /* Check item length */
                this.empty = this.items.length ? false : true;
            }).catch(error => {
            	console.log(error);
            }).then(() => {
            	this.loading = false;
            });
        },
	}
}

</script>