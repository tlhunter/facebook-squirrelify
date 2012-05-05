<?php
class Modelname_model extends Model {

    function Modelname_model() {
        parent::Model();
    }
	
	function list_stuff() {
		$sql = "SELECT * FROM table_name";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_single_row($row_id) {
		$row_id += 0;
		$sql = "SELECT * FROM table_name WHERE id = $row_id LIMIT 1";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
}