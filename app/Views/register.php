<?php
$validation = service('validation');
$username = [
	'name' => 'username',
	'id' => 'username',
	'type' => 'text',
	'minlength' => 6,
	'maxlength' => 30,
	'value' => set_value('username'),
	'required' => true,
	'class' => $validation->hasError('username') ? 'w-100 input-invalid' : 'w-100',
];
$password = [
	'name' => 'password',
	'id' => 'password',
	'minlength' => 8,
	'maxlength' => 50,
	'value' => set_value('password'),
	'required' => true,
	'class' => $validation->hasError('password') ? 'w-100 input-invalid' : 'w-100',
];
$repeatPassword = [
	'name' => 'repeat_password',
	'id' => 'repeatPassword',
	'minlength' => 8,
	'maxlength' => 50,
	'value' => set_value('repeat_password'),
	'required' => true,
	'class' => $validation->hasError('repeat_password') ? 'w-100 input-invalid' : 'w-100',
];
$name = [
	'name' => 'name',
	'id' => 'name',
	'type' => 'text',
	'placeholder' => 'Maksimal 100 karakter.',
	'maxlength' => 100,
	'value' => set_value('name'),
	'required' => true,
	'class' => $validation->hasError('name') ? 'w-100 input-invalid' : 'w-100',
];
$email = [
	'name' => 'email',
	'id' => 'email',
	'type' => 'email',
	'placeholder' => 'Maksimal 50 karakter.',
	'maxlength' => 50,
	'value' => set_value('email'),
	'required' => true,
	'class' => $validation->hasError('email') ? 'w-100 input-invalid' : 'w-100',
];
$birthdate = [
	'name' => 'birthdate',
	'id' => 'birthdate',
	'type' => 'date',
	'pattern' => '\d{2}-\d{2}-\d{4}',
	'value' => set_value('birthdate'),
	'required' => true,
	'class' => $validation->hasError('birthdate') ? 'w-100 input-invalid' : 'w-100',
];
$address = [
	'name' => 'address',
	'id' => 'address',
	'placeholder' => 'Maksimal 255 karakter',
	'maxlength' => 255,
	'value' => set_value('address'),
	'required' => true,
	'class' => $validation->hasError('address') ? 'w-100 input-invalid' : 'w-100',
];
$phoneNumber = [
	'name' => 'phone_number',
	'id' => 'phone_number',
	'type' => 'tel',
	'placeholder' => '1234-5678-9012',
	'maxlength' => 15,
	'pattern' => '^\d{4}-\d{4}-\d{4}$',
	'value' => set_value('phone_number'),
	'required' => true,
	'class' => $validation->hasError('phone_number') ? 'w-100 input-invalid' : 'w-100',
];
$avatar = [
	'name' => 'avatar',
	'id' => 'avatar',
	'accept' => 'image/*',
	'required' => 'true',
	'class' => $validation->hasError('avatar') ? 'w-100 input-invalid' : 'w-100',
];
$submit = [
	'name' => 'submit',
	'type' => 'submit',
	'value' => 'Register',
	'class' => 'button',
];
?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card card-border border-purple pt-4 pb-4 pl-4 pr-4" id="registerPage">

	<!-- brand logo -->
	<img src="<?= base_url('assets/images/iaz-logo.png') ?>" alt="Logo Institut Az Zuhra" class="ml-auto mr-auto mb-3 img-fluid" style="height: 300px;">

	<h4 class="font-weight-bold text-white p-2 rounded" style="background-color: purple;">
		<i class="h4 fas fa-sign-in"></i>
		Pendaftaran Anggota Forum
	</h4>
	
	<?= form_open_multipart('auth/register', ['autocomplete' => 'off'], ['role' => 'Member', 'status' => 'Not active']) ?>
	<div class="row">
		<div class="col">
			<!-- username -->
			<div class="form-group">
				<?= form_label('Username', 'username') ?>
				<?= form_input($username) ?>
				<small class="form-text text-muted">Username terdiri dari 6 sampai 30 karakter dan hanya terdiri dari huruf dan angka.</small>
				<span class="text-danger"><?= validation_show_error('username') ?></span>
			</div>

			<!-- password -->
			<div class="form-group">
				<?= form_label('Password', 'password') ?>
				<?= form_password($password) ?>
				<?= form_label('Konfirmasi Password', 'repeatPassword', ['class' => 'mb-0']) ?>
				<?= form_password($repeatPassword) ?>
				<small class="form-text text-muted">Password terdiri dari 8 sampai 50 karakter dan terdiri huruf kecil, huruf kapital dan angka.</small>
				<span class="text-danger"><?= validation_show_error('password') ?></span>
				<p class="text-danger"><?= validation_show_error('repeat_password') ?></p>
			</div>

			<!-- name -->
			<div class="form-group">
				<?= form_label('Nama', 'name') ?>
				<?= form_input($name) ?>
				<span class="text-danger"><?= validation_show_error('name') ?></span>
			</div>

			<!-- email -->
			<div class="form-group">
				<?= form_label('Email', 'email') ?>
				<?= form_input($email) ?>
				<span class="text-danger"><?= validation_show_error('email') ?></span>
			</div>

			<!-- birthdate -->
			<div class="form-group">
				<?= form_label('Tanggal Lahir', 'birthdate') ?>
				<?= form_input($birthdate) ?>
				<span class="text-danger"><?= validation_show_error('birthdate') ?></span>
			</div>
		</div>
		<!-- /.col -->

		<div class="col">
			<!-- address -->
			<div class="form-group">
				<?= form_label('Alamat', 'address') ?>
				<?= form_input($address) ?>
				<span class="text-danger"><?= validation_show_error('address') ?></span>
			</div>

			<!-- phone number -->
			<div class="form-group" >
				<?= form_label('Nomor Telepon', 'phoneNumber') ?>
				<?= form_input($phoneNumber) ?>
				<small class="form-text text-muted">Nomot telepon harus terdiri dari 12 angka dengan format 1234-5678-9012.</small>
				<span class="text-danger"><?= validation_show_error('phone_number') ?></span>
			</div>

			<!-- avatar -->
			<div class="form-group">
				<?= form_label('Avatar', 'avatar') ?>
				<br>
				<img src="<?= base_url('assets/images/user-logo.jpeg') ?>" alt="User's uploaded avatar." class="rounded mb-2 img-fluid" style="width: 200px; height:200px;" id="uploadedFile">
				<?= form_upload($avatar) ?>
				<small class="form-text text-muted">Upload gambar dengan format .JPEG, .JPG, .PNG, atau .GIF dengan ukuran maksimal 1MB.</small>
				<span class="text-danger"><?= validation_show_error('avatar') ?></span>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<!-- submit -->
	<div class="form-group">
		<?= form_submit($submit) ?>
		<small class="form-text text-muted text-center">Registrasi anggota akan selesai setelah diaktifkan oleh admin.</small>
	</div>

	<?= form_close() ?>
</div>

<?= $this->endSection() ?>
