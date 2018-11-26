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
                            <template>
                    		<div class="col col-xs-12 col-sm-12 col-md-6">
                    			<div class="form-group">
                    				<label for="">Customer Fullname</label>
                                    <select class="form-control" v-model="item.user_id" name="user" @change="customerChange">
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

                                        <template v-for="user in users" v-if="userproducts === null">
                                            <option v-for="userproduct in user.userproducts" 
                                                    v-if="userproduct.user_id === item.user_id" 
                                                    :value="userproduct.id"
                                                    >{{ userproduct.product.name }}
                                            </option>
                                        </template>

                                        <template v-for="userproduct in userproducts" v-if="userproducts !== null">
                                            <option :value="userproduct.product.id" :selected="userproduct.product.id">
                                                {{ userproduct.product.name }}
                                            </option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                     <template v-for="user in users" v-if="user.id === item.user_id">
                                        <label for="">Address</label>
                                        <input disabled="false" type="text" class="form-control input-sm" :value="user.userdetail.address">
                                    </template>
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
                                    <select class="form-control" v-model="item.repair_men_id" name="repair_men_id">

                                        <template v-for="repairman in repairmen" v-if="repairman.status === 0">
                                            <option :class="repairman.status === 1 ? 'text-danger' : ''" 
                                                    :value="repairman.id" 
                                                    :selected="repairman.status === 1 ? true : false">

                                                    {{ repairman.firstname }} {{ repairman.lastname }} 

                                            </option>
                                        </template>
                                    </select>

                                   <br>
                
                                    <label :hidden="hide">Assigned Repair Man</label>
                                 
                                    <template v-for="repairman in repairmen">
                                        <p v-if="item.repairman === repairman.id" :hidden="hide">
                                            {{ repairman.firstname+' '+repairman.lastname }} 
                                        </p>
                                    </template>
                                    <input type="text" name="repairman" v-model="item.repairman" hidden>
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Repair Cost</label>
                                    <input v-model="item.cost" :disabled="editable" name="repair_cost" type="number" min="1" class="form-control input-sm">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="0" :selected="item.status === 0 ? true : false">PENDING</option>
                                        <option value="1" :selected="item.status === 1 ? true : false">ON GOING</option>
                                        <option value="2" :selected="item.status === 2 ? true : false">COMPLETE</option>
                                    </select>
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
import ckeditor from '../../mixins/ckeditor.js';
import flatpickr from '../../mixins/flatpickr.js';
import select2 from '../../mixins/select2.js';

export default {
	props: {
        submiturl: String,
        fetchurl: String,
        disabled: Boolean,
        model: {},
        hide: Boolean,
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
            item: {
                repairman:null,
            },
            users: [],
            repairmen: [],
            userproducts: [],
           
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
                this.userproducts = data.userproducts;
                this.item.repairman = data.item.repair_men_id;
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

        customerChange() {
            this.userproducts = null;
        },
    },
}
</script>