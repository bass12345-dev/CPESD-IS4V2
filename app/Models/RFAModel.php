<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class RFAModel extends Model
{
  protected $db;
     
     public function __construct(ConnectionInterface &$db){
       parent::__construct();
       $this->db =& $db;
    }
  
    public function get_last_ref_number_where($where){
         
        $builder = $this->db->table('rfa_transactions');
        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y') = '".$where."' ");
        $builder->orderBy('rfa_date_filed','desc');
        $query = $builder->get();
        return $query;
        
    }

    public function verify_ref_number($where){

        $builder = $this->db->table('rfa_transactions');
        $builder->where("DATE_FORMAT(rfa_transactions.rfa_date_filed,'%Y-%m') = '".$where['rfa_date_filed']."' ");
        $builder->where('number',$where['number']);
        $query = $builder;
        return $query;
    }


    public function getAllRFATransactions($order_key,$order_by){

        $builder = $this->db->table('rfa_transactions');
        $builder->join('users','users.user_id = rfa_transactions.rfa_created_by');
        $builder->orderBy($order_key, $order_by);
        $query = $builder->get()->getResult();
        return $query;
    }
}
