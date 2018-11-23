<template>
    <div>
        <loader
        :loading="loading"
        ></loader>

        <div class="row">
            <div class="col-md-12">
                <!-- Box Start -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-info-circle"></i>
                        <h3 class="box-title">Basic Information</h3>
                    </div>

                    <!-- Start Box Body -->
                	<div class="box-body">

                        <!-- Start Row -->
                		<div class="row">
                            <template v-for="permission in permissions">
                                <div class="col col-xs-12 col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <input type="checkbox" :value="permission.name" name="role_has_permissions[]"> {{ permission.name }}
                                    </div>
                                </div>
                            </template>
                            
                        </div>
                        <!-- End Row -->
                        
                    </div>
                    <!-- Box End -->
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Loader from '../../components/Loader.vue';
import select2 from '../../mixins/select2.js';

export default {
	props: {
        submiturl: String,
        fetchurl: String,
        disabled: Boolean,
        model: {},
    },

    components: {
        'loader': Loader
    },

    mixins: [
        select2,
    ],

    data() {
    	return {
            loading: false,
            item: {
                permissions: [],
            },

            permissions: []
    	}
    },

    computed: {
    	editable() {
    		return this.disabled;
    	},
    },

    mounted() {
    	this.setup();
    	this.init();
    },

    methods: {
    	setup() {
    		if (this.model) {
    			this.item = this.model ? this.model : {};
    		}

    	},

    	init() {
    		this.fetch();
    	},

    	fetch() {
            this.load(true);

    		axios.post(this.fetchurl)
    		.then(response => {
                const data = response.data;
                this.item = data.item ? data.item : {};
                this.item.permissions = data.item ? data.item.permissions : [];
                this.permissions = data.permissions;
                console.log(data);
    		}).catch(error => {
                console.log(error);
    		}).then(() => {
                this.load(false);
                this.select2.init('.select2');
            });
    	},

        load(value) {
            this.loading = value;
        }
    },
}
</script>