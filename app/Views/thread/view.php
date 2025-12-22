<?php
$thread_id = [
	'type' => 'hidden',
	'name' => 'thread_id',
	'value' => $thread->id,
];
$user_id = [
	'type' => 'hidden',
	'name' => 'user_id',
	'value' => session()->get('id'),
];
$star = [
	'type' => 'hidden',
	'name' => 'star',
	'value' => 0,
];
?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div id="threadPage">
	<!-- thread -->
	<div class="bg-light pt-4 pb-4 pl-4 pr-4 card card-border border-purple ">

		<!-- title -->
		<h1 class="title font-weight-bold mb-1">
			<?= htmlspecialchars($thread->title) ?>
		</h1>

		<!-- rating -->
		<div>
			<span>Rating:</span>
			<?php if($rating) : ?>
			<?php for($i = 0; $i < 5; $i++) : ?>
			<?php if(($i + 1 ) <= $rating->rating) : ?>
			<span class="fas fa-star checked"></span>
			<?php else : ?>
			<span class="fas fa-star"></span>
			<?php endif ?>
			<?php endfor ?>
			<?php else : ?>
			<span class="fas fa-star"></span>
			<span class="fas fa-star"></span>
			<span class="fas fa-star"></span>
			<span class="fas fa-star"></span>
			<span class="fas fa-star"></span>
			<?php endif ?>
		</div>

		<!-- rating button -->
		<?php if(session()->has('loggedIn')) : ?>
		<button class="btn btn-warning mr-auto mt-1" id="ratingButton" type="button" data-toggle="modal" data-target="#ratingModal">
			Beri Rating <i class="fas fa-star"></i>
		</button>

		<!-- rating modal -->
		<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">

					<!-- header -->
					<div class="modal-header">
						<h5 class="font-weight-bold">Beri rating Anda untuk thread ini</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<!-- body -->
					<div class="modal-body text-center">
						<i class="fas fa-star" id="star_1" onclick="rate(1)"></i>
						<i class="fas fa-star" id="star_2" onclick="rate(2)"></i>
						<i class="fas fa-star" id="star_3" onclick="rate(3)"></i>
						<i class="fas fa-star" id="star_4" onclick="rate(4)"></i>
						<i class="fas fa-star" id="star_5" onclick="rate(5)"></i>

						<?= form_open('thread/rate') ?>
						<?= form_input($thread_id) ?>
						<?= form_input($user_id) ?>
						<?= form_input($star) ?>
					</div>

					<!-- footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-success">Rate</button>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif ?>

		<hr>

		<!-- content -->
		<div class="card-body row" style="gap: 30px;" id="threadSummary">
			<div class="col-sm-2 text-center" id="postedBy">

				<!-- created by -->
				<div class="mb-2">
					<div class="mb-1">Diposting oleh:</div>
					<!-- avatar -->
					<img src="<?= $created_by->avatar ? base_url('uploads/avatar/'.$created_by->avatar) : base_url('assets/images/user-logo.jpeg') ?>" alt="<?= htmlspecialchars($created_by->username).'\'s avatar' ?>" class="rounded img-fluid" style="width: 100px; height: 100px">
					<br>
					<!-- username -->
					<a class="font-weight-bold" href="<?= base_url('user/view/'.$created_by->id) ?>">
						<?= htmlspecialchars($created_by->username) ?>
					</a>
				</div>
				<!-- created at -->
				<div>
					<div class="mb-1">Diposting pada:</div>
					<span class="font-weight-bold"><?= $thread->created_at ?></span>
				</div>

				<!-- updated by -->
				<?php if($thread->updated_by) : ?>
				<?php if($updated_by->username !== $created_by->username) : ?>
				<div class="mt-3 mb-2">
					<div class="mb-1">Diupdate oleh:</div>
					<!-- avatar -->
					<img src="<?= $updated_by->avatar ? base_url('uploads/avatar/'.$updated_by->avatar) : base_url('assets/images/user.jpeg') ?>" alt="<?= htmlspecialchars($updated_by->username).'\'s avatar' ?>" class="rounded img-fluid" style="width: 100px; height: 100px">
					<br>
					<!-- username -->
					<a class="font-weight-bold" href="<?= base_url('user/view/'.$updated_by->id) ?>">
						<?= htmlspecialchars($updated_by->username) ?>
					</a>
				</div>
				<?php endif ?> 
				<!-- updated at -->
				<div>
					<div class="<?= $updated_by->username !== $created_by->username ? '' : 'mt-3' ?> mb-1">Diupdate pada:</div>
					<span class="font-weight-bold"><?= $thread->updated_at ?></span>
				</div>
				<?php endif ?>
			</div>
			<!-- /.col -->
				
			<div class="col">
				<!-- content -->
				<div class="mb-5">
					<?= $thread->content ?>
				</div>

				<!-- meta -->
				<div id="meta">
					<!-- category -->
					<a class="rounded p-2 text-dark text-decoration-none" href="<?= base_url('thread/index') ?>?keyword=&category_id=<?= $category->id ?>&submit=" style="background-color: lightgreen; width: fit-content;" id="category">
						<?= $category->category ?>
					</a>
					<!-- action -->
					<?php if(session()->role === 'Admin' || session()->username === $created_by->username) : ?>
					<div id="action">
						<!-- edit -->
						<a href="<?= base_url('thread/edit/'.$thread->id) ?>" class="btn btn-info" role="button">
							Edit <i class="fas fa-pen"></i>
						</a>
						<!-- delete -->
						<a href="<?= base_url('thread/delete/'.$thread->id) ?>" class="btn btn-danger" role="button" onclick="return confirm('Anda yakin ingin menghapus thread ini?')">
							Hapus <i class="fas fa-trash"></i>
						</a>
					</div>
					<!-- /.action -->
					<?php endif ?>
				</div>
				<!-- /.meta -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.body -->
		<!-- reply -->
		<a href="<?= base_url('reply/add/'.$thread->id) ?>" class="ml-auto btn btn-primary" role="button">Buat Reply <i class="fas fa-pencil"></i></a>
	</div>
	<!-- /.thread -->

	<!-- replies count -->
	<h4 class="mt-3 mb-3 p-2 rounded font-weight-bold" style="background-color: lightblue">
		<?php if($repliesCount < 1) : ?>
		<?= 'Belum ada reply...'; ?>
		<?php elseif($repliesCount  > 1) : ?>
		<?= $repliesCount.' Replies'; ?>
		<?php else : ?>
		<?= $repliesCount.' Reply'; ?>
		<?php endif ?>
	</h4>
	<!-- /.replies count -->
				
	<!-- replies -->
	<?php if($replies) : ?>
	<?php $i = 0; ?>
	<?php foreach ($replies as $reply) : ?>
	<?php $i++; ?>
	<div class="card mb-3" id="threadSummary">
		<!-- header -->
		<div class="card-header" style="background-color: purple;">
			<h6 class="text-white h3 font-weight-bold text-decoration-none">
				Reply #<?= $i ?>
			</h6>
		</div>

		<!-- body -->
		<div class="card-body row pt-4 pb-4 pl-4 pr-4" style="gap: 30px;">
			<div class="col-sm-2 text-center" id="postedBy">

				<!-- created by -->
				<div class="mb-2">
					<div class="mb-1">Dibalas oleh:</div>
					<!-- avatar -->
					<img src="<?= $reply->avatar ? base_url('uploads/avatar/'.$reply->avatar) : base_url('assets/images/user-logo.jpeg') ?>" alt="<?= htmlspecialchars($reply->username).'\'s user avatar' ?>" class="rounded img-fluid" style="width: 100px; height: 100px">
					<br>
					<!-- username -->
					<a class="font-weight-bold" href="<?= base_url('user/view/'.$reply->user_id) ?>">
						<?= htmlspecialchars($reply->username) ?>
					</a>
				</div>
				<!-- created at -->
				<div>
					<div class="mb-1">Dibalas pada:</div>
					<span class="font-weight-bold"><?= $reply->created_at ?></span>
				</div>
				<!-- updated at -->
				<?php if($reply->updated_at) : ?>
					<div class="mb-1 mt-3">Diupdate pada:</div>
					<span class="font-weight-bold"><?= $reply->updated_at ?></span>
				<?php endif ?>
			</div>
			<!-- /.col -->
			
			<div class="col">
				<!-- content -->
				<div class="mb-5">
					<?= $reply->content ?>
				</div>

				<!-- meta -->
				<div id="meta">
					<!-- action -->
					<?php if(session()->role === 'Admin' || session()->username === $reply->username) : ?>
					<div id="action">
						<!-- edit -->
						<a href="<?= base_url('reply/edit/'.$reply->id) ?>" class="btn btn-info" role="button">
							Edit <i class="fas fa-pen"></i>
						</a>
						<!-- delete -->
						<a href="<?= base_url('reply/delete/'.$reply->id) ?>" class="btn btn-danger" role="button" onclick="return confirm('Anda yakin ingin menghapus reply ini?')">
							Hapus <i class="fas fa-trash"></i>
						</a>
					</div>
					<!-- /.action -->
					<?php endif ?>
				</div>
				<!-- /.meta -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.body -->
	</div>
	<?php endforeach ?>
	<!-- pagination -->
	<div class="d-flex" style="gap: 5px;">Halaman: <?= $pager->links() ?></div>
	<?php endif ?>
	<!-- /.replies -->
</div>

<script type="text/javascript">
	// Save rating.
	function rate(id) {
		// Get star.
		document.getElementsByName('star')[0].value = id;
		switch(id) {
			case 1 :
				checked('star_1');
				unchecked('star_2');
				unchecked('star_3');
				unchecked('star_4');
				unchecked('star_5');
			break;
			case 2 :
				checked('star_1');
				checked('star_2');
				unchecked('star_3');
				unchecked('star_4');
				unchecked('star_5');
			break;
			case 3 :
				checked('star_1');
				checked('star_2');
				checked('star_3');
				unchecked('star_4');
				unchecked('star_5');
			break;
			case 4 :
				checked('star_1');
				checked('star_2');
				checked('star_3');
				checked('star_4');
				unchecked('star_5');
			break;
			case 5 :
				checked('star_1');
				checked('star_2');
				checked('star_3');
				checked('star_4');
				checked('star_5');
			break;
		}
	}

	// Check stars.
	function checked(star_id) {
		var star = document.getElementById(star_id);
		star.classList.add('checked');
	}

	// Uncheck stars.
	function unchecked(star_id) {
		var star = document.getElementById(star_id);
		star.classList.remove('checked');
	}
</script>

<?= $this->endSection() ?>
