<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class ReceivedController extends BaseController
{
        public function index()
    {
       if (session()->get('user_type')       == 'user') {

        $data['title']                       = 'Received RFA Transactions';
        return view('user/rfa/received/index',$data);

        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    
}
