<?php
class Page extends Admin_Controller
{

	public function __construct () {
		parent::__construct();
		$this->load->model('page_m');
		$this->data['currentpage'] = 'page';
	}

	public function index ($restore = NULL, $restore_id = NULL) {
		if(in_multiarray('page', $this->data['modules_enabled'])) {
			if($restore == 'restore' && is_numeric($restore_id)) {
				$data = array(
							'active' => '1', 
						);
				$this->page_m->save($data, $restore_id);
				$this->system_m->log_event('page', $restore_id, 'restore');
				redirect('page/');
				// $this->data['restored'] = 'true';
			}

			$this->data['currentsubpage'] = 'overview';
			$this->data['pagetitle'] = 'Alle pagina\'s';

			// Fetch all pages
			$this->data['pages'] = $this->page_m->get_with_parent();
			$this->data['pages_sub'] = $this->page_m->pageChilderen();
			
			// Load view
			$this->data['subview'] = 'page/index';
			$this->load->view('_layout_main', $this->data); 
		} else {
			$this->data['pagetitle'] = 'Module uitgeschakeld';
			$this->data['subview'] = 'components/disabled';
			$this->load->view('_layout_main', $this->data); 
		}
	}

    public function ajax () {
        if (isset($_POST['order'])) {
            $this->page_m->save_ajax($_POST['order']);
        }
        
    }

	public function trash ($id = NULL, $delete = NULL) {
		if($id) {
			if($delete == "page") {
				$this->page_m->delete($id);
				$this->system_m->log_event('page', $id, 'delete');
				redirect('page/trash/');
			} else if($delete == "sub") {
				$this->page_m->delete($id, 'sub');
				redirect('page/trash/');
			}
			$data = array(
						'active' => '0', 
					);
			$this->page_m->save($data, $id);
			$this->system_m->log_event('page', $id, 'trash');
			redirect('page/trash/');
		}

		$this->data['currentsubpage'] = 'trash';
		$this->data['pagetitle'] = 'Pagina\'s in prullenbak';

		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_trash();
		$this->data['pages_sub'] = $this->page_m->pageChilderen();
		
		// Load view
		$this->data['subview'] = 'page/trash';
		$this->load->view('_layout_main', $this->data); 
	}

	public function edit ($id = NULL, $sub = NULL) {
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id, '');
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			$this->data['pagetitle'] = $this->data['page']->title . ' - bewerk pagina';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['page'] = $this->page_m->get_new();
			$this->data['pagetitle'] = 'Nieuwe pagina';
			$this->data['currentsubpage'] = 'nieuw';
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->page_m->get_no_parents();
		
		// Set up the form
		$rules = $this->page_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
			($_POST['navigation_visible'] == 'NULL' || !isset($_POST['navigation_visible']) ? $_POST['navigation_visible'] = '0' : $_POST['navigation_visible'] = '1');
            if(!empty($_POST['id_parent']) && isset($_POST['id_parent'])) {
                $data = $this->page_m->array_from_post(array(
                    'title', 
                    'body',
                    'meta_title',
                    'meta_description',
                    'id_parent',
                ));
                $save = $this->page_m->save($data, $id, 'sub');
            } else {
                $data = $this->page_m->array_from_post(array(
                    'title', 
                    'body',
                    'meta_title',
                    'meta_description',
                    'navigation_visible',
                ));
                $save = $this->page_m->save($data, $id);
            }

			if(!empty($_FILES['thumbnail']['name'])) {
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail'])) {
//                    unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail']);
					deleteThumbCache('page/' . $this->data['thumbnail'], dirtitel($_POST['title']));
                }

				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $thumbnail);
                $this->page_m->save_thumbnail($thumbnail, $save, (!empty($_POST['id_parent']) && isset($_POST['id_parent']) ? 'sub' : ''));
			}

			if ($id)
				$this->system_m->log_event('page', $id, 'edit');
			else
				$this->system_m->log_event('page', $save, 'add');

			redirect('page/edit/' . $save . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'page/edit';
		$this->load->view('_layout_main', $this->data);
	}

	public function sub ($id = NULL, $status = NULL) {
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id, '', 'sub');
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			$this->data['pagetitle'] = $this->data['page']->title . ' - bewerk pagina';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
                $this->session->set_flashdata('success', 'success');
			}
		} else {
			$this->data['page'] = $this->page_m->get_new();
			$this->data['pagetitle'] = 'Nieuwe pagina';
			$this->data['currentsubpage'] = 'nieuw';
		}
		
		// Pages for dropdown
		$this->data['pages_no_parents'] = $this->page_m->get_no_parents();
		
		// Set up the form
		$rules = $this->page_m->rules;
		$this->form_validation->set_rules($rules);
		
		// Process the form
		if ($this->form_validation->run() == TRUE) {
            if($id) {
                $data = $this->page_m->array_from_post(array(
                    'title', 
                    'body',
                    'body_sidebar',
                    'meta_title', 
                    'meta_description'
                ));
            } else {
                $data = $this->page_m->array_from_post(array(
                    'title', 
                    'body',
                    'body_sidebar',
                    'meta_title', 
                    'meta_description',
                    'id_parent'
                ));
            }

			$id = $this->page_m->save($data, $id, 'sub');

			if(!empty($_FILES['thumbnail']['name'])) {
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $this->data['thumbnail']);
                }

				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $thumbnail);
				$this->page_m->save_thumbnail($thumbnail, $id, 'sub');
			}
			redirect('page/sub/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = 'page/edit';
		$this->load->view('_layout_main', $this->data);
	}
}