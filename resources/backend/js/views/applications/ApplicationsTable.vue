<template>

    <div class="box box-widget m-margin-tb">
    	<div class="box-body">

    		<loader
            :loading="loading"
            ></loader>
    		
    		<div class="row">
    			<!-- FILTERS -->
    			<div class="col-sm-6 hidden-xs form-inline">
    			
    			</div>

    			<!-- SEARCHBOX -->
    			<div class="col-sm-3 pull-right">
                    <!-- <search-box
                    @onsearch="search"
                    ></search-box> -->
                </div>
    		</div>

    		<!-- DATATABLE -->
    		<datatable ref="datatable"
            :headers="['#', 'Model', 'Serial Number', 'Contract #', 'Application Number', 'File Extension', 'Created At']"
            :columns="['id', 'model', 'serial_number', 'contract_number', 'application_number', 'file_extension', 'created_at']"
    		:filters="filters"
    		
    		:fetchurl="fetchurl"
    		:actionable="actionable"
    		:selectable="false"

    		@loaded="init"
    		@loading="load"
    		>

    			<tbody slot="body">
    				<tr v-for="item in items">

                        <td>{{ item.id }}</td>
                        <td>{{ item.model }}</td>
                        <td>{{ item.serial_number }}</td>
                        <td>{{ item.contract_number }}</td>
                        <td>{{ item.application_number }}</td>
    					<td>{{ item.file_extension }}</td>
                        <td>{{ item.created_at }}</td>     
                        <td v-show="actionable">
                            <center>
                                <a :href="item.actions.view" 
                                class="btn btn-xs btn-primary">
                                    <span class="fa fa-eye"></span>
                                </a>
                            </center>                            
                        </td>                     
    				</tr>
    			</tbody>

    		</datatable>
    	</div>
    </div>

</template>
<script>

    /**
     * ==================================================================================
     * Template component using DataTable.vue
     * 
     * ==================================================================================
     **/

    import {EventBus} from '../../EventBus.js';

    import DataTable from '../../components/DataTable.vue';
    import Loader from '../../components/Loader.vue';
    import Filter from '../../components/Filter.vue';
    import SearchBox from '../../components/SearchBox.vue';

    export default {

    	props: {
    		fetchurl: String,
            autofetch: Boolean,
            actionable: {
                default: true,
            },
            filtertags: {},
    	},

    	components: {
    		'datatable': DataTable,
    		'loader': Loader,
            'search-box': SearchBox,
            'filter-box': Filter,
    	},

    	data: function() {
    		return {

    			loading:false,
    			initiated:false,
    			
    			items: [],
    			filters: {},

    			searchbox:null,
    			filter:null,
    		};
    	},

    	watch: {

    		filter: function(val) {

    			this.filters = Object.assign(this.filters, { filter: val });
    			this.fetch();
    		},
    	},

    	methods: {

    		/**
    	     * Receives fetched data for rendering.
    	     */
    		init: function(val) {

                /* Initialize default variables */
    			this.items = val;
    			this.initiated = true;

                /* Fire off re-init */
                EventBus.$emit('re-init', { el: this.$el });
    		},


            /**
             * ==================================================================================
             * @Methods
             * ==================================================================================
             **/

    		/**
    	     * Search keyword.
    	     */
    	    search:function(value) {
                this.filters = Object.assign(this.filters, { search: value });
                this.fetch();
            },

            filterByTag(value) {
                this.filters = Object.assign(this.filters, { tag_id: value });
                this.fetch();
            },

    		/**
    	     * Add filter to request and then fetch.
    	     */
    		fetch: function() {

    			this.$nextTick(() => {
    				
    				if(this.initiated) {
    					this.$refs.datatable.fetch();
    				}
    			});
    		},

    		/**
    	     * Toggles loading animation.
    	     */
    		load: function(val) {
    			this.loading = val;
    		},

            renderImage(image) {
                return 'storage/'+image;
            }
    	}
    }
</script>