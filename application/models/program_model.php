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
        return $this->db->get_where($table, $where);
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
    public function getAssignedPrograms($pengarahMatric)
    {
        $this->db->select('*');
        $this->db->from('TBL_PROGRAM');
        $this->db->where('PENGARAH_MATRIC', $pengarahMatric); // Assuming you have a column for PENGARAH_MATRIC in TBL_PROGRAM
        return $this->db->get();
    }

    public function getAllPrograms()
    {
        $query = $this->db->get('TBL_PROGRAM');
        return $query->result();
    }

    public function getProgramsByStatus($status)
    {
        $this->db->where('APPROVAL_STATUS', $status);
        $query = $this->db->get('TBL_PROGRAM');
        return $query->result();
    }

    public function get_program_details($PROGRAM_ID)
    {
        $this->db->select('TBL_PROGRAM.*, TBL_SURAT_HEPA.*');
        $this->db->from('TBL_PROGRAM');
        $this->db->join('TBL_SURAT_HEPA', 'TBL_PROGRAM.PROGRAM_ID = TBL_SURAT_HEPA.PROGRAM_ID', 'left');
        $this->db->where('TBL_PROGRAM.PROGRAM_ID', $PROGRAM_ID);
        $query = $this->db->get();
        return $query->row();
    }
}
