<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // bool
    public function Login($data)
    {
        $query = $this->db->query( "SELECT email FROM account WHERE email='{$data['email']}' AND password='{$data['password']}'" );

        if( $query->num_rows() )
            return TRUE;
        
        return FALSE;
    }

    // JSON
    public function GetAccountData($value=NULL,$type=NULL)
    {
        $this->db->select('*')->from('account');
        ( is_array($value) ) ?  $this->db->where_in( $type,implode(",",$value) ) : $this->db->where($type,$value)->limit(1) ;
        $query = $this->db->get();

        foreach($query->result() as $row) {
            if( is_array($value) )
                $rowdata[$row->id] = Array(
                    'id'       => $row->id,
                    'name'     => $row->name,
                    'email'    => $row->email
                );
            else
                $rowdata = Array(
                    'id'       => $row->id,
                    'name'     => $row->name,
                    'email'    => $row->email
                );
        }
            

        return (isset($rowdata)) ? json_encode($rowdata) : FALSE;
    }

    public function Register($data)
    {
        $data = Array(
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email']
        );

        // 防空
        foreach($data as $val)
            ($val === '' || $val === NULL) ? exit() : '';

        $this->db->insert("account", $data);
        return $this->db->insert_id();
    }
    
    // 檢查 Email 是否存在 : bool
    public function MailExists($email)
    {
        $query = $this->db->query( "SELECT email FROM account WHERE email='{$email}'" );

        if( $query->num_rows() )
            return TRUE;

        return FALSE;
    }

    // bool
    public function AccountCheck($data)
    {
        $query = $this->db->query( "SELECT email FROM account WHERE email='{$data['email']}' AND password='{$data['password']}'" );

        if( $query->num_rows() )
            return TRUE;

        return FALSE;
    }
}
