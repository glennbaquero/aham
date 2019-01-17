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
					    <select name="item">
					    	<option value=""></option>
					    </select>
					    <div class="selected">
				    		<i class="ion-arrow-down-b"></i>
				    		<div>{{ request.product > 0 ? items[request.product - 1].model : 'Select Product'}}</div>
				    	</div>
				    	<div class="select-dropdown">
				    		<div class="item-holder">
				    			<div class="items" v-for="item in items" @click="choose(item.id, item.model)">
				    				<div class="img-holder">
				    					<!-- <img class="img-fit" :src="renderImage(item.images[0].image)"> -->
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
					<input class="input-text error" type="text" name="" maxlength="15" v-model="request.serial_number" @keyup="validate">
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
				<img id="img" width="75px" height="75px" :hidden="hidden">
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
				request: {
					product: 0
				},
				image:null,
				loading: false,
				hidden: true,
			}
		},

		mounted() {
			this.init();
		},

		methods : {
			init() {
				this.fetch();
				this.urlsegment();
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
            				this.hidden = true;
	            			swal('We are reviewing your application.', 
	            				'Thank you for registering your product. To proceed we\'ll send you a link through your email approving your application and the payment link to proceed.',
	            				'success');
	            			this.request = {};
            			} else {
							this.loading = false;
							this.hidden = true;
            			}
            		})
            		.catch(error => {
            			this.loading = false;
            			swal('Ooops!', 'Fill up all the fields with correct data!', 'error');
            		});;
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


	            var filereader = new FileReader();
		        filereader.readAsDataURL(files[0]);

		        filereader.onload = function (event) {
		            document.getElementById("img").src = event.target.result;
		        };
		        
	            this.hidden = false;
	        },

	        validate(e) {
	        	var len = this.request.serial_number;
	        	if(len.length === 15) {
	        		$('.error').css('border', '1px solid #ff0000');
	        	} else {
	        		$('.error').css('border', '1px solid #737272');
	        	}
	        },

	        urlsegment() {
				var pathname = window.location.pathname.split('/');
				var segment = pathname.pop() || pathname.pop();

				if(!segment) {
					this.request.product = 0;
				} else {
					this.request.product = parseInt(segment);
				}
	        },

	        renderImage(image) {
	        	return 'storage/' + image;
	        }
		}
	}
</script>