<?php
class hepa_model extends CI_Model
{

    public function getData($table) // sebab dah call nama table dalam controller Siswa
    {
        $query = $this->db->get($table);
        return $query;
    }

    public function getProgramById($where, $table)
    {
        $this->db->where($where);
        return $this->db->get($table);
    }

    public function createProgram($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function updateProgram($data, $table)
    {
        $this->db->where('PROGRAM_ID', $data['PROGRAM_ID']);
        $this->db->update($table, $data);
    }
    public function deleteProgram($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
