<template>

    <div class="box box-widget">
        <div class="box-body">

            <loader
            :loading="loading"
            ></loader>

            <div class="row mb-3">
	            
	            <div class="col-sm-6 hidden-xs form-inline">
                    <filter-box v-show="filterusers.length > 0"
                    @onfilter="filterByUser"
                    :filters="filterusers"
                    :defaultlabel="'Filter by User'"
                    :valuecolumn="'id'"
                    :labelcolumn="'name'"
                    ></filter-box>

                    <filter-box v-show="filterevents.length > 0"
                    @onfilter="filterByEvent"
                    :filters="filterevents"
                    :defaultlabel="'Filter by Event'"
                    ></filter-box>

                    <filter-box v-show="filtermodels.length > 0"
                    @onfilter="filterByModel"
                    :filters="filtermodels"
                    :defaultlabel="'Filter by Type'"
                    ></filter-box>
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
            :headers="['Message', 'Event', 'Type', 'Date']"
            :columns="['message', 'event', 'model_class', 'created_at']"
            :filters="filters"
            
            :fetchurl="fetchurl"
            :actionable="true"
            :selectable="false"
            :autofetch="autofetch"

            @loaded="init"
            @loading="load"
            >

                <tbody slot="body">
                    <tr v-for="item in items">
                        <!-- <td><input :value="item.id" type="checkbox" v-model="selected"></td> -->
                        <td>{{ item.message }}</td>
                        <td>{{ item.event }}</td>
                        <td>{{ item.model }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <center>
                                <a :href="item.actions.view" v-show="item.actions.view"
                                class="btn btn-xs btn-primary" target="_blank">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a :href="item.actions.view_user" v-show="item.actions.view_user" 
                                class="btn btn-xs btn-warning" target="_blank">
                                    <i class="fa fa-user"></i>
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
 * ==================================================================================
 **/

import Filter from '../../components/Filter.vue';
import DataTable from '../../components/DataTable.vue';
import Loader from '../../components/Loader.vue';

export default {

    props:{
        fetchurl: String,
        filterusers: {},
        filterevents: {},
        filtermodels: {},
        autofetch: Boolean,
    },

    components:{
        'datatable': DataTable,
        'loader': Loader,
        'filter-box': Filter,
    },

    data:function() {
        return {
            selected: [],
            loading: false,
            initiated: false,
            
            items: [],
            filters: {},

            filter: null,
        };
    },

    watch:{

        filter:function(val) {

            this.filters = Object.assign(this.filters, { filter: val });
            this.fetch();
        },
    },

    methods:{

        /**
         * Receives fetched data for rendering.
         */
        init:function(val) {

            /* Initialize default variables */
            this.items = val;
            this.initiated = true;

            /* Fire off re-init */
            // ebi.$emit('re-init', { el: this.$el });
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

        filterByUser(value) {
            this.filters = Object.assign(this.filters, { user: value });
            this.fetch();
        },

        filterByEvent(value) {
            this.filters = Object.assign(this.filters, { event: value });
            this.fetch();
        },

        filterByModel(value) {
            this.filters = Object.assign(this.filters, { model: value });
            this.fetch();
        },

        /**
         * Add filter to request and then fetch.
         */
        fetch:function() {

            this.$nextTick(() => {
                
                if(this.initiated) {
                    this.$refs.datatable.fetch();
                }
            });
        },

        /**
         * Toggles loading animation.
         */
        load:function(val) {
            this.loading = val;
        },
    }
}
</script>