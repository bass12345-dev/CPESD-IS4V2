<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class ProjectMonitoringModel extends Model
{
     protected $db;
     
     public function __construct(ConnectionInterface &$db){
       parent::__construct();
       $this->db =& $db;
    }

    public function get_total_collection_sales(){

        $builder = $this->db->table('project_monitoring');
        $builder->select('sum(total_collection_sales) as Total');
        $query = $builder->get()->getResult();
        return $query;

    }


      public function get_total_released_purchases(){

        $builder = $this->db->table('project_monitoring');
        $builder->select('sum(total_released_purchases) as Total');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function get_total_cash_on_bank(){

        $builder = $this->db->table('project_monitoring');
        $builder->select('sum(cash_in_bank) as Total');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function get_total_cash_on_hand(){

        $builder = $this->db->table('project_monitoring');
        $builder->select('sum(cash_on_hand) as Total');
        $query = $builder->get()->getResult();
        return $query;

    }



        public function get_total_inventories(){

        $builder = $this->db->table('project_monitoring');
        $builder->select('sum(inventories) as Total');
        $query = $builder->get()->getResult();
        return $query;

    }

    
}
