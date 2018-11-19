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
                    				<label for="">Model</label>
                    				<input v-model="item.model" :disabled="editable" name="model" type="text" class="form-control input-sm" placeholder="Model">
                    			</div>
                    		</div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="item.name" :disabled="editable" name="name" type="text" class="form-control input-sm" placeholder="Name">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Extended Amount</label>
                                    <input v-model="item.extended_amount" :disabled="editable" name="extended_amount" type="number" min="1" class="form-control input-sm" placeholder="Extended Amount">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="content">{{ item.description }}</textarea>
                                    <!-- <input v-model="item.description" :disabled="editable" name="description" type="text" min="1" class="ckeditor form-control input-sm" placeholder="Description"> -->
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Specification</label>
                                    <textarea name="specification" class="content specification" >{{ item.specification }}</textarea>
                                    <!-- <input v-model="item.specification" :disabled="editable" name="specification" type="text" min="1" class="ckeditor form-control input-sm" placeholder="Specification"> -->
                                </div>
                            </div>

                            <!-- <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input :data-value="item.edate" v-model="item.edate" :disabled="editable" name="edate" type="text" class="flatpickr form-control input-sm" placeholder="Date">
                                </div>
                            </div> -->

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select v-model="item.category_id" :disabled="editable" name="category_id" class="form-control input-sm">
                                        <option :value="undefined">Select Category</option>
                                        <template v-for="category in categories">
                                            <option :value="category.id">{{ category.name }}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select v-model="item.type_id" :disabled="editable" name="type_id" class="form-control input-sm">

                                        <option :value="undefined">Select Type</option>
                                        <template v-for="type in types">
                                            <option :value="type.id">{{ type.name }}</option>
                                        </template>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Product Images <small>(allows multiple images)</small></label>
                                    <input type="file" name="images[]" class="form-control input-sm" multiple>
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
import ckeditor from '../../mixins/ckeditor.js';
import dropzone from '../../mixins/dropzone.js';

export default {
	props: {
        submiturl: String,
        fetchurl: String,
        disabled: Boolean,
        model: {},
        categories: Array,
        types: Array,
        imageurl: String
    },

    components: {
        'loader': Loader
    },

    mixins: [
        ckeditor,
        flatpickr,
        dropzone,
    ],

    data() {
    	return {
            loading: false,
            item: {},
            description: null
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

        descriptionChange() {
            this.description = $('.content').val();
        },

        productImage(e) {
            var files = e.target.files || e.dataTransfer.files;

            if(!files.length)
                return;

            // this.image = files[0];

            this.createImage(files[0]);
        },

        createImage(file) {
            var reader = new FileReader();
            var $this = this;

            reader.onload = (e) =>{
                $this.item.image = e.target.result;
            };

            reader.readAsDataURL(file);
        },

    	setup() {
    		if (this.model) {
    			this.item = this.model ? this.model : {};
    		}

            this.ckeditor.init();
            this.dropzone.init();
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
            });
    	},

        load(value) {
            this.loading = value;
        }
    },
}
</script>