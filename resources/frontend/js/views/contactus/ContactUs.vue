<template>
	<div>
			
		<loader
        :loading="loading"
        ></loader>
		<div class="c__form">
			<div class="c__form-row">
				<label>Firstname</label>
				<input class="input-text" v-model="info.firstname" type="text" name="fname">
			</div
			><div class="c__form-row">
				<label>Lastname</label>
				<input class="input-text" v-model="info.lastname" type="text" name="lname">
			</div
			><div class="c__form-row">
				<label>Email</label>
				<input class="input-text" v-model="info.email" type="email" name="email">
			</div
			><div class="c__form-row">
				<label>Phone Number</label>
				<input class="input-text" v-model="info.phonenumber" type="text" name="num">
			</div>
			<div class="c__form-row textarea">
				<textarea class="textarea" v-model="info.message" placeholder="Message"></textarea>
			</div>
			<button class="btn btn-blue" @click="send()">Send</button>
		</div>
	</div>
</template>
<script>
    import Loader from '../../components/Loader.vue';
	export default {
		props : {
			url: String
		}, 

		components : {
    		'loader': Loader,
		},

		data() {
			return {
				info:{},
				loading: false
			}
		},

		mounted() {

		}, 

		methods : {
			send() {
            	this.loading = true;
            	var data = new FormData();

            	data.append('firstname', this.info.firstname);
            	data.append('lastname', this.info.lastname);
            	data.append('email', this.info.email);
            	data.append('phonenumber', this.info.phonenumber);
            	data.append('message', this.info.message);

            	axios.post(this.url, data)
            		.then(response => {
            			if(response.data.message === 1) {
	            			this.loading = false;
	            			swal('We are reviewing your message.', 'Thank you for messaging us. To give you a feedback we will send you a message through email or phone number.', 'success');
	            			this.info = {};
            			}
            		})

			}
		}
	}
</script>