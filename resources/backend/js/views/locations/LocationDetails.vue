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

                    <!-- Box Body Start -->
                	<div class="box-body">
                        <!-- Start Row -->
                        <div class="row">

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="item.name" :disabled="editable" name="name" type="text" class="form-control input-sm" placeholder="Name">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Address
                                        <position-finder 
                                        :address="item.address"
                                        @onfetch="positionFetch"
                                        :fetchurl="fetchpositionurl">
                                        </position-finder>
                                    </label>
                                    <input v-model="item.address" :disabled="editable" name="address" type="text" class="form-control input-sm" placeholder="Address">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Latitude</label>
                                    <input v-model="item.latitude" :disabled="editable" name="latitude" type="text" class="form-control input-sm" placeholder="Latitude">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Longitude</label>
                                    <input v-model="item.longitude" :disabled="editable" name="longitude" type="text" class="form-control input-sm" placeholder="Longitude">
                                </div>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <list-field
                                :label="'Email Addresses'"
                                :placeholder="'Email Address'"
                                :name="'emails[]'"
                                :disabled="editable"
                                :list="item.emails">
                                </list-field>
                            </div>

                            <div class="col col-xs-12 col-sm-12 col-md-6">
                                <list-field
                                :label="'Contact Details'"
                                :placeholder="'Contact Number'"
                                :name="'contacts[]'"
                                :disabled="editable"
                                :list="item.contacts">
                                </list-field>
                            </div>

                        </div>
                        <!-- End Row -->
                		
                    <!-- Box Body End -->
                    </div>
                </div>
            <!-- Box End -->
            </div>
        </div>
    </div>
</template>

<script>
import Loader from '../../components/Loader.vue';
import ListField from '../../components/ListField.vue';
import PositionFinder from '../../components/PositionFinder.vue';

export default {
    props: {
        submiturl: String,
        fetchurl: String,
        fetchpositionurl: String,
        disabled: Boolean,
        model: {
            type: Object,
        },
    },

    components: {
        'loader': Loader,
        'list-field': ListField,
        'position-finder': PositionFinder,
    },

    data() {
        return {
            loading: false,

            item: {
                latitude: 0,
                longitude: 0,
            },
        }
    },

    computed: {
        editable() {
            return this.disabled || this.loading;
        },
    },

    mounted() {
        this.setup();
        this.init();
    },

    methods: {
        setup() {
            if (this.model) {
                this.item = this.model;
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
                this.item = data.item ? data.item : this.item;

            }).catch(error => {
                console.log(error);
            }).then(() => {
                this.load(false);
            });
        },

        positionFetch(position) {
            alert(position.message);
            this.item.latitude = position.latitude;
            this.item.longitude = position.longitude;
        },

        load(value) {
            this.loading = value;
        }
    },
}
</script>