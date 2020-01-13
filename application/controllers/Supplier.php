<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Supplier extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('supplier_model','supplier');
        if(!$this->session->userdata('user')){
            redirect('/');
        }

    }

    public function index()
    {
        $this->load->view('admin/supplier/list');
    }

    public function get_list()
    {
        
        $list = $this->supplier->get_all();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $supplier) {
            $no++;
            $row = array();
   
            $row[] = $supplier->nama_supplier;
            $row[] = $supplier->alamat;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_supplier('."'".$supplier->id."'".')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_supplier('."'".$supplier->id."'".')"><i class="fas fa-trash"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->supplier->count_all(),
                        "recordsFiltered" => $this->supplier->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->supplier->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'nama_supplier' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'user_id' => $this->input->post('user_id'),
            );
        $insert = $this->supplier->save($data);
        echo json_encode(array("status" => TRUE));
    }
   
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama_supplier' => $this->input->post('nama_supplier'),
                'alamat' => $this->input->post('alamat'),
                'user_id' => $this->input->post('user_id'),
            );
        $this->supplier->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->supplier->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_supplier') == '')
        {
            $data['inputerror'][] = 'nama_supplier';
            $data['error_string'][] = 'Nama supplier Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('alamat') == '')
        {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat supplier Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}