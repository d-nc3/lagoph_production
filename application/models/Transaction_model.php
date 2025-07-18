db->get($this->_table)
->result_array();
}
public function get($id) {
return $this->db->where('id', $id)
->get($this->_table)
->row_array();
}
public function insert($data) {
$this->db->insert($this->_table, $data);
return $this->db->insert_id();
}
public function update($id, $data) {
$this->db->where('id', $id)
->update($this->_table, $data);
return $this->db->affected_rows();
}
public function delete($id) {
// Soft delete by updating 'deleted_at' timestamp
$this->db->where('id', $id)
->update($this->_table, $data);
return $this->db->affected_rows();
}
//***customized routines****:
public function get_by_name($transaction_name) {
$result = $this->db->select('id') // Select the 'id' column
->where('transaction_name', $transaction_name)
->get($this->_table)
->row_array(); // Fetch a single row as an associative array
return $result ? $result['id'] : null; // Return only the 'id' or null if not found
}
}
?>