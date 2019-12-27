<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Produk extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model','produk');
        if(!$this->session->userdata('user')){
            redirect('/');
        }

    }

    public function index()
    {
        $this->load->view('admin/produk/list-all');
    }
 
    public function list_makanan()
    {
        $this->load->view('admin/produk/list-makanan');
    }
    public function list_minuman()
    {
        $this->load->view('admin/produk/list-minuman');
    }
    public function get_all_list()
    {
        $list = $this->produk->get_data_all();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = $produk->id;
            $row[] = $produk->nama_produk;
            $row[] = $produk->jenis_produk;
            $row[] = $produk->harga_produk;
            $row[] = $produk->stock;
 
            
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->produk->count_all(),
                        "recordsFiltered" => $this->produk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function get_list1()
    {
        $list = $this->produk->get_datatables1();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = $produk->id;
            $row[] = $produk->nama_produk;
            $row[] = $produk->harga_produk;
            $row[] = $produk->stock;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk('."'".$produk->id."'".')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$produk->id."'".')"><i class="fas fa-trash"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->produk->count_all(),
                        "recordsFiltered" => $this->produk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function get_list2()
    {
        
        $list = $this->produk->get_datatables2();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
   
            $row[] = $produk->id;
            $row[] = $produk->nama_produk;
            $row[] = $produk->harga_produk;
            $row[] = $produk->stock;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk('."'".$produk->id."'".')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$produk->id."'".')"><i class="fas fa-trash"></i></a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->produk->count_all(),
                        "recordsFiltered" => $this->produk->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id)
    {
        $data = $this->produk->get_by_id($id);
        echo json_encode($data);
    }
 
    public function ajax_add1()
    {
        $this->_validate();
        $data = array(

                'nama_produk' => $this->input->post('nama_produk'),
                'jenis_produk' => 'makanan',
                'harga_produk' => $this->input->post('harga_produk'),
                'stock' => $this->input->post('stock'),
                'user_id' => $this->input->post('user_id'),
            );
        $insert = $this->produk->save($data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_add2()
    {
        $this->_validate();
        $data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'jenis_produk' => 'minuman',
                'harga_produk' => $this->input->post('harga_produk'),
                'stock' => $this->input->post('stock'),
                'user_id' => $this->input->post('user_id'),
            );
        $insert = $this->produk->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'harga_produk' => $this->input->post('harga_produk'),
            'stock' => $this->input->post('stock'),
            'user_id' => $this->input->post('user_id'),
            );
        $this->produk->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($id)
    {
        $this->produk->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
 
        if($this->input->post('nama_produk') == '')
        {
            $data['inputerror'][] = 'nama_produk';
            $data['error_string'][] = 'Nama Produk Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('harga_produk') == '')
        {
            $data['inputerror'][] = 'harga_produk';
            $data['error_string'][] = 'Harga Produk Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('stock') == '')
        {
            $data['inputerror'][] = 'stock';
            $data['error_string'][] = 'Stock Produk Harus Diisi';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 
}