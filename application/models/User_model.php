<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cek_user($username,$password)
    {
        $this->db->select('*');
        $this->db->from('t_user');
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getuser($where)
    {
        $this->db->select('*');
        $this->db->from('t_user');
        $this->db->where($where);
        $data = $this->db->get();
        return $data->result();
    }

    public function edit()
    {
        $password = $this->input->post('new_password');
        $id = $this->input->post('id');
        $this->db->set('password',md5($password));
        $this->db->where('id',$id);
        $this->db->update('t_user');
    }

}