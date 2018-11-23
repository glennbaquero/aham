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

                    		<div class="col col-xs-12 col-sm-12 col-md-6">
                    			<div class="form-group">
                    				<label for="">Customer Fullname</label>
                                    <select class="form-control" v-model="item.user_id" name="user">
                                        <template v-for="user in users">
                                            <option :value="user.id">{{ user.userdetail.firstname }} {{ user.userdetail.lastname }}</option>
                                        </template>
                                    </select>
                    			</div>
                    		</div>
                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Customer Registered Product</label>
                                    <select class="form-control select2" multiple name="userproducts[]">
                                        <template v-for="user in users">
                                            <option v-for="userproduct in user.userproducts" 
                                                    v-if="userproduct.user_id == item.user_id" 
                                                    :value="user.id"
                                                    >{{ userproduct.product.name }}
                                            </option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Complaint</label>
                                    <textarea class="content" name="complaint">{{ item.complaint }}</textarea>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Solution</label>
                                    <textarea class="content" name="solution">{{ item.solution }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Assign Repair Man</label>
                                    <select class="form-control" v-model="item.repair_men_id" name="repair_man_id">
                                        <template v-for="repairman in repairmen">
                                            <option v-if="repairman.status === 0" :value="repairman.id">{{ repairman.firstname }} {{ repairman.lastname }}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Repair Cost</label>
                                    <input v-model="item.cost" :disabled="editable" name="repair_cost" type="number" min="1" class="form-control input-sm">
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
import ckeditor from '../../mixins/ckeditor.js';
import flatpickr from '../../mixins/flatpickr.js';
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
        ckeditor,
        flatpickr,
        select2,
    ],

    data() {
    	return {
            loading: false,
            item: {},
            users: [],
            repairmen: [],
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
                this.users = data.users;
                this.repairmen = data.repairmen;
    		}).catch(error => {
                console.log(error);
    		}).then(() => {
                this.load(false);
                this.select2.init('.select2');
            });
    	},

        load(value) {
            this.loading = value;
        },
    },
}
</script>