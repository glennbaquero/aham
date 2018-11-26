<template>
    <div>
        <loader
        :loading="loading"
        ></loader>

        <div class="row">
            <div class="col-md-12">
                <!-- Box Start -->
                <div class="box box-primary no-border">
                    <div class="box-header with-border">
                    </div>

                    <!-- Start Box Body -->
                	<div class="box-body">
                        <template v-for="category in categories">
                            <!-- Start Row -->
                    		<div class="row">

                                <div class="col col-xs-12">
                                    <label><i :class="category.icon" class="mr-2"></i> {{ category.name }} <small>({{ category.description }})</small></label>
                                </div>
                                
                                <template v-for="permission in category.permissions">
                                    <div class="col col-xs-6 col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <input type="checkbox" v-model="item.permissions" :value="permission.id" name="permissions[]"> {{ permission.label }}
                                        </div>
                                    </div>
                                </template>
                                
                            </div>
                            <!-- End Row -->
                        </template>
                    </div>
                    <!-- Box End -->
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Loader from '../../components/Loader.vue';

export default {
	props: {
        fetchurl: String,
        disabled: Boolean,
        autofetch: {
            default: true,
            type: Boolean,
        },
        model: {},
    },

    components: {
        'loader': Loader
    },

    data() {
    	return {
            loading: false,
            item: {
                permissions: [],
            },

            categories: [],
            hasInit: false,
    	}
    },

    computed: {
    	editable() {
    		return this.disabled;
    	},
    },

    mounted() {
    	this.setup();

        if (this.autofetch) {
            this.init();
        }
    },

    methods: {
    	setup() {
    		if (this.model) {
    			this.item = this.model ? this.model : {};
    		}
    	},

        run() {
            if (!this.hasInit) {
                this.hasInit = true;
                this.fetch();
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
                this.categories = data.categories;
                console.log(data);
    		}).catch(error => {
                console.log(error);
    		}).then(() => {
                this.load(false);
            });
    	},

        load(value) {
            this.loading = value;
        }
    },
}
</script>