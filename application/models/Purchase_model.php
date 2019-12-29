<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Purchase_model extends CI_Model {
 
    var $table = 't_purchase';
    var $column_order = array('id','nama_produk','nama_supplier','qty','tanggal_purchase',null); //set column field database for datatable orderable
    var $column_search = array('id','nama_produk','nama_supplier','qty','tanggal_purchase'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
 
    public function get_all($number,$offset)
    {
       $query= $this->db->query('select p.id, pr.nama_produk, s.nama_supplier, p.qty, p.tanggal_purchase from t_purchase p, t_produk pr, t_supplier s where p.produk_id = pr.id and p.supplier_id = s.id limit '.$number,$offset);
        return $query->result();
    }   
    
    
 
	function jumlah_data(){
		return $this->db->get($this->table)->num_rows();
    }
    
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
    
  
}