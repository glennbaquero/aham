<template>
	<div>
		<div class="bw__form form">
			<loader
	        :loading="loading"
	        ></loader>
			<div class="bw__form-row">
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
				    		<div class="items" v-for="product in products" @click="choose(product.id, product.model)">
				    			<div class="img-holder">
				    				<!-- <img class="img-fit" :src="renderImage(product.images[0].image)"> -->
				    			</div
				    			><div class="dropdown-content">
				    				<div><b>{{ product.model }}</b></div>
				    			</div>
				    		</div>
				    	</div>
				    </div>
				</div>
				<!-- <select class="input-text select"  v-model="request.product">
					<option class="inlineBlock-parent by-2" v-for="product in products" :value="product.id">
						<div class="left-align">
							<img src="http://via.placeholder.com/30x30">
						</div
						><div class="right-align">
							<p>{{ product.model }}</p>
						</div>
					</option>
				</select> -->
			</div>
			<div class="bw__form-row">
				<label>Serial Number</label>
				<input class="input-text error" type="text" v-model="request.serial_number" name="serial_number" maxlength="15" @keyup="validate">
				<div class="tool-tip" data-tooltip-title="Content here Content here Content here Content here Content here Content here Content here Content here Content here" data-tooltip-position="right"><i class="color--blue fa fa-question-circle"></i></div>
			</div>
			<div class="bw__form-row">
				<label>Purchased Date</label>
				<input class="input-text flatPickr" type="text" v-model="request.purchase_date" placeholder="2018-12-01" name="purchase_date" @focus="showDatePicker()">
			</div>
			<div class="bw__form-row">
				<label>Proof of Purchased</label>
				<input type="file" name="proof_purchase" @change="productImage">
			</div>
			<img id="img" width="75px" height="75px" :hidden="hidden">
			<label class="span">*Please upload scanned copy of the bill or invoice</label>
			<button class="btn btn-blue" @click="OneYearWarranty()">
				<span>I want</span>
				<p>1 Year Free Warranty</p>
			</button
			><button type="submit" class="margin btn btn-gray inlineBlock-parent" @click="ExtendedWarranty()">
				<div>
					<!-- <img :src="asset('images/logo-white.png')"> -->
				</div
				><div>
					<span>I want</span>
					<p>Extended Warranty</p>
				</div>
			</button>
			<a href="">Cancel</a>
		</div>
	</div>
</template>
<script>
    import Loader from '../../components/Loader.vue';

	export default {
		props : {
			fetchproducturl: String,
			oneyearwarranty: String,
			extendedurl: String
		}, 

		components : {
    		'loader': Loader,
		},

		data() {
			return {
				products:{},
				request:{
					price: null,
				},
				image:null,
    			loading:false,
				extend:'user/checkout/',
				hidden: true,
				segment: 0
			}
		},

		mounted() {
			this.fetch();
			this.urlsegment();
		},

		methods : {

			fetch() {
				axios.get(this.fetchproducturl)
					.then(response => {
						this.products = response.data.products;
					})
			},

			showDatePicker() {

                $(document).ready(function(){
                    $('.flatPickr').flatpickr({
                        dateFormat:'Y-m-d', 
                        allowInput:true,
                    });
                });
            },

            OneYearWarranty() {
            	this.loading = true;

            	var extension = this.image;
            	var data = new FormData();

            	data.append('product_id', this.request.product);
            	data.append('serial_number', this.request.serial_number);
            	data.append('purchase_date', this.request.purchase_date);
            	data.append('proof_purchase', this.image);
            	data.append('application_number', Math.random().toString(36).substr(2));

            	axios.post(this.oneyearwarranty, data)
            		.then(response => {
            			console.log(response.data);
            			if(response.data.message == 1){
            				this.loading = false;
	            			swal('We are reviewing your application.', 'Thank you for registering your product. To proceed well send you a link through email approving your application.', 'success');
	            			this.request = {};
	            			this.hidden = true;
            			} else {
            				this.loading = false;
	            			this.hidden = true;
            			}
            		})
            		.catch(error => {
            			this.loading = false;
            			this.hidden = true;
            			swal('Ooops!', 'Fill up all the fields with correct data!', 'error');
            		});
            },

            ExtendedWarranty() {
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
	            				'Thank you for registering your product. To proceed you need to complete the transaction.',
	            				'success')
								.then(function(){
			            			window.location.href = response.data.redirect;
		            			});
	            			this.request = {};
	            			this.hidden = true;
            			} else {
							this.loading = false;
	            			this.hidden = true;
            			}
            		})
            		.catch(error => {
            			this.loading = false;
	            			this.hidden = true;
            			swal('Ooops!', 'Fill up all the fields with correct data!', 'error');
            		});;
            },

            productImage(e) {

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

				this.request.product = parseInt(segment);
	        },


	        choose(id, model){
            	this.request.product = id;
            },

	        renderImage(image) {
	        	return 'storage/' + image;
	        }

		}
	}
</script>