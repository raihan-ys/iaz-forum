<?php
$validation = service('validation');
$username = [
	'name' => 'username',
	'id' => 'username',
	'type' => 'text',
	'placeholder' => 'Maks. 30 karakter.',
	'minlength' => 1,
	'maxlength' => 30,
	'value' => set_value('username'),
	'required' => true,
	'class' => $validation->hasError('username') ? 'w-100 input-invalid' : 'w-100',
];
$password = [
	'name' => 'password',
	'id' => 'password',
	'placeholder' => 'Maks. 50 karakter.',
	'minlength' => 8, // TEST ERROR
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
	'placeholder' => 'Maks. 100 karakter.',
	'maxlength' => 100,
	'value' => set_value('name'),
	'required' => true,
	'class' => $validation->hasError('name') ? 'w-100 input-invalid' : 'w-100',
];
$email = [
	'name' => 'email',
	'id' => 'email',
	'type' => 'email',
	'placeholder' => 'Email yang valid.',
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
	'placeholder' => 'Maks. 255 karakter.',
	'maxlength' => 255,
	'value' => set_value('address'),
	'required' => true,
	'class' => $validation->hasError('address') ? 'w-100 input-invalid' : 'w-100',
];
$phoneNumber = [
	'name' => 'phone_number',
	'id' => 'phoneNumber',
	'type' => 'tel',
	'placeholder' => '1234-5678-9012',
	'maxlength' => 15,
	'pattern' => '^\d{4}-\d{4}-\d{4}$',
	'value' => set_value('phone_number'),
	'required' => true,
	'class' => $validation->hasError('phone_number') ? 'w-100 input-invalid' : 'w-100',
];
$role = [
	'name' => 'role',
	'id' => 'role',
	'options' => ['Admin' => 'Admin', 'Member' => 'Member'],
	'selected' => null,
	'required' => true,
	'class' => $validation->hasError('role') ? 'w-100 input-invalid' : 'w-100',
];
$status = [
	'name' => 'status',
	'id' => 'status',
	'options' =>  ['Active' => 'Active', 'Not active' => 'Not active'],
	'selected' => null,
	'required' => true,
	'class' => $validation->hasError('status') ? 'w-100 input-invalid' : 'w-100',
];
$avatar = [
	'name' => 'avatar',
	'id' => 'avatar',
	'accept' => 'image/*',
	'required' => true,
	'class' => $validation->hasError('avatar') ? 'w-100 input-invalid' : 'w-100',
];
$submit = [
	'name' => 'submit',
	'type' => 'submit',
	'value' => 'Tambah',
	'class' => 'button w-100',
];
?>

<div class="col-md card p-0">

	<!-- header -->
	<div class="card-header">
		<h5 class="mb-0"><i class="fas fa-user-plus h5"></i> Tambah User</h5>
	</div>

	<!-- body -->
	<div class="card-body">

		<?= form_open_multipart('user', ['autocomplete' => 'off'])?>

		<!-- username -->
		<div class="form-group">
			<?= form_label('Username', 'username') ?>
			<?= form_input($username) ?>
			<span class="text-danger"><?= validation_show_error('username') ?></span>
		</div>

		<!-- password -->
		<div class="form-group">
			<?= form_label('Password', 'password') ?>
			<?= form_password($password) ?>
			<?= form_label('Konfirmasi Password', 'repeatPassword', ['class' => 'mb-0']) ?>
			<?= form_password($repeatPassword) ?>
			<span class="text-danger"><?= validation_show_error('password') ?></span>
			<span class="text-danger"><?= validation_show_error('repeat_password') ?></span>
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

		<!-- address -->
		<div class="form-group">
			<?= form_label('Alamat', 'address') ?>
			<?= form_input($address) ?>
			<span class="text-danger"><?= validation_show_error('address') ?></span>
		</div>

		<!-- phone_number -->
		<div class="form-group">
			<?= form_label('Nomor Telepon', 'phoneNumber') ?>
			<?= form_input($phoneNumber) ?>
			<span class="text-danger"><?= validation_show_error('phone_number') ?></span>
		</div>

		<!-- role -->
		<div class="form-group">
			<?= form_label('Role', 'role') ?>
			<?= form_dropdown($role) ?>
			<span class="text-danger"><?= validation_show_error('role') ?></span>
		</div>

		<!-- status -->
		<div class="form-group">
			<?= form_label('Status', 'status') ?>
			<?= form_dropdown($status) ?>
			<span class="text-danger"><?= validation_show_error('status') ?></span>
		</div>

		<!-- avatar -->
		<div class="form-group">
			<?= form_label('Avatar', 'avatar') ?>
			<br>
			<img src="<?= base_url('assets/images/user-logo.jpeg') ?>" alt="User's uploaded avatar." class="rounded mb-3 img-fluid" id="uploadedFile" style="width: 200px; height: 200px">
			<?= form_upload($avatar) ?>
			<span class="text-danger"><?= validation_show_error('avatar') ?></span>
		</div>

		<!-- submit -->
		<?= form_submit($submit) ?>

		<?= form_close() ?>

	</div>
	<!-- /.body -->
</div>	
