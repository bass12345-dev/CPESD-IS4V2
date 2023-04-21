<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use Config\Custom_config;
use App\Models\CustomModel;

class ReceivedController extends BaseController
{

    public    $type_of_request_table        = 'type_of_request';
    public    $user_table                   = 'users';
    public    $order_by_desc                = 'desc';
    public    $order_by_asc                 = 'asc';
    protected $request;
    protected $CustomModel;
    public $config;

    public function __construct()
    {
       $db = db_connect();
       $this->CustomModel = new CustomModel($db); 
       $this->request = \Config\Services::request();  
       $this->config                   = new Custom_config;

    }
        public function index()
    {
       if (session()->get('user_type')       == 'user') {

        $data['title']                       = 'Received RFA Transactions';
        $data['users']                       = $this->CustomModel->get_all_order_by($this->user_table,'first_name',$this->order_by_asc);
        return view('user/rfa/received/index',$data);

        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
}
