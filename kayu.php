<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class kayu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kayu = $this->db->get('tb_produk')->result();
        } else {
            $this->db->where('id', $id);
            $kayu = $this->db->get('tb_produk')->result();
        }
        $this->response($kayu, 200);
    }

    function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'nama_produk'          => $this->post('nama_produk'),
                    'harga_produk'    => $this->post('harga_produk'),
                    'stok_produk' => $this->put('stok_produk'),
                    'id_kategori' => $this->put('id_kategori'));
       if ($cek == 0)
        $this->db->where("id", $this->post('id'));
        $this->db->where("nama_produk", $this->post('id'));
        { $cek =$this->db->get('tb_produk') ->num_rows();
                           $insert = $this->db->insert('tb_produk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));}
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama_produk'          => $this->put('nama_produk'),
                    'harga_produk'    => $this->put('harga_produk'),
                    'stok_produk' => $this->put('stok_produk'),
                    'id_kategori' => $this->put('id_kategori'));
        $this->db->where('id', $id);
        $update = $this->db->update('tb_produk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tb_produk');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>