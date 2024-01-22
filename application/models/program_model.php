<?php
class program_model extends CI_Model
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
        $this->db->where('program_id', $data['program_id']);
        $this->db->update($table, $data);
    }
    public function deleteProgram($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getAssignedPrograms($pengarahMatric)
    {
        $this->db->select('*');
        $this->db->from('tbl_program');
        $this->db->where('pengarah_matric', $pengarahMatric); // Assuming you have a column for pengarah_matric in tbl_program
        return $this->db->get();
    }
}
