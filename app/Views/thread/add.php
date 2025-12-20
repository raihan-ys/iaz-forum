<?php
$validation = service('validation');
$title = [
	'name' => 'title',
	'id' => 'title',
	'type' => 'text',
	'placeholder' => 'Maksimal 100 karakter',
	'maxlength' => 100,
	'value' => set_value('title'),
	'required' => true,
	'class' => $validation->hasError('title') ? 'w-100 input-invalid' : 'w-100',
];
$category_id = [
	'name' => 'category_id',
	'id' => 'category_id',
	'required' => true,
];
$content = [
	'name' => 'content',
	'id' => 'content',
	'placeholder' => 'Maksimal 30.000 karakter',
	'minlength' => 20,
	'maxlength' => 30000,
	'value' => set_value('content', '', false),
];
$submit = [
	'name' => 'submit',
	'type' => 'submit',
	'value' => 'Post Thread',
	'class' => 'button',
]
?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card card-border border-purple pt-4 pb-4 pl-4 pr-4">

	<h1 class="text-left">
		<i class="fas fa-message h1"></i>
		Buat Thread Baru
	</h1>

	<?= form_open_multipart('thread/add', ['method' => 'post'])?>

	<!-- title -->
	<div class="form-group">
		<?= form_label('Judul', 'title') ?>
		<?= form_input($title) ?>
		<span class="text-danger"><?= validation_show_error('title') ?></span>
	</div>
	
	<!-- category -->
	<div style="margin-bottom: 20px;">
		<div class="custom-select-wrapper">
			<input type="hidden" name="category_id" id="category_id" value="<?= esc($categoryIdKey) ?>">
			<button type="button" class="custom-select-toggle" id="categoryToggle" aria-haspopup="listbox" aria-expanded="false">
				<span id="categorySelected">
					<?= isset($categories[$categoryIdKey]) ? esc($categories[$categoryIdKey]) : 'Pilih kategori' ?>
				</span>
				<i class="fas fa-chevron-down" aria-hidden="true"></i>
			</button>
			<ul class="custom-select-options" id="categoryOptions" role="listbox" aria-labelledby="categoryToggle">
				<?php foreach ($categories as $key => $label) : ?>
				<li role="option" data-value="<?= esc($key) ?>" <?= $key == $categoryIdKey ? 'aria-selected="true" class="selected"' : '' ?>>
					<?= esc($label) ?>
				</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>

	<!-- content -->
	<div class="form-group">
		<?= form_label('Isi', 'content') ?>
		<?= form_textarea($content) ?>
		<span class="text-danger"><?= validation_show_error('content') ?></span>
	</div>

	<!-- submit -->
	<?= form_submit($submit) ?>
</div>

<!-- ckeditor -->
<script src="<?= base_url('assets/ckeditor5/ckeditor.js') ?>"></script>
<script>
	ClassicEditor
		.create(document.getElementById('content'), {
			ckfinder: {
				uploadUrl: "<?= base_url('thread/uploadImages') ?>"
			}
		})
		.then(editor => {	
			console.log(editor)
		})
		.catch(error => {
			console.log(error)
		})
</script>

<?= $this->endSection() ?>
