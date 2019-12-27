<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Purchase extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_model','purchase');
        if(!$this->session->userdata('user')){
            redirect('/');
        }

    }

    public function index()
    {
        $this->load->view('admin/purchase/list');
    }

    public function get_list()
    {
        $list = $this->purchase->get_all();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $purchase) {
            $no++;
            $row = array();
            $row[] = $purchase->id;
            $row[] = $purchase->produk_id;
            $row[] = $purchase->supplier_id;
            $row[] = $purchase->qty;
            $row[] = $purchase->tanggal_purchase;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="detail_purchase('."'".$purchase->id."'".')"><i class="fas fa-search"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->purchase->count_all(),
                        "recordsFiltered" => $this->purchase->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->purchase->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add1()
    {
        $this->_validate();
        $data = array(
                'produk_id' => $this->input->post('produk_id'),
                'supplier_id' => $this->input->post('supplier_id'),
                'qty' => $this->input->post('qty'),
                'user_id' => $this->input->post('user_id'),
            );
        $insert = $this->purchase->save($data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'produk_id' => $this->input->post('produk_id'),
                'supplier_id' => $this->input->post('supplier_id'),
                'qty' => $this->input->post('qty'),
                'user_id' => $this->input->post('user_id'),
            );
        $this->purchase->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->purchase->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('produk_id') == '')
        {
            $data['inputerror'][] = 'produk_id';
            $data['error_string'][] = 'Kode purchase Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('supplier_id') == '')
        {
            $data['inputerror'][] = 'supplier_id';
            $data['error_string'][] = 'Nama purchase Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('qty') == '')
        {
            $data['inputerror'][] = 'qty';
            $data['error_string'][] = 'Harga purchase Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}