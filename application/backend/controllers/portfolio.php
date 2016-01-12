<?php
class Portfolio extends Admin_Controller
{

	public function __construct () {
		parent::__construct();
		$this->load->model('portfolio_m');
		$this->data['currentpage'] = 'portfolio';
	}

	public function index ($restore = NULL, $restore_id = NULL) {
		if(in_multiarray('portfolio', $this->data['modules_enabled'])) {
			if($restore == 'restore' && is_numeric($restore_id)) {
				$data = array(
							'active' => '1', 
						);
				$this->portfolio_m->save($data, $restore_id);
				$this->system_m->log_event('portfolio', $restore_id, 'restore');
				redirect('portfolio/');
				// $this->data['restored'] = 'true';
			}

			$this->data['currentsubpage'] = 'overview';
			$this->data['pagetitle'] = 'Alle portfolio items\'s';

			// Fetch all pages
			$this->data['items'] = $this->portfolio_m->get();
			
			// Load view
			$this->data['subview'] = 'portfolio/index';
			$this->load->view('_layout_main', $this->data); 
		} else {
			$this->data['pagetitle'] = 'Module uitgeschakeld';
			$this->data['subview'] = 'components/disabled';
			$this->load->view('_layout_main', $this->data); 
		}
	}

	public function trash ($id = NULL, $delete = NULL) {
		if($id) {
			if($delete == "item") {
				$this->portfolio_m->delete($id);
				$this->system_m->log_event('portfolio', $id, 'delete');
				redirect('portfolio/trash/');
			}
			$data = array(
						'active' => '0', 
					);
			$this->portfolio_m->save($data, $id);
			$this->system_m->log_event('portfolio', $id, 'trash');
			redirect('portfolio/trash/');
		}

		$this->data['currentsubpage'] = 'trash';
		$this->data['pagetitle'] = 'Pagina\'s in prullenbak';

		// Fetch all pages
		$this->data['items'] = $this->portfolio_m->get_trash();
		
		// Load view
		$this->data['subview'] = 'portfolio/trash';
		$this->load->view('_layout_main', $this->data); 
	}

	public function edit ($id = NULL) {
		// Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->portfolio_m->get($id, '');
			count($this->data['item']) || $this->data['errors'][] = 'page could not be found';
			$this->data['pagetitle'] = $this->data['item']->title . ' - bewerk pagina';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['item'] = $this->portfolio_m->get_new();
			$this->data['pagetitle'] = 'Nieuwe pagina';
			$this->data['currentsubpage'] = 'nieuw';
		}
		
		// Set up the form
		$rules = $this->portfolio_m->rules;
		$this->form_validation->set_rules($rules);

		// Select all categories
		$this->data['categories'] = $this->portfolio_m->getCategories();

		// Select all attached gallerij pictures
		$this->data['item']->images = $this->portfolio_m->getImages($id);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->portfolio_m->array_from_post(array(
				'title', 
				'body',
				'meta_title', 
				'meta_description',
			));
			$save = $this->portfolio_m->save($data, $id);

			if(!empty($_FILES['thumbnail']['name'])) {
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/portfolio/" . $this->data['thumbnail'])) {
//                    unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail']);
					deleteThumbCache('portfolio/' . $this->data['thumbnail'], dirtitel($_POST['title']));
                }

				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/portfolio/" . $thumbnail);
				$this->portfolio_m->save_thumbnail($thumbnail, $save);
			}

			if ($id)
				$this->system_m->log_event('portfolio', $id, 'edit');
			else
				$this->system_m->log_event('portfolio', $save, 'add');

			redirect('portfolio/edit/' . $save . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'portfolio/edit';
		$this->load->view('_layout_main', $this->data);
	}

	/*
	 * Categories
	 */
	public function categories ($id = NULL, $delete = NULL) {
		$this->data['currentpage'] = 'portfolio_cat';
		if($id) {
			if($delete == "item") {
				$this->portfolio_m->delete($id);
				redirect('portfolio/categories/');
			}
			$data = array(
				'active' => '0',
			);
			$this->portfolio_m->save($data, $id);
			redirect('portfolio/categories/');
		}

		$this->data['currentsubpage'] = 'overview';
		$this->data['pagetitle'] = 'Portfolio categorieën';

		// Fetch all pages
		$this->data['items'] = $this->portfolio_m->getCategories();

		// Load view
		$this->data['subview'] = 'portfolio/categories';
		$this->load->view('_layout_main', $this->data);
	}

	public function categories_edit ($id = NULL) {
		$this->data['currentpage'] = 'portfolio_cat';
		// Fetch a page or set a new one
		if ($id) {
			$this->data['item'] = $this->portfolio_m->get($id, '', '1');
			count($this->data['item']) || $this->data['errors'][] = 'categorie could not be found';
			$this->data['pagetitle'] = $this->data['item']->title . ' - bewerk categorie';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
				$this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['item'] = $this->portfolio_m->get_new();
			$this->data['pagetitle'] = 'Nieuwe categorie';
			$this->data['currentsubpage'] = 'nieuw';
		}

		// Set up the form
		$rules = $this->portfolio_m->rules;
		$this->form_validation->set_rules($rules);

		// Process the form
		if ($this->form_validation->run() == TRUE) {
			$data = $this->portfolio_m->array_from_post(array(
				'title'
			));
			$save = $this->portfolio_m->save($data, $id, '1');

			if ($id)
				$this->system_m->log_event('portfolio-cat', $id, 'edit');
			else
				$this->system_m->log_event('portfolio-cat', $save, 'add');

			redirect('portfolio/categories_edit/' . $save . '/success');
		}

		// Load the view
		$this->data['subview'] = 'portfolio/categories_edit';
		$this->load->view('_layout_main', $this->data);
	}
}