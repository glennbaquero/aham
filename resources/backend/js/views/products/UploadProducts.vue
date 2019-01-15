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
                        <h3 class="box-title">Product Upload</h3>
                    </div>
                    <!-- Start Box Body -->
                	<div class="box-body">
                        <!-- Start Row -->
                		<div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Select Manifest</label>
                                    <input name="manifest" type="file" class="form-control input-sm">
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
        disabled: Boolean,
        model: {},
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
        },

        renderImage(image) {
            return 'storage/'+image;
        }
    },
}
</script>