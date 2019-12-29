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
		$jumlah_data = $this->purchase->jumlah_data();
		$config['base_url'] = base_url().'index.php/welcome/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['list'] = $this->purchase->get_all($config['per_page'],$from);
		$this->load->view('admin/purchase/list',$data);
    }
 
   public function add()
   {
       $data['list1'] = $this->produk->list();
       $data['list2'] = $this->supplier->list();
       $this->load->view('admin/purchase/add',$data);
   }
 
}