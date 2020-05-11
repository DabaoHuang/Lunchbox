<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function InsertOrder($data)
    {
        $this->db->insert('order',$data);
        return $this->db->insert_id();
    }

    public function InsertOrderItem($data)
    {
        $this->db->insert_batch('order_item',$data);
    }

    public function GetOrderCount($EventId)
    {
        $query = $this->db->select('COUNT(id) as total, event_id')->from('order')->where_in('event_id',$EventId)->group_by('event_id')->get();
        $data = array();
        foreach($query->result('array') as $row)
            $data[$row['event_id']] = $row['total'];
        return $data;
    }

    /*
    public function GetEventOrder($UserId) (
        'data'=>
            'event_id'=>
                'end_time'=>
                    end_time
                'starter_id'=>
                    starter_id
                'restaurant_id'=>
                    restaurant_id
                'TotalPrice'=>
                    (Caculate_Price)
                'account_id'=>
                    '(n+1)'=>
                        Eid, Oid, item_id, Iname, starter_id, account_id, timestamp, Oavali, Eavali, end_time, retaurant_id
        'account'=>
            'account_id'=>
                id
        'restaurant'=>
            'restaurant_id'=>
                *
    )
    */
    public function GetEventOrder($UserId)
    {   
        $query = $this->db->select('`a`.`id` as `Eid`, `b`.`id` as `Oid`, `c`.`item_id`, `d`.`name` as `Iname` , `a`.`account_id` as `starter_id` , `b`.`account_id`, `b`.`timestamp`, `b`.`avali` as `Oavali`, `a`.`avali` as `Eavali`, `a`.`end_time`, `a`.`restaurant_id`, `c`.`number`, (`d`.`price` * `c`.`number`) as `UnitPrice`, `c`.`number`')
                          ->from('`event` `a`, `order` `b`, `order_item` `c`, `item` `d`')
                          ->where('a.id = b.event_id')->where('b.id = c.order_id')->where('c.item_id = d.id')
                          ->group_start()
                            ->where('b.account_id',$UserId)
                            ->or_where('a.account_id',$UserId)
                          ->group_end()
                          ->order_by('a.end_time, b.account_id','DESC')
                          ->get();
        foreach( $query->result('array') as $row ) {
            if(!isset($data['data'][$row['Eid']]['TotalPrice'][$row['account_id']]))
                $data['data'][$row['Eid']]['TotalPrice'][$row['account_id']] = 0 ;
            $data['data'][$row['Eid']]['starter_id'] = $row['starter_id'];
            $data['data'][$row['Eid']]['orders'][$row['account_id']][] = $row;
            $data['data'][$row['Eid']]['end_time'] = $row['end_time'];
            $data['data'][$row['Eid']]['TotalPrice'][$row['account_id']] += $row['UnitPrice'] ;
            $data['data'][$row['Eid']]['restaurant_id'] = $row['restaurant_id'];
            $data['account'][$row['account_id']] = $row['account_id'];
            $data['restaurant'][$row['restaurant_id']] = $row['restaurant_id'];
            $data['event'][$row['Eid']] = $row['Eid'];
        } // end foreach
        return (isset($data)) ? $data : FALSE;
    }
}
