<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class TransactionModel extends Model
{

    protected $db;

    public function __construct(ConnectionInterface &$db){
       parent::__construct();
       $this->db =& $db;
    }


    public function get_last_pmas_number_where($where){
         
        $builder = $this->db->table('transactions');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y') = '".$where."' ");
        $builder->orderBy('date_and_time_filed','desc');
        $query = $builder->get();
        return $query;
        
    }

    public function verify_pmas_number($where){

        $builder = $this->db->table('transactions');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m') = '".$where['date_and_time_filed']."' ");
        $builder->where('number',$where['number']);
        $query = $builder;
        return $query;
    }
    
    
    public function getAllTransactions($order_key,$order_by){
         
        $builder = $this->db->table('transactions');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->orderBy($order_key, $order_by);
        $query = $builder->get()->getResult();
        return $query;
        
    }



    ///ADMIN



    public function getAdminPendingTransactionsLimit(){

         $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where('transactions.transaction_status','pending');
        $builder->orderBy('transactions.number','desc');
        $builder->limit(10);
        $query = $builder->get()->getResult();
        return $query;
    }


    public function getAdminPendingTransactions(){

         $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where('transactions.transaction_status','pending');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;
    }


    public function getPendingTransactionDateFilter($filter_data) {

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(traactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
        $builder->where('transactions.transaction_status','pending');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function getCompletedTransactionDateFilterWhere($filter_data){

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
         $builder->where('transactions.type_of_activity_id',$filter_data['type_of_activity']);
        $builder->where('transactions.transaction_status','completed');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }

        public function getCompletedTransactionDateFilterWhereCSO($filter_data){

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
         $builder->where('transactions.type_of_activity_id',$filter_data['type_of_activity']);
         $builder->where('transactions.cso_Id',$filter_data['cso_Id']);
        $builder->where('transactions.transaction_status','completed');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }


    public function getCompletedTransactionDateFilter($filter_data){

        $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
        $builder->where('transactions.transaction_status','completed');
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;

    }




    public function count_transaction_chart($table,$m,$y,$status){

        $builder = $this->db->table('transactions');
        $builder->where('MONTH(date_and_time_filed)',$m);
        $builder->where('YEAR(date_and_time_filed)',$y);
        $builder->where('transactions.transaction_status',$status);
        $query = $builder->countAllResults();
        return $query; 

    }



    public function count_user_transaction_chart($table,$m,$y,$status,$where){

        $builder = $this->db->table('transactions');
        $builder->where('MONTH(date_and_time_filed)',$m);
        $builder->where('YEAR(date_and_time_filed)',$y);
        $builder->where('transactions.transaction_status',$status);
        $builder->where($where);
        $query = $builder->countAllResults();
        return $query; 

    }



    public function getUserPendingTransactions($where){

         $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where('transactions.transaction_status','pending');
        $builder->where('transactions.created_by',$where['created_by']);
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;
    }


    public function getUserCompletedTransactions($where){

         $builder = $this->db->table('transactions');
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where('transactions.transaction_status','completed');
        $builder->where('transactions.created_by',$where['created_by']);
        $builder->orderBy('transactions.number','desc');
        $query = $builder->get()->getResult();
        return $query;
    }

    public function getTransactionData($table,$where){

        $builder = $this->db->table($table);
        $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        $builder->join('users','users.user_id = transactions.created_by');
        $builder->join('cso','cso.cso_id = transactions.cso_Id');
        $builder->where($where);
        $query = $builder->get()->getResult();
        return $query;

    }


    public function get_report_total_sum_project_monitoring(){

        $builder = $this->db->table('transactions,project_monitoring');
        $builder->select('sum('.$column.') as Total');
        // $query = $builder->get()->getResult();
        // return $query;
    }

        // $builder->join('responsible_section','responsible_section.responsible_section_id = transactions.responsible_section_id');
        // $builder->join('type_of_activities','type_of_activities.type_of_activity_id = transactions.type_of_activity_id');
        // $builder->join('responsibility_center','responsibility_center.responsibility_center_id = transactions.responsibility_center_id');
        // $builder->join('users','users.user_id = transactions.created_by');
        // $builder->join('cso','cso.cso_id = transactions.cso_Id');
        // $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') >= '".$filter_data['start_date']."' ");
        // $builder->where("DATE_FORMAT(transactions.date_and_time_filed,'%Y-%m-%d') <= '".$filter_data['end_date']."'");
        //  $builder->where('transactions.type_of_activity_id',$filter_data['type_of_activity']);
        //  $builder->where('transactions.cso_Id',$filter_data['cso_Id']);
        // $builder->where('transactions.transaction_status','completed');
        // $builder->orderBy('transactions.number','desc');
        // $query = $builder->get()->getResult();
        // return $query;

}
