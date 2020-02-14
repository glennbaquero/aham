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
                    <h3 class="box-title">Export Data</h3>
                </div>

                <!-- Start Box Body -->
            	<div class="box-body">

            		<div class="col col-xs-12 col-sm-12 col-md-6">
	                    <div class="form-group">
	                        <label for="">Status</label>
	                        <select class="form-control" name="status" v-model="request.status">
	                        	<option value="all">All</option>
	                            <option v-for="status in filterstatus" :value="status.value"> {{ status.label }} </option>
	                        </select>
	                    </div>
	                </div>
            		<div class="col col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">Product</label>
                            <select class="form-control" name="product" v-model="request.product">
                                <option value="all">All</option>
                                <option v-for="product in products" :value="product.id"> {{ product.name }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">From</label>
                            <input name="from" type="text" class="flatpickr form-control input-sm" placeholder="From" v-model="request.from">
                        </div>
                    </div>

                    <div class="col col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="">To</label>
                            <input name="to" type="text" class="flatpickr form-control input-sm" placeholder="To" v-model="request.to">
                        </div>
                    </div>
            	</div>
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
		export: String,
        products: [],
        filterstatus: []
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
			request:{}
		}
	},

	mounted() {

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

            var data = new FormData();

            data.append('status', this.request.status);
            data.append('product', this.request.product);

    		axios.post(this.export, data)
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