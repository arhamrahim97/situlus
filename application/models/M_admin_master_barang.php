<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin_master_barang extends CI_Model
{
    function cekMasterBarang($namaBarang)
    {
        $this->db->where('nama_barang', $namaBarang);
        return $this->db->get('master_barang')->row();
    }

    function insert($data)
    {
        return $this->db->insert('master_barang', $data);
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('master_barang', $data);
    }

    function getMasterBarang()
    {
        $data = $this->db->order_by('id', 'desc')->get('master_barang')->result();
        return $data;
    }
}
