<?php 

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Thread extends BaseController
{
	// Models.
	protected $threadModel;
	protected $categoryModel;
	protected $ratingModel;
	protected $replyModel;
	protected $userModel;
	protected $ratingViewModel;

	// Services.
	protected $validation;
	protected $session;
	protected $pager;

	public function __construct()
	{
		// Load model.
		$this->threadModel = model('ThreadModel');
		$this->categoryModel = model('CategoryModel');
		$this->ratingModel = model('RatingModel');
		$this->replyModel = model('ReplyModel');
		$this->userModel = model('UserModel');
		$this->ratingViewModel = model('RatingViewModel');

		// Load service.
		$this->validation = service('Validation');
		$this->session = service('Session');
		$this->pager = service('Pager');
	}

	// Show all threads.
	public function index()
	{
		// Set categories.
		$categories = $this->categoryModel->findAll();
		$data['categories'][0] = 'All categories';
		foreach ($categories as $ctg) {
			$data['categories'][$ctg->id] = $ctg->category;
		}

		// Get search keywords.
		$data['keyword'] = $this->request->getGet('keyword') ?? '';
		$data['categoryIdKey'] = (int) $this->request->getGet('category_id');
	
		// Get all threads.
		if ($data['categoryIdKey'] !== 0) {
			$data['threads'] = $this->threadModel
				->select('thread.id, thread.title, thread.content, category.category, thread.created_at, user.username, user.avatar, rating_view.star_count, rating_view.rating')
				->join('category', 'thread.category_id=category.id', 'left')
				->join('user', 'thread.created_by=user.id', 'left')
				->join('rating_view', 'thread.id=rating_view.thread_id', 'left')
				->groupStart()
					->like('title', $data['keyword'])
					->orLike('content', $data['keyword'])
				->groupEnd()
				->where('category_id', $data['categoryIdKey'])
				->paginate(10);
		} else {
			$data['threads'] = $this->threadModel
				->select('thread.id, thread.title, thread.content, category.category, thread.created_at, user.username, user.avatar, rating_view.star_count, rating_view.rating')
				->join('category', 'thread.category_id=category.id', 'left')
				->join('user', 'thread.created_by=user.id', 'left')
				->join('rating_view', 'thread.id=rating_view.thread_id', 'left')
				->like('title', $data['keyword'])
				->orLike('content', $data['keyword'])
				->paginate(10);
		}
		$data['pager'] = $this->threadModel->pager;
		$data['title'] = 'Daftar Thread';
		return view('thread/index', $data);
	}

	// Show thread.
	public function view($id = null)
	{
		// Get thread.
		$data['thread'] = $this->threadModel->find($id);
		if(!$id || !$data['thread']) {
			throw PageNotFoundException::forPageNotFound();
		}

		// Get category.
		$category_id = $data['thread']->category_id;
		$data['category'] = $this->categoryModel->find($category_id);

		// Get thread creator.
		$created_by = $data['thread']->created_by;
		$data['created_by'] = $this->userModel->find($created_by);

		// Get thread updater.
		$updated_by = $data['thread']->updated_by;
		if ($updated_by !== null) {
			$data['updated_by'] = $this->userModel->find($updated_by);
		}

		// Get replies.
		$data['replies'] = $this->replyModel
			->select('reply.id, reply.content, reply.created_at, reply.updated_at, user.username, user.email, user.avatar')
			->join('user', 'user.id=reply.created_by', 'left')
			->where('thread_id', $id)
			->paginate(10);

		// Get count of replies.
		$data['repliesCount'] = $this->replyModel
			->where('thread_id', $id)
			->countAllResults();

		$data['rating'] = $this->ratingViewModel
			->where('thread_id', $id)
			->first();

		$data['pager'] = $this->replyModel->pager;
		$data['title'] = $data['category']->category.' - '.$data['thread']->title;
		return view('thread/view', $data);
	}

	// Insert rate.
	public function rate()
	{
		// Get post.
		$rating = $this->request->getPost();
		if(!$rating) {
			throw PageNotFoundException::forPageNotFound();
		}

		// Get rating by thread and user id.
		$check = $this->ratingModel
			->where('user_id', $rating['user_id'])
			->where('thread_id', $rating['thread_id'])
			->first();

		// If rating found.
		if($check) {
			$rating['id'] = $check->id;
		}

		// Save rating.
		if ($this->ratingModel->save($rating)) {
			$this->session->setFlashdata('success', 'Rating Anda berhasil ditambahkan!');
		} else {
			$this->session->setFlashdata('errors', ['errors' => 'Rating Anda gagal ditambahkan!']);
		}

		// Redirect to thread view.
		return redirect()->to(base_url('thread/view/'.$rating['thread_id']));
	}
	
	// Insert thread.
	public function add()
	{
		// Set categories.
		$category = $this->categoryModel->findAll();
		$data['categories'] = null;
		foreach ($category as $ctg) {
			$data['categories'][$ctg->id] = $ctg->category;
		}

		$data['categoryIdKey'] = (int) $this->request->getGet('categoryId');

		// Get post.
		if ($thread = $this->request->getPost()) {
			// Validation.
			$this->validation->run($thread, 'threadAdd');
			$errors = $this->validation->getErrors();
			if (!$errors) {
				// Set field values.
				$thread['created_at'] = date('Y-m-d H:i:s');
				$thread['created_by'] = $this->session->get('id');

				// Save thread data.
				if ($this->threadModel->save($thread)) {
					$this->session->setFlashdata('success', 'Thread Anda telah diposting!');
					$id = $this->threadModel->insertID();
					return redirect()->to(base_url('thread/view/'.$id));
				} else {
					$this->session->setFlashdata('errors', ['errors' => 'Thread Anda gagal diposting!']);
				}
			} else {
				$this->session->setFlashdata('errors', $errors);
			}
		}
		$data['title'] = 'Buat Thread';
		return view('thread/add', $data);
	}

	// Edit thread.
	public function edit($id = null)
	{
		// Get thread.
		$data['thread'] = $this->threadModel->find($id);
		if(!$id || !$data['thread']) {
			throw PageNotFoundException::forPageNotFound();
		}

		// Set category.
		$category = $this->categoryModel->findAll();
		$data['categories'] = null;
		foreach ($category as $ktg) {
			$data['categories'][$ktg->id] = $ktg->category;
		}

		$data['categoryIdKey'] = (int) $this->request->getGet('categoryId');

		// Get post.
		if ($thread = $this->request->getPost()) {
			// Validation.
			$this->validation->run($thread, 'threadEdit');
			$errors = $this->validation->getErrors();
			if (!$errors) {
				// Set field values.
				$thread['updated_at'] = date('Y-m-d H:i:s');
				$thread['updated_by'] = $this->session->get('id');
				// Update thread data.
				if ($this->threadModel->update($id, $thread)) {
					$this->session->setFlashdata('success', 'Thread berhasil diupdate!');
					return redirect()->to(base_url('thread/view/'.$id));
				} else {
					$this->session->setFlashdata('errors', ['errors' => 'Thread gagal di-update!']);
				}
			} else {
				$this->session->setFlashdata('errors', $errors);
			}
		}
		$data['title'] = 'Edit Thread: '.$data['thread']->title;
		return view('thread/edit', $data);
	}

	// Process uploaded files.
	public function uploadImages()
	{
		// Validation
		$file = $this->request->getFile('upload');
		$validated = $this->validate([
			'upload' => [
				'uploaded[upload]',
				'mime_in[upload,image/jpg,image/jpeg,image/gif,image/png]', 
				'max_size[upload, 1024]',
			],
		]);
		if ($validated && $file) {
			// Upload file.
			$fileName = $file->getRandomName();
			$writePath = './uploads/thread/';
			$file->move($writePath, $fileName);
			$data = [
				'uploaded' => true,
				'url' => base_url('uploads/thread/'.$fileName),
			];
		} else {
			$data = [
				'uploaded' => false,
				'error' => ['messages' => $file],
			];
		}
		return $this->response->setJSON($data);
	}

	// Delete thread.
	public function delete($id = null)
	{
		// Get thread.
		$thread = $this->threadModel->find($id);
		if (!$id || !$thread) {
			throw PageNotFoundException::forPageNotFound();
		}
		
		// Delete thread data.
		if($this->threadModel->delete($id)) {
			$this->session->setFlashdata('success', 'Thread dihapus!');
		} else {
			$this->session->setFlashdata('errors', ['errors' =>'Thread gagal dihapus!']);
		}

		return redirect()->to(base_url('thread'));
	}
}
