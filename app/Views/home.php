<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- header -->
<div class="row">
	<div class="col-12">
		<h1 class="font-weight-bold mb-2">Forum Institut Az Zuhra<h1>
		<h4 class="mb-3">
			Himpunan Mahasiswa
			<strong style="color: dodgerblue;" class="h4 font-weight-bold">Manajemen Informatika</strong> dan 
			<strong style="color: royalblue;" class="h4 font-weight-bold">Teknik Komputer</strong>
		</h4>

		<!-- CTA -->
		<div class="mb-3">
			<?php if(session()->has('loggedIn')): ?>
				<a href="<?= base_url('thread/add') ?>" class="button">Buat Thread</a>
			<?php else: ?>
				<a href="<?= base_url('login') ?>" class="button">Masuk / Daftar</a>
			<?php endif ?>
		</div>
	</div>
</div>

<!-- hero -->
<div class="row mb-3">
	<!-- carousel -->
	<div class="col-md-6" id="carousel">
		<h5>
			<a href="https://www.facebook.com/hashtag/adabdulubaruilmu" class="h5 mb-1">#AdabDuluBaruIlmu</a>
		</h5>
		<div class="carousel slide" id="carouselHero" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselHero" data-slide-to="0" class="active"></li>
				<li data-target="#carouselHero" data-slide-to="1"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="<?= base_url('assets/images/slide1.jpg') ?>" alt="Mahasiswa Manajemen Informatika" class="d-block active w-100">
				</div>
				<div class="carousel-item">
					<img src="<?= base_url('assets/images/slide2.jpg') ?>" alt="Mahasiswa Teknik Komputer" class="d-block w-100">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-target="#carouselHero" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-target="#carouselHero" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</button>
		</div>
	</div>

	<!-- about -->
	<div class="col-md-6" id="about">
		<h4 class="mb-1 font-weight-bold">Halo, teman-teman mahasiswa!</h4>
		<p class="lead">
			Kami dengan bangga mempersembahkan forum online ini sebagai wadah bagi seluruh mahasiswa Manajemen Informatika dan Teknik Komputer untuk saling berbagi informasi, berdiskusi, dan memperluas jaringan. Forum ini dirancang khusus untuk memenuhi kebutuhan akademik dan non-akademik kalian, serta menjadi tempat yang aman dan nyaman untuk berbagi ide, pengalaman, dan pengetahuan.
		</p>	
	</div>
</div>

<div class="row">
	<!-- top threads -->
	<?php if($topThread->getNumRows() > 0) : ?>
	<div class="col-12 col-md-6">
		<div>
			<h3 class="text-success font-weight-bold"><i class="fas fa-comments h3"></i> 
				<?php if ($topThread->getNumRows() > 1) : ?>
				Top Threads
				<?php else : ?>
				Top Thread
				<?php endif ?>
			</h3>
			<table class="table table-striped">
				<thead class="text-white">
					<th scope="col">#</th>
					<th scope="col">Judul</th>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($topThread->getResult() as $thread) : ?>
					<tr>
						<td class="text-success font-weight-bold"><?= $i++ ?></td>
						<td>
							<a class="text-decoration-none font-weight-bold" href="<?= base_url('thread/view/'.$thread->thread_id) ?>">
								<?php if(strlen($thread->title) > 50) : ?>
								<?= substr($thread->title, 0, 50).'...' ?>
								<?php else : ?>
								<?= $thread->title ?>
								<?php endif ?>
							</a>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php else : ?>
	<div class="col-12 col-md-6">
		<div class="alert alert-info">
			Belum ada thread yang tersedia. Ayo buat thread pertama kamu!
		</div>
	</div>
	<?php endif ?>

	<!-- categories -->
	<div class="col-12 col-md-6">
		<h3 class="font-weight-bold">
			<i class="fas fa-folder h3"></i> Kategori Forum
		</h3>
		<div class="row">
			<?php if(isset($categories) && count($categories)): ?>
			<?php foreach($categories as $ctg): ?>
			<div class="col-6 col-md-4 mb-3">
				<div class="card h-100 border-purple">
					<div class="card-body">
						<a href="<?= base_url('thread/index') ?>?keyword=&category_id=<?= $ctg->id ?>&submit=" class="card-title font-weight-bold mb-2" style="font-size: 1rem;">
							<i class="fas fa-folder-open"></i> 
							<?= esc($ctg->category) ?>
						</a>
						<div class="d-flex justify-content-between align-items-center">
							<span class="badge badge-primary">
								<?= intval($ctg->thread_count) ?> Thread
							</span>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach ?>
			<?php else: ?>
				<div class="col-12">
					<div class="alert alert-info">
						Belum ada kategori yang tersedia.
					</div>
				</div>
      <?php endif ?>
    </div>
	</div>
</div>

<?= $this->endSection() ?>
