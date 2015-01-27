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
				redirect('_admin/page/');
				// $this->data['restored'] = 'true';
			}

			$this->data['currentsubpage'] = 'overview';
			$this->data['pagetitle'] = 'Alle pagina\'s';

			// Fetch all pages
			$this->data['pages'] = $this->page_m->get_with_parent();
			$this->data['pages_sub'] = $this->page_m->pageChilderen();
			// echo($this->data['pages_sub']);
			
			// Load view
			$this->data['subview'] = '_admin/page/index';
			$this->load->view('_admin/_layout_main', $this->data); 
		} else {
			$this->data['pagetitle'] = 'Module uitgeschakeld';
			$this->data['subview'] = '_admin/components/disabled';
			$this->load->view('_admin/_layout_main', $this->data); 
		}
	}

	public function trash ($id = NULL, $delete = NULL) {
		if($id) {
			if($delete == "page") {
				$this->page_m->delete($id);
				redirect('_admin/page/trash/');
			} else if($delete == "sub") {
				$this->page_m->delete($id, 'sub');
				redirect('_admin/page/trash/');
			}
			$data = array(
						'active' => '0', 
					);
			$this->page_m->save($data, $id);
			redirect('_admin/page/trash/');
		}

		$this->data['currentsubpage'] = 'trash';
		$this->data['pagetitle'] = 'Pagina\'s in prullenbak';

		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_trash();
		$this->data['pages_sub'] = $this->page_m->pageChilderen();
		// echo($this->data['pages_sub']);
		
		// Load view
		$this->data['subview'] = '_admin/page/trash';
		$this->load->view('_admin/_layout_main', $this->data); 
	}

	public function order () {
        if($this->session->userdata('rights') >= 2) {
			$this->data['currentpage'] = 'order';
			$this->data['sortable'] = TRUE;
			$this->data['subview'] = '_admin/page/order';
        } else {
			$this->data['currentpage'] = 'order';
            $this->data['pagetitle'] = 'Geen toegang';
            $this->data['subview'] = '_admin/components/rights';
        }
        $this->load->view('_admin/_layout_main', $this->data);
	}

	public function order_ajax () {
		// Save order from ajax call
		if (isset($_POST['sortable'])) {
			$this->page_m->save_order($_POST['sortable']);
		}
		
		// Fetch all pages
		$this->data['pages'] = $this->page_m->get_nested();
		
		// Load view
		$this->load->view('_admin/page/order_ajax', $this->data);
	}

	public function edit ($id = NULL, $sub = NULL) {
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id, '');
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			$this->data['pagetitle'] = $this->data['page']->title . ' - bewerk pagina';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
				$this->data['status'] = 'success';
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
			$data = $this->page_m->array_from_post(array(
				'title', 
				'body',
				'meta_title', 
				'meta_description',
			));
			$this->page_m->save($data, $id, $sub);

			if(!empty($_FILES['thumbnail']['name'])) {
				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $thumbnail);
				$this->page_m->save_thumbnail($thumbnail, $id, $sub);
			}
			redirect('_admin/page/edit/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = '_admin/page/edit';
		$this->load->view('_admin/_layout_main', $this->data);
	}

	public function sub ($id = NULL, $status = NULL) {
		// Fetch a page or set a new one
		if ($id) {
			$this->data['page'] = $this->page_m->get($id, '', 'sub');
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
			$this->data['pagetitle'] = $this->data['page']->title . ' - bewerk pagina';
			$this->data['currentsubpage'] = 'overview';
			if(isset($status)) {
				$this->data['status'] = 'success';
			}
		}
		else {
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
			$data = $this->page_m->array_from_post(array(
				'title', 
				'body',
				'meta_title', 
				'meta_description',
			));
			$this->page_m->save($data, $id, 'sub');

			if(!empty($_FILES['thumbnail']['name'])) {
				$thumbnail = dirtitel($_POST['title']) . "." . pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/page/" . $thumbnail);
				$this->page_m->save_thumbnail($thumbnail, $id, 'sub');
			}
			redirect('_admin/page/sub/' . $id . '/success');
		}
		
		// Load the view
		$this->data['subview'] = '_admin/page/edit';
		$this->load->view('_admin/_layout_main', $this->data);
	}

	public function _unique_slug ($str) {
		$id = $this->uri->segment(4);
		$this->db->where('url', $this->input->post('url'));
		! $id || $this->db->where('id !=', $id);
		$page = $this->page_m->get();
		
		if (count($page)) {
			$this->form_validation->set_message('_unique_slug', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
}