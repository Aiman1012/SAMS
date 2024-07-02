<?php
class hepa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getData($table) // sebab dah call nama table dalam controller Siswa
    {
        $query = $this->db->get($table);
        return $query;
    }

    public function getProgramByIdFromSuratHepa($PROGRAM_ID)
    {
        $this->db->where('PROGRAM_ID', $PROGRAM_ID);
        $query = $this->db->get('TBL_SURAT_HEPA');
        return $query->row(); // Assuming you expect only one row, use row() instead of result()
    }

    public function getProgramByIdFromProgram($PROGRAM_ID)
    {
        $this->db->select('*');
        $this->db->from('TBL_PROGRAM');
        $this->db->where('PROGRAM_ID', $PROGRAM_ID);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row(); // Return the row object if it exists
        } else {
            return null; // Return null if no row found
        }
    }




    public function createProgram($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function updateProgram($data, $table)
    {
        $this->db->where('PROGRAM_ID', $data['PROGRAM_ID']);
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            log_message('error', 'Failed to update program: ' . $this->db->last_query());
            return false;
        }
    }


    public function deleteProgram($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function approveProgram($data)
    {
        return $this->db->insert('TBL_SURAT_HEPA', $data);
    }

    public function getAllProgramsWithDetails()
    {
        $this->db->select('TBL_PROGRAM.*, TBL_SURAT_HEPA.*');
        $this->db->from('TBL_PROGRAM');
        $this->db->join('TBL_SURAT_HEPA', 'TBL_PROGRAM.PROGRAM_ID = TBL_SURAT_HEPA.PROGRAM_ID', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getProgramDetails($PROGRAM_ID)
    {
        $this->db->select('TBL_PROGRAM.*, TBL_SURAT_HEPA.*');
        $this->db->from('TBL_PROGRAM');
        $this->db->join('TBL_SURAT_HEPA', 'TBL_PROGRAM.PROGRAM_ID = TBL_SURAT_HEPA.PROGRAM_ID', 'left');
        $this->db->where('TBL_PROGRAM.PROGRAM_ID', $PROGRAM_ID);
        $query = $this->db->get();
        return $query->row();
    }
}
