<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
	
	var $table = 'tbl_user';
	var $column_order = array(null, 'a.username','a.privilages_user','a.create_at','b.desc_priv'); //set column field database for datatable orderable
	var $column_search = array('a.username','a.privilages_user','a.create_at','b.desc_priv'); //set column field database for datatable searchable 
	var $order = array('a.id_user' => 'asc'); // default order 

	var $table2 = 'tbl_user_status';
	var $column_order2 = array(null, 'desc_user_status', 'color_user_status','allow_to_login'); //set column field database for datatable orderable
	var $column_search2 = array('desc_user_status', 'color_user_status','allow_to_login'); //set column field database for datatable searchable 
	var $order2 = array('id_user_status' => 'asc'); // default order 

	public function lihat($Value)
	{
		$this->db->select('a.id_user,a.username,a.privilages_user, c.user_fullname,c.photo, a.flag , a.company, e.desc_company');
		$this->db->join('tbl_online b', 'a.id_user = b.id_user');
		$this->db->join('tbl_user_desc c', 'a.id_user = c.id_user','left');
		$this->db->join('tbl_user_status d', 'a.flag = d.id_user_status', 'left');
		$this->db->join('tbl_company e', 'e.id_company = a.company', 'left');
		$this->db->where($Value);
		return $this->db->get('tbl_user a');
	}

	public function lihat2($Value)
	{
		$this->db->select('a.id_user,a.username,a.privilages_user, c.user_fullname,c.photo, a.flag, d.desc_user_status, d.color_user_status, d.allow_to_login, a.company, e.desc_company');
		// $this->db->join('tbl_online b', 'a.id_user = b.id_user');
		$this->db->join('tbl_user_desc c', 'a.id_user = c.id_user','left');
		$this->db->join('tbl_user_status d', 'a.flag = d.id_user_status', 'left');
		$this->db->join('tbl_company e', 'e.id_company = a.company', 'left');
		$this->db->where($Value);
		return $this->db->get('tbl_user a');
	}

	public function lihat_api($Value)
	{
		$this->db->select('a.id_user,a.username,a.privilages_user, c.user_fullname,c.photo, a.flag, d.desc_user_status, d.color_user_status, d.allow_to_login, a.company, e.desc_company, b.session_api');
		$this->db->join('tbl_online_api b', 'a.id_user = b.id_user');
		$this->db->join('tbl_user_desc c', 'a.id_user = c.id_user','left');
		$this->db->join('tbl_user_status d', 'a.flag = d.id_user_status', 'left');
		$this->db->join('tbl_company e', 'e.id_company = a.company', 'left');
		$this->db->where($Value);
		return $this->db->get('tbl_user a');
	}

	public function lihat_by($value= array())
	{
		# code...
		$this->db->select('id_user, username');
		$this->db->where($value);
		return $this->db->get($this->table);
	}

	public function insert_user($data)
	{
		$this->db->insert($this->table, $data);
		return true;
	}

	public function update_user($where, $data)
	{
		$this->db->where('id_user', $where);
		$this->db->update('tbl_user', $data);
		return $this->db->affected_rows();
	}
 
    private function _get_datatables_query()
	{
		$this->db->select('a.id_user, a.username, a.privilages_user, a.create_at,DATE_FORMAT(a.create_at,"%d/%m/%Y %H:%i:%s") as create_at, b.desc_priv,
						c.session, d.desc_user_status, d.color_user_status, a.company, e.desc_company');
		$this->db->from($this->table.' a');
		$this->db->join('tbl_privilages b', 'a.privilages_user = b.id_priv', 'left');
		$this->db->join('tbl_online c', 'a.id_user = c.id_user', 'left');
		$this->db->join('tbl_user_status d', 'a.flag = d.id_user_status', 'left');
		$this->db->join('tbl_company e', 'e.id_company = a.company', 'left');
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
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

	public function user_status_show($value=array())
	{
		# code...
		$this->db->select('id_user_status, desc_user_status, color_user_status, allow_to_login');
		$this->db->where($value);
		return $this->db->get('tbl_user_status');
	}

	private function _get_datatables_query_status()
	{
		$this->db->select('id_user_status, desc_user_status, color_user_status, allow_to_login');
		$this->db->from($this->table2);
		$this->db->where(array());
		$i = 0;
	
		foreach ($this->column_search2 as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search2) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order2))
		{
			$order = $this->order2;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_status()
	{
		$this->_get_datatables_query_status();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_status()
	{
		$this->_get_datatables_query_status();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_status()
	{
		$this->db->from($this->table2);
		return $this->db->count_all_results();
	}

	public function insert_status($data)
	{
		$this->db->insert($this->table2, $data);
		return true;
	}

	public function update_user_status($where, $data)
	{
		$this->db->where('id_user_status', $where);
		$this->db->update($this->table2, $data);
		return $this->db->affected_rows();
	}

}

/* End of file M_contoh.php */
/* Location: ./application/models/M_contoh.php */