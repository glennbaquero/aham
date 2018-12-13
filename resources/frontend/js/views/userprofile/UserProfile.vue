<template>
	<div>
		<div class="inlineBlock-parent">
			<p class="usr__title">Account Information</p>	
			<div class="icon" @click="enable()"><i class="fa fa-pen"></i></div>
		</div>
		<div class="usr__form">
				
		<div class="usr__form-row">
			<label>Email</label>
					<input class="input-text" type="email" name="email" v-model="details.email" :disabled="disabled">
			</div
			><div class="usr__form-row">
				<label>Contact</label>
				<input class="input-text" type="text" name="contact" v-model="details.contact" :disabled="disabled">
			</div
			><div class="usr__form-row">
				<label>Firstname</label>
				<input class="input-text" type="text" name="firstname" v-model="details.firstname" :disabled="disabled">
			</div
			><div class="usr__form-row">
				<label>Birthdate</label>
				<input class="input-text flatPickr" type="text" name="birthday" id="date" v-model="details.birthday" @focus="showDatePicker()" :disabled="disabled">
			</div
			><div class="usr__form-row">
				<label>Lastname</label>
				<input class="input-text" type="text" name="lastname" v-model="details.lastname" :disabled="disabled">
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
					<div class="icon" @click="disabled_password()"><i class="fa fa-pen"></i></div>
				</div>
				<div class="usr__form-row">
					<label>Old Password</label>
					<input class="input-text" type="password" name="old_password" v-model="password.old_password" :disabled="disabledpassword">
				</div>
				<div class="usr__form-row">
					<label>New Password</label>
					<input class="input-text" type="password" name="password" v-model="password.password" :disabled="disabledpassword">
				</div>
				<div class="usr__form-row">
					<label>Repeat Password</label>
					<input class="input-text" type="password" name="password_confirmation" v-model="password.password_confirmation" :disabled="disabledpassword">
				</div
				><div class="usr__form-row right-align" v-show="show_password_button">
					<button class="btn btn-blue" @click="updatepassword()">
						<p>Update Details</p>
					</button>
				</div>
			</div>
		</div>
		</div>
	</div>
</template>
<script>
	export default {
		props : {
			fetchurl: String,
			updateurl: String,
			updatepasswordurl: String
		},

		data() {
			return {
				details: [],
				disabled:true,
				disabledpassword:true,
				show:false,
				show_password_button:false,
				password: {
					password: String,
					old_password: String,
					password_confirmation: String
				}
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
				var data = {
					password: this.password.password,
					password_confirmation: this.password.password_confirmation,
					old_password: this.password.old_password,
				};

				axios.post(this.updatepasswordurl, data)
					.then(response => {
						if(response.data.response === 1){
							swal('Password Updated', 'Password is updated', 'success');
						} else {
							swal('Ooops', 'Password is not match', 'error');
						}
					});

			},

			updatedetails(){
				var data = {
					email: this.details.email,
					firstname: this.details.firstname,
					lastname: this.details.lastname,
					contact: this.details.contact,
					birthday: this.details.birthday,
				}
				axios.post(this.updateurl, data)
					.then(response => {
                        swal('Profile Updated', 'Profile is updated', 'success');
					})
					.catch(error => {

					});
			},

			enable() {
				this.disabled = false;
				this.show = true;
			},

			disabled_password() {
				this.disabledpassword = false;
				this.show_password_button = true;
			}
		}
	}
</script>