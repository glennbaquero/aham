<template>
	<div>
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

                if (this.items.length > 0) {
	                /* Update pagination */
	                this.$refs.page.pagination = response.data.pagination;
                }
                /* Check item length */
                this.empty = this.items.length ? false : true;
            }).catch(error => {
            	console.log(error);
            }).then(() => {
            	this.loading = false;
            });
        },

		getURL: function(url) {

            /* order by */
            url = this.sort ? this.addURLParam('sort', this.sort, url) : url;

            /* asc, desc */
            url = this.addURLParam('order', this.asc ? 'asc' : 'desc', url);

            /* paginate(total) */
            url = this.total > 0 ? this.addURLParam('total', this.total, url) : url;


            /* filters and search query */
            Object.keys(this.filters).forEach(key => {

                var val = this.filters[key];
                url = val ? this.addURLParam(key, val, url) : url;
            });

            return url;
        },

        /**
		 * Add parameters to a URL string
		 *
		 * @return string
		 */
		addURLParam: function(key, value, url) {
			var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
				hash;

			if(re.test(url)) {

				if(typeof value !== 'undefined' && value !== null) {

					return url.replace(re, '$1' + key + "=" + value + '$2$3');

				} else {

					hash = url.split('#');
					url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');

					if(typeof hash[1] !== 'undefined' && hash[1] !== null) {
						url += '#' + hash[1];
					}

					return url;
				}

			} else {

				if(typeof value !== 'undefined' && value !== null) {

					var separator = url.indexOf('?') !== -1 ? '&' : '?';

					hash = url.split('#');
					url = hash[0] + separator + key + '=' + value;

					if(typeof hash[1] !== 'undefined' && hash[1] !== null) {
						url += '#' + hash[1];
					}

					return url;

				} else {
					return url;
				}
			}
		},
	}
}

</script>