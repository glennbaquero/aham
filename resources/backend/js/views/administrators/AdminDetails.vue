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
                    				<label for="">Firstname</label>
                    				<input v-model="item.firstname" :disabled="editable" name="firstname" type="text" class="form-control input-sm" placeholder="Firstname">
                    			</div>
                    		</div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Lastname</label>
                                    <input v-model="item.lastname" :disabled="editable" name="lastname" type="text" class="form-control input-sm" placeholder="Lastname">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input v-model="item.email" :readonly="disable" type="email"  name="email" class="form-control input-sm" placeholder="Email">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select v-model="item.role_ids" :data-value="item.role_ids" name="roles[]" class="form-control input-sm select2" multiple>
                                        <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                                    </select>
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
        disable: Boolean,
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
            item: {
                role_ids: [],
            },

            roles: []
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
                console.log(data);
                this.item = data.item ? data.item : {};
                this.item.role_ids = data.roleIds;
                this.roles = data.roles;
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