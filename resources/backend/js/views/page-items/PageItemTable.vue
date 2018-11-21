<template>

    <div class="box box-widget">
        <div class="box-body">

            <loader
            :loading="loading"
            ></loader>

            <div class="row mb-3">
                
                <div class="col-sm-4 hidden-xs form-inline">

                    <filter-box v-show="filterpages"
                    @onfilter="filterByPage"
                    :filters="filterpages"
                    :defaultlabel="'Filter by Page Slug'"
                    :valuecolumn="'id'"
                    :labelcolumn="'slug'"
                    ></filter-box>

                </div>

                <!-- SEARCHBOX -->
                <div class="col-sm-3 pull-right">            
    
                </div>
            </div>

            <!-- DATATABLE -->
            <datatable ref="datatable"
            :headers="['#', 'Page Name', 'Page Slug', 'Slug', 'Created Date']"
            :columns="['id', false, false,  'slug', 'created_at']"
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
                        <td>{{ item.id }}</td>
                        <td>{{ item.page_name }}</td>
                        <td>{{ item.page_slug }}</td>
                        <td>{{ item.slug }}</td>
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
 * ==================================================================================
 **/

import {ebi} from '../../EventBus.js';

import Filter from '../../components/Filter.vue';
import DataTable from '../../DataTable.vue';
import Loader from '../../Loader.vue';

export default {

    props:{
        fetchurl: String,
        filterpages: {},
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

        filterByPage(value) {
            this.filters = Object.assign(this.filters, { page_id: value });
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