<?php
class Article extends Admin_Controller
{

	public function __construct () {
		parent::__construct();
		$this->load->model('article_m');
		$this->load->model('user_m');
		$this->data['currentpage'] = 'article';
	}

	public function index () {
		if(in_multiarray('article', $this->data['modules_enabled'])) {
			$this->data['currentsubpage'] = 'overview';
			$this->data['pagetitle'] = 'Alle blogberichten';

			// Fetch all articles
			$this->data['articles'] = $this->article_m->get();
	    	$this->data['authors'] = $this->user_m->get_all_users();
			
			// Load view
			$this->data['subview'] = 'article/index';
			$this->load->view('_layout_main', $this->data);
		} else {
			$this->data['pagetitle'] = 'Module uitgeschakeld';
			$this->data['subview'] = 'components/disabled';
			$this->load->view('_layout_main', $this->data); 
		}
	}

	public function edit ($id = NULL, $status = NULL) {
		// Fetch a article or set a new one
		if ($id) {
			$this->data['article'] = $this->article_m->get($id);
			count($this->data['article']) || $this->data['errors'][] = 'article could not be found';
			$this->data['pagetitle'] = $this->data['article']->title . ' - bewerk blogbericht';
			$this->data['currentsubpage'] = 'nieuw';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['article'] = $this->article_m->get_new();
			$this->data['pagetitle'] = 'Nieuw blogbericht';
			$this->data['currentsubpage'] = 'nieuw';
		}

    	$this->data['authors'] = $this->user_m->get_all_users();
//     	print_r($this->data['authors']);
//     	die();
		
		// Set up the form
		$rules = $this->article_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->article_m->array_from_post(array(
				'title', 
				'body', 
				'pubdate',
				'author',
				'thumbnail'
			));
			$id = $this->article_m->save($data, $id);

			if(!empty($_FILES['thumbnail']['name'])) {
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail']);
                }

				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/blog/" . $thumbnail);
				$this->article_m->save_thumbnail($thumbnail, $id);
			}

			redirect('article/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'article/edit';
		$this->load->view('_layout_main', $this->data);
	}

	public function delete ($id) {
		$this->article_m->delete($id);
		redirect('article');
	}

}