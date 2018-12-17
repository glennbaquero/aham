<template>
	<div>
		<loader
        :loading="loading"
        ></loader>
		<div class="bw__form form">
			<div class="bw__form-row">
				<label>Model Number</label>
				<select class="input-text select"  v-model="request.product">
					<!-- <option>AWFL-8300B</option> -->
					<option class="inlineBlock-parent by-2" v-for="product in products":value="product.id">
						<div class="left-align">
							<img src="http://via.placeholder.com/30x30">
						</div
						><div class="right-align">
							<p>{{ product.model }}</p>
						</div>
					</option>
				</select>
			</div>
			<div class="bw__form-row">
				<label>Serial Number</label>
				<input class="input-text" type="text" v-model="request.serial_number" name="serial_number">
				<i class="info fa fa-question-circle"></i>
			</div>
			<div class="bw__form-row">
				<label>Purchased Date</label>
				<input class="input-text flatPickr" type="text" v-model="request.purchase_date" placeholder="2018-12-01" name="purchase_date" @focus="showDatePicker()">
			</div>
			<div class="bw__form-row">
				<label>Proof of Purchased</label>
				<input type="file" name="proof_purchase" @change="productImage">
			</div>
			<label class="span">*Please upload scanned copy of the bill or invoice</label>
			<button class="btn btn-blue" @click="OneYearWarranty()">
				<span>I want</span>
				<p>1 Year Free Warranty</p>
			</button
			><button type="submit" class="margin btn btn-gray">
				<span>I want</span>
				<p>Extended Warranty</p>
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
			oneyearwarranty: String
		}, 

		components : {
    		'loader': Loader,
		},

		data() {
			return {
				products:{},
				request:{},
				image:null,
    			loading:false,
			}
		},

		mounted() {
			this.fetch();
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
            			}
            		});
            },

            productImage(e) {
	            var files = e.target.files || e.dataTransfer.files;

	            if(!files.length)
	                return;

	            this.image = files[0];
	        },
		}
	}
</script>