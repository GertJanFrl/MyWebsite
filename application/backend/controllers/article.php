<?php
class Article extends Admin_Controller
{

	public function __construct () {
		parent::__construct();
		$this->load->model('article_m');
		$this->load->model('user_m');
		$this->data['currentpage'] = 'article';
	}

	public function index ($restore = NULL, $restore_id = NULL) {
		if(in_multiarray('article', $this->data['modules_enabled'])) {
			if($restore == 'restore' && is_numeric($restore_id)) {
				$data = array(
						'active' => '1',
				);
				$this->article_m->save($data, $restore_id);
				$this->system_m->log_event('article', $restore_id, 'restore');
				redirect('article/');
				// $this->data['restored'] = 'true';
			}
			$this->data['currentsubpage'] = 'overview';
			$this->data['pagetitle'] = 'Alle blogberichten';

			// Fetch all articles
			$this->data['articles'] = $this->article_m->get_active();
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

	public function trash ($id = NULL, $delete = NULL) {
		if($id) {
			if($delete == "page") {
				$this->article_m->delete($id);
				$this->system_m->log_event('article', $id, 'delete');
				redirect('article/trash/');
			}
			$data = array(
					'active' => '0',
			);
			$this->article_m->save($data, $id);
			$this->system_m->log_event('article', $id, 'trash');
			redirect('article/trash/');
		}

		$this->data['currentsubpage'] = 'trash';
		$this->data['pagetitle'] = 'Berichten in prullenbak';

		// Fetch all pages
		$this->data['articles'] = $this->article_m->get_trash();

		// Load view
		$this->data['subview'] = 'article/trash';
		$this->load->view('_layout_main', $this->data);
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
			$save = $this->article_m->save($data, $id);

			if(!empty($_FILES['thumbnail']['name'])) {
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/blog/" . $this->data['thumbnail'])) {
//                    unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail']);
					deleteThumbCache('blog/' . $this->data['thumbnail'], dirtitel($_POST['title']));
                }

				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/blog/" . $thumbnail);
				$this->article_m->save_thumbnail($thumbnail, $save);
			}

			if ($id)
				$this->system_m->log_event('article', $id, 'edit');
			else
			{
				$this->system_m->log_event('article', $save, 'add');

				// TODO: Twitter feed werkend maken
//				include($_SERVER['DOCUMENT_ROOT'] . '/system/Twitter/codebird.php');
//
//				\Codebird\Codebird::setConsumerKey("2eJTQn1VxRMDK2tXPM8TcPuCH", "ONVXugjKjTUh0qqKyh6ite7yPBNzJmSijVN5LV0MMcsf0TOonV");
//				$cb = \Codebird\Codebird::getInstance();
//				$cb->setToken("968710369-0goVuc4m0Vzj6ciKREe78mCoX1H4O6AHCfaWGKdR", "UdIPuAHeaf2LqYGkdRx6XS4Q98kzRheYGqSZK3CrcU5Hg");
//
//				$params = array(
//					'status' => 'Test Tweet ' . $website . '/nieuws/' . dirtitel($_POST['title']) . '/'
//				);
//				$reply = $cb->statuses_update($params);
			}


			redirect('article/edit/' . $save . '/success');
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