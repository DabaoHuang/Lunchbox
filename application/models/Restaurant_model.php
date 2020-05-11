<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function RestaurantEventCheck($data)
    {
        if(is_array($data))
            $query = $this->db->select('end_time')
                          ->from('event')
                          ->where('restaurant_id',$data['restaurant_id'])
                        //   ->where('account_id',$data['account_id'])
                          ->order_by('end_time','DESC')
                          ->limit(1)
                          ->get();
        else return FALSE;

        if($query->num_rows() > 0)
            $row = $query->result();
        else return TRUE;

        return ($row[0]->end_time > time()) ?  FALSE : TRUE;
    }
    
    public function RestaurantEvent($data)
    {
        if(is_array($data))
            $this->db->insert('event',$data);
    }

    /* Array( restaurant id => Array data row ) */
    public function GetRestaurant($Restid = NULL)
    {
        $query = ($Restid) 
                    ? ( (is_array($Restid)) 
                        ? $this->db->select('*')->from('restaurant')->where_in('id',$Restid) ->get() 
                        : $this->db->select('*')->from('restaurant')->where('id',$Restid)->get() ) 
                    : $this->db->get('restaurant') ;
        foreach($query->result('array') as $row)
            $data[$row['id']] = $row ;
        return $data;
    }

    /*
    public function GetRestaurantMenuList($restid=null) (
        'type'=>
            'type_id'=>
                id,name
        'menu'=>
            'restaurant_id=>
                'type_id'=>
                    'item_id'=>
                        id,name,price,type_id,restaurant_id
    )
    */
    public function GetRestaurantMenuList($restid=null)
    {
        if( is_null($restid) )
            $query = $this->db->get('item');
        else
            $query = $this->db->select('*')->from('item')->where('restaurant_id',$restid)->get();
        $query2 = $this->db->get('item_type');
        foreach($query2->result('array') as $row)
            $data['type'][$row['id']] = $row;
        
        foreach($query->result('array') as $row)
            $data['menu'][$row['restaurant_id']][$row['type_id']][$row['id']] = $row;
        return $data;
    }

    public function GetEvent($EventId = NULL,$UserId = NULL)
    {
        $query = 'SELECT a.*,b.name,c.name as Rname FROM event a, account b, restaurant c WHERE a.account_id = b.id AND a.restaurant_id = c.id AND avali = 1 AND end_time > ' . time();
        $query .= ($EventId) ? " AND a.id = {$EventId}" : '';
        $query .= ($UserId) ? " AND a.account_id = {$UserId}" : '';
        $query = $this->db->query($query);
        foreach($query->result('array') as $row)
            $data[] = $row;
        return (isset($data) && count($data) !== 0 ) ? $data : FALSE;
    }
}
