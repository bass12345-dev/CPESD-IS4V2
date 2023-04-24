<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class PendingRFAController extends BaseController
{
    protected $CustomModel;
    public    $rfa_transactions_table = 'rfa_transactions';
    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel                    = new CustomModel($db); 
        
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
        return view('user/rfa/pending/update_section/index',$data);

        }else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
    }
}
