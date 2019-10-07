<template>
	<div>
		<loader
        :loading="loading"
        ></loader>
		<div class="inlineBlock-parent">
			<p class="usr__title">Account Information</p>	
			<div class="icon" @click="enable()"><i class="fa fa-pen"></i></div>
		</div>
		<div class="usr__form">
				
			<div class="usr__form-row">
				<label>Email</label>
				<input class="input-text" type="email"  v-model="details.email" disabled="true">
			</div
			><div class="usr__form-row">
				<label>Contact</label>
				<input class="input-text" type="text" name="contact" v-model="details.contact" :disabled="disabled" required>
			</div
			><div class="usr__form-row">
				<label>Firstname</label>
				<input class="input-text" type="text" name="firstname" v-model="details.firstname" :disabled="disabled" required>
			</div
			><div class="usr__form-row">
				<label>Birthdate</label>
				<input class="input-text flatPickr" type="text" name="birthday" id="date" v-model="details.birthday" @focus="showDatePicker()" :disabled="disabled" placeholder="Y-M-D" required>
			</div
			><div class="usr__form-row">
				<label>Lastname</label>
				<input class="input-text" type="text" name="lastname" v-model="details.lastname" :disabled="disabled" required>
			</div
			><div class="usr__form-row">
				<label>Address</label>
				<input class="input-text" type="text" name="address" v-model="details.address" :disabled="disabled" required>
			</div
			><div class="usr__form-row" v-show="show">
				<button class="btn btn-blue" @click="updatedetails">
						<p>Update Profile</p>
				</button>
			</div>
			<div class="usr__line"></div>
			<div class="password">
				<div class="inlineBlock-parent">
					<p class="usr__title">Change Password</p>	
					<div class="icon" @click="unhide()"><i class="fa fa-pen"></i></div>
					<div class="icon" @click="hide()" v-show="visible"><i class="fa fa-times"></i></div>
				</div>
				<div class="usr__form-row" v-show="visible">
					<label>Old Password</label>
					<input class="input-text" type="password" name="old_password" v-model="password.old_password" :disabled="disabledpassword" required>
				</div>
				<div class="usr__form-row" v-show="visible">
					<label>New Password</label>
					<input class="input-text" type="password" name="password" v-model="password.password" :disabled="disabledpassword" required>
				</div>
				<div class="usr__form-row" v-show="visible">
					<label>Repeat Password</label>
					<input class="input-text" type="password" name="password_confirmation" v-model="password.password_confirmation" :disabled="disabledpassword" required>
				</div
				><div class="usr__form-row right-align" v-show="visible">
					<button class="btn btn-blue" @click="updatepassword()">
						<p>Update Details</p>
					</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
    import Loader from '../../components/Loader.vue';

	export default {
		props : {
			fetchurl: String,
			updateurl: String,
			updatepasswordurl: String
		},

		components : {
    		'loader': Loader,
		},

		data() {
			return {
				details: [],
				disabled:true,
				visible: false,
				disabledpassword:true,
				show:false,
				password: {
					password: null,
					old_password: null,
					password_confirmation: null
				},
				loading:false
			}
		},

		mounted() {
			this.fetch();
		},

		methods : {
			showDatePicker : function () {

				var year = (new Date()).getUTCFullYear();
				console.log(year - 3);

                $(document).ready(function(){
                    $('.flatPickr').flatpickr({
                        dateFormat:'Y-m-d', 
                        allowInput:true,
                        maxDate: '01-01-'+year,
                    });
                });
            },

			fetch() {
				axios.get(this.fetchurl)
					.then(response => {
						this.details = response.data.details;
					});
			},

			updatepassword() {
				this.loading = true;
				var data = {
					password: this.password.password,
					password_confirmation: this.password.password_confirmation,
					old_password: this.password.old_password,
				};

				axios.post(this.updatepasswordurl, data)
					.then(response => {
						if(response.data.response === 1){
							this.loading = false;
							swal('Password Updated', 'Password is updated', 'success');
							this.visible = false;
						} else {
							this.loading = false;
							swal('Ooops', 'Password is not match', 'error');
						}
					})
					.catch(error => {
						this.loading = false;
						swal('Ooops', 'Fill up all field and correct data', 'error');
					});

			},

			updatedetails(){

				this.loading = true;

				var data = {
					firstname: this.details.firstname,
					lastname: this.details.lastname,
					contact: this.details.contact,
					birthday: this.details.birthday,
					address: this.details.address,
				}
				axios.post(this.updateurl, data)
					.then(response => {
						this.loading = false;
                        swal('Profile Updated', 'Profile is updated', 'success');
					})
					.catch(error => {
						this.loading = false;
						swal('Ooops', 'Fill up all field and correct data', 'error');
					});
			},

			enable() {
				this.disabled = false;
				this.show = true;
			},

			unhide() {
				this.disabledpassword = false;
				this.password = {};
				this.visible = true;
			},

			hide() {
				this.disabledpassword = true;
				this.visible = false;
			}
		}
	}
</script>