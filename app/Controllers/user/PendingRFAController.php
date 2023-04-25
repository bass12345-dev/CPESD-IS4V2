<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Custom_config;

class PendingRFAController extends BaseController
{
    protected $CustomModel;
    public    $rfa_transactions_table = 'rfa_transactions';
     public    $type_of_request_table    = 'type_of_request';
    public    $order_by_desc                = 'desc';
    public    $order_by_asc                 = 'asc';

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel              = new CustomModel($db); 
       $this->config                   = new Custom_config;
        
    }
    public function index()
    {
        
        if (session()->get('user_type') == 'user') {
        $data['title'] = 'Pending RFA';
        return view('user/rfa/pending/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update_rfa(){
        
        if (session()->get('user_type')      == 'user') {


        $data['rfa_data']            = $this->CustomModel->getwhere($this->rfa_transactions_table,array('rfa_id' => $_GET['id']))[0];


        $data['title']                       = "UPDATE".' REFERENCE NO '.date('Y', strtotime($data['rfa_data']->rfa_date_filed)).' - '.date('m', strtotime($data['rfa_data']->rfa_date_filed)).' - '.$data['rfa_data']->number;
        $data['barangay']                   = $this->config->barangay;
        $data['employment_status']          = $this->config->employment_status;
        $data['type_of_request'] = $this->CustomModel->get_all_desc($this->type_of_request_table,'type_of_request_name',$this->order_by_desc);
        $data['type_of_transactions']          = $this->config->type_of_transactions;
        return view('user/rfa/pending/update_section/index',$data);

        }else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
    }
}
