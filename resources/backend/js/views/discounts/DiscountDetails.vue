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
                            <div class="col col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Discount Code</label>
                                    <input v-model="item.discount_code" :disabled="editable" name="discount_code" type="text" class="form-control input-sm" placeholder="Discount Code">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Customer</label>
                                    <select class="form-control" name="user_id">
                                        <option v-for="user in users" :value="user.id" :selected="user.id === item.user_id ? true : false">{{ user.firstname + ' ' + user.lastname }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Product Category</label>
                                    <select class="form-control" name="category_id">
                                        <option v-for="category in categories" :value="category.id" :selected="category.id === item.category_id ? true : false">{{ category.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Discounted Amount</label>
                                    <input v-model="item.discount_amount" :disabled="editable" name="discount_amount" type="number" min="0" class="form-control input-sm" placeholder="Discounted Amount">
                                </div>
                            </div>
                    		
                            <div class="col col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Expiration</label>
                                    <input v-model="item.expiration" :disabled="editable" name="expiration" type="text" class="flatpickr form-control input-sm" placeholder="Expiration">
                                </div>
                            </div>

                            
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
import flatpickr from '../../mixins/flatpickr.js';
import select2 from '../../mixins/select2.js';
import ckeditor from '../../mixins/ckeditor.js';

export default {
	props: {
        submiturl: String,
        fetchurl: String,
        disabled: Boolean,
        model: {},
        categories: Array,
        users: Array,
    },

    components: {
        'loader': Loader
    },

    mixins: [
        ckeditor,
        flatpickr,
        select2,
    ],

    data() {
        return {
            loading: false,
            item: {},
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

            this.ckeditor.init();
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

    		}).catch(error => {
                console.log(error);
    		}).then(() => {
                this.load(false);
                this.flatpickr.init('.flatpickr', true);
                this.select2.init('.select2');
            });
    	},

        load(value) {
            this.loading = value;
        }
    },
}
</script>