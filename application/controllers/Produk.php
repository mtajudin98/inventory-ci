<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Produk extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model','produk');
    }
 
    public function index()
    {
        $this->load->view('admin/produk/list');
    }
 
    public function get_list()
    {
        $list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = $produk->id;
            $row[] = $produk->kode_produk;
            $row[] = $produk->nama_produk;
            $row[] = $produk->jenis_produk;
            $row[] = $produk->harga_produk;
            $row[] = $produk->stock;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk('."'".$produk->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_produk('."'".$produk->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
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
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'jenis_produk' => $this->input->post('jenis_produk'),
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
            'kode_produk' => $this->input->post('kode_produk'),
            'nama_produk' => $this->input->post('nama_produk'),
            'jenis_produk' => $this->input->post('jenis_produk'),
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
 
        if($this->input->post('kode_produk') == '')
        {
            $data['inputerror'][] = 'kode_produk';
            $data['error_string'][] = 'Kode Produk Harus Diisi';
            $data['status'] = FALSE;
        }
 
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
 
        if($this->input->post('jenis_produk') == '')
        {
            $data['inputerror'][] = 'jenis_produk';
            $data['error_string'][] = 'Pilih Jenis Produk';
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