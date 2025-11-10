<?php
$form = [
	'method' => 'get',
	'autocomplete' => 'off',
];
$keyword = [
	'type' => 'search',
	'name' => 'keyword',
	'id' => 'keyword',
	'placeholder' => 'Cari berdasarkan usename, nama, atau email...',
	'value' => set_value('keyword', $keyword, true),
	'maxlength' => 100,
];
?>

<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="card card-border border-purple pt-5 pb-4 pl-4 pr-4" id="userIndexPage">

	<h1 class="font-weight-bold text-white rounded p-2 mb-3 text-center" style="background-color: purple;">
		<i class="fas fa-users h1"></i> Daftar User
	</h1>

	<div class="row">

		<!-- add user -->
		<?php include 'add.php' ?>

		<!-- user list -->
		<div class="col-md-8 card p-0" style="height: fit-content;">

			<div class="card-header">
				<h5 class="mb-0"><i class="fas fa-users h5"></i> User List</h5>
			</div>

			<div class="card-body mr-auto ml-auto table-responsive">

				<!-- user search -->
				<?= form_open('user', $form) ?>

				<!-- keyword -->
				<div class="form-group d-flex flex-row align-items-center">
					<?= form_label('User:', 'keyword', ['class' => 'mr-2']) ?>
					<?= form_input($keyword) ?>
				</div>

				<div class="form-group d-flex flex-row align-items-center">
		
					<!-- role -->
					<?= form_label('Role:', 'roleKey', ['class' => 'mr-2']) ?>
					<select name="roleKey" id="roleKey" required="true" class="mr-3">
						<?php foreach ($roles as $role) : ?>	
						<option value="<?= $role ?>" <?= set_select('roleKey', $role, $role === $roleKey ? true : false) ?>>
							<?= $role ?>
						</option>
						<?php endforeach?>
					</select>

					<!-- status -->
					<?= form_label('Status:', 'statusKey', ['class' => 'mr-2']) ?>
					<select name="statusKey" id="statusKey" required="true">
						<?php foreach ($statuses as $status) : ?>
						<option value="<?= $status ?>" <?= set_select('statusKey', $status, $status === $statusKey ? true : false) ?>>
							<?= $status ?>
						</option>
						<?php endforeach?>
					</select>
				</div>

				<!-- submit -->
				<button type="submit" class="button d-block w-100 mb-3 rounded" name="submit">
					Cari
					<i class="fas fa-search"></i>
				</button>
				
				<?= form_close() ?>
				<!-- /.user search -->

				<?php if ($users) : ?>
				<table class="table table-striped table-hover mb-4">

					<thead class="text-white">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Username</th>
							<th scope="col">Email</th>
							<th scope="col">Role</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($users as $key => $user) : ?>
						<tr>
							<td><?= ($key+1) ?></td>
							<td><?= htmlspecialchars($user->username) ?></td>
							<td><?= htmlspecialchars($user->email) ?></td>
							<td><?= $user->role ?></td>
							<td>
								<span class="badge p-1 <?= $user->status === 'Active' ? 'badge-success' : 'badge-danger' ?>">
									<?= $user->status ?>
								</span>
							</td>
							<td>
								<!-- view button -->
								<a href="<?= base_url('user/view/'. $user->id) ?>" role="button" class="btn btn-info m-1" title="View">
									<i class="fas fa-eye"></i>
								</button>

								<!-- delete button -->
								<a href="<?= base_url('user/delete/'.$user->id) ?>" role="button" class="btn btn-danger m-1" title="Hapus" onclick="return confirm('Anda yakin ingin hapus data user: <?= $user->name ?> ')">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
						<?php endforeach ?> 
					</tbody>
				</table>
				
				<!-- pagination -->
				<div class="d-flex" style="gap: 5px;">Halaman: <?= $pager->links() ?></div>
				<?php else : ?>
				<h3 class="text-center">
					Tidak ada yang ditemukan... 
					<i class="fas fa-wind h3"></i>
					<i class="fas fa-leaf h3"></i>
				</h3 class="text-center">
				<?php endif ?>

			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.user list -->
	</div>
	<!-- /.row -->

</div>
<!-- /.card -->

<?= $this->endSection() ?>
