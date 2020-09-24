<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Class Item Model
 *
 * @author Anuj
 */
class Item_model extends CI_Model 
{
    /**
     * Table
     *
     * @var $table
     */
    public $table = 'data_items';

    public function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        return $this->db->select('*')->from($this->table)->get()->result_array();
    }

    /**
     * Search By Id
     *
     * @param int $id
     * @return array
     */
    public function searchById($id = null)
    {
        if($id)
        {
            return (array) $this->db->from($this->table)
                ->where('id', $id)
                ->get()
                ->row();
        }

        return [];
    } 
            
    /**
     * Update Item
     *
     * @param int $id
     * @param array $input
     * @return bool
     */
    public function updateItem($id = null, $input = array())
    {
        if($id && is_array($input) && count($input))
        {
            return $this->db->where('id', $id)
                ->update($this->table, $input);
        }

        return false;
    }

    /**
     * Delete Item
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id = null)
    {
        if($id)
        {
            return $this->db->where('id', $id)
                ->delete($this->table);
        }

        return false;
    }
}