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

    /**
     * Get list
     *
     * @return array
     **/
    public function getList()
    {
        return $this->db->select('*')
            ->from($this->table)
            ->get()
            ->result_array();
    } 

    /**
     * Search By Id
     *
     * @param int $id
     * @return array
     */
    public function searchUsingId($id = null)
    {
        die('TEST');
        if($id)
        {
            $query = $this->db->from($this->table)
                ->where('id', $id)
                ->get();

            print_r($query);die;
                //->row();
        }

        return [];
    }   
}