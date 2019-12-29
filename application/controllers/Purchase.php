<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Purchase extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_model','purchase');
        $this->load->model('produk_model','produk');
        $this->load->model('supplier_model','supplier');
        if(!$this->session->userdata('user')){
            redirect('/');
        }

    }

    public function index()
    {
        $config['base_url'] = site_url('purchase/index'); //site url
        $config['total_rows'] = $this->purchase->count_all(); //total row
        $config['per_page'] = 5;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
	    $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['list'] = $this->purchase->get_all($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();
		$this->load->view('admin/purchase/list',$data);
    }
 
   public function add()
   {
       $this->_validate();
    if ($this->form_validation->run() == FALSE)
    {
       $data['list1'] = $this->produk->list();
       $data['list2'] = $this->supplier->list();
       
       $this->load->view('admin/purchase/add',$data);
    }
    else{
        $data = array(
            'produk_id' => $this->input->post('nama_produk'),
            'supplier_id' => $this->input->post('nama_supplier'),
            'qty' => $this->input->post('qty'),
            'user_id' => $this->input->post('user_id'),
        );
            $insert = $this->purchase->save($data);
        redirect('purchase/index');
    }
   }

   private function _validate()
   {
    $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
    $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
    $this->form_validation->set_rules('qty', 'Qty Produk', 'required|integer');
   }
 
}