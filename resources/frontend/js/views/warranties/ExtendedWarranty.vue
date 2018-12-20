<template>
	<div>
		<loader
        :loading="loading"
        ></loader>
		<div class="ew__container animate-up">
			<div class="ew__title">
				<div class="vertical-parent">
					<div class="vertical-align">
						<img class="img-logo" src="">
						<p class="">Register for Extended Warranty</p>
					</div>
				</div>
			</div>
			<div class="ew__form">
				<div class="ew__form-row">
					<label>Model Number</label>
					<div class="input-text">
					   <!--  <select name="item">
					    	<option value=""></option>
					    </select> -->
					    <div class="selected">
				    		<i class="ion-arrow-down-b"></i>
				    		<div>Select your product</div>
				    	</div>
				    	<div class="select-dropdown">
				    		<div class="item-holder">
				    			<div class="items" v-for="item in items" @click="choose(item.id, item.model)">
				    				<div class="img-holder">
				    					<img class="img-fit" src="//via.placeholder.com/40x40">
				    				</div
				    				><div class="dropdown-content">
				    					<div><b>{{ item.model }}</b></div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
					</div>
				</div>
				<div class="ew__form-row">
					<label>Serial Number</label>
					<input class="input-text" type="text" name="" v-model="request.serial_number">
					<i class="info fa fa-question-circle"></i>
				</div>
				<div class="ew__form-row">
					<label>Purchased Date</label>
					<input class="input-text flatPickr" type="text" placeholder="2018-12-01" v-model="request.purchase_date" name="purchase_date" @focus="showDatePicker()">
				</div>
				<div class="ew__form-row">
					<label>Proof of Purchased</label>
					<input type="file" name="proof_purchase" @change="proofOfPurchased">
				</div>
				<label class="span">*Please upload scanned copy of the bill or invoice</label>
				<button type="submit" class="btn btn-white" @click="submit">
					<p class="font--2">Register</p>
				</button
				><a class="btn outline--white" href=""><p class="font--2">Close</p></a>
			</div>

		</div>
	</div>
</template>
<script>
    import Loader from '../../components/Loader.vue';

	export default{
		props : {
			fetchurl: String,
			extendedurl: String
		},

		components : {
    		'loader': Loader,
		},

		data() {
			return {
				items:{},
				request: {},
				image:null,
				loading: false
			}
		},

		mounted() {
			this.init();
		},

		methods : {
			init() {
				this.fetch();
			},

			fetch() {
				axios.get(this.fetchurl)
					.then(response => {
						this.items = response.data.products;
					})
			},

			submit() {
				this.loading = true;
            	var data = new FormData();

            	data.append('product_id', this.request.product);
            	data.append('serial_number', this.request.serial_number);
            	data.append('purchase_date', this.request.purchase_date);
            	data.append('proof_purchase', this.image);
            	data.append('application_number', Math.random().toString(36).substr(2));

				axios.post(this.extendedurl, data)
					.then(response => {
            			console.log(response.data);
            			if(response.data.message == 1){
            				this.loading = false;
	            			swal('We are reviewing your application.', 
	            				'Thank you for registering your product. To proceed well send you a link through email approving your application.',
	            				'success')
								.then(function(){
			            			window.location.href = response.data.redirect;
		            			});
	            			this.request = {};
            			}
            		});
			},

			showDatePicker() {

                $(document).ready(function(){
                    $('.flatPickr').flatpickr({
                        dateFormat:'Y-m-d', 
                        allowInput:true,
                    });
                });
            },

            choose(id, model){
            	this.request.product = id;
            },

            proofOfPurchased(e) {
	            var files = e.target.files || e.dataTransfer.files;

	            if(!files.length)
	                return;

	            this.image = files[0];
	        },
		}
	}
</script>