<template>

    <div class="box box-widget m-margin-tb">
    	<div class="box-body">

    		<loader
            :loading="loading"
            ></loader>
    		
    		<div class="row">
    			<!-- FILTERS -->
    			<div class="col-sm-7 hidden-xs">
    				<div class="row">
    					<div class="col-sm-6">

                            <div class=" col-sm-6 hidden-xs form-inline ">
                                <select v-model="filter"
                                id="sample-select" class="form-control input-sm">
                                    <option :value="null" disabled selected>Filter here...</option>
                                </select>
                            </div>

    					</div>
    				</div>
    			</div>

    			<!-- SEARCHBOX -->
    			<div class="col-sm-3 pull-right">
    				<div class="form-group col-sm-12">
                        <div class="input-group input-group-sm col-sm-12">
                            <input type="text" id="sample-searchfield" name="sample-searchfield"
                            class="form-control input-sm" placeholder="Search here...">
                            <!-- <i class="fas fa-search"></i> -->
                            <!-- <i class="fa fa-warning"></i> -->
                        </div>

    				</div>
    			</div>
    		</div>

    		<!-- DATATABLE -->
    		<datatable ref="datatable"
            :headers="['#', 'Name', 'Created At']"
            :columns="['id', 'name', 'created_at']"
    		:filters="filters"
    		
    		:fetchurl="fetchurl"
    		:actionable="true"
    		:selectable="false"

    		@loaded="init"
    		@loading="load"
    		>

    			<tbody slot="body">
    				<tr v-for="item in items">
                        <td>{{ item.id }}</td>
    					<td>{{ item.name }}</td>
    					<td>{{ item.created_at }}</td>
                        <td>
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

    import DataTable from '../../DataTable.vue';
    import Loader from '../../Loader.vue';

    export default {

    	props: {
    		fetchurl: String,
            autofetch: Boolean
    	},

    	components: {
    		'datatable': DataTable,
    		'loader': Loader,
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
    	    search: function() {

    	    	this.filters = Object.assign(this.filters, { search:this.search });
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
    	}
    }
</script>