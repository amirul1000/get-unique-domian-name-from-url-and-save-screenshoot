<?php

/**
 * Author: Amirul Momenin
 * Desc:Website Model
 */
class Website_model extends CI_Model
{

    protected $website = 'website';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get website by id
     *
     * @param $id -
     *            primary key to get record
     *            
     */
    function get_website($id)
    {
        $result = $this->db->get_where('website', array(
            'id' => $id
        ))->row_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Get all website
     */
    function get_all_website()
    {
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('website')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Get limit website
     *
     * @param $limit -
     *            limit of query , $start - start of db table index to get query
     *            
     */
    function get_limit_website($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('website')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Count website rows
     */
    function get_count_website()
    {
        $result = $this->db->from("website")->count_all_results();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * function to add new website
     *
     * @param $params -
     *            data set to add record
     *            
     */
    function add_website($params)
    {
        $this->db->insert('website', $params);
        $id = $this->db->insert_id();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $id;
    }

    /**
     * function to update website
     *
     * @param $id -
     *            primary key to update record,$params - data set to add record
     *            
     */
    function update_website($id, $params)
    {
        $this->db->where('id', $id);
        $status = $this->db->update('website', $params);
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $status;
    }

    /**
     * function to delete website
     *
     * @param $id -
     *            primary key to delete record
     *            
     */
    function delete_website($id)
    {
        $status = $this->db->delete('website', array(
            'id' => $id
        ));
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $status;
    }
}
