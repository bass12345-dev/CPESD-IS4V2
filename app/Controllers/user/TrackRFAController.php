<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class TrackRFAController extends BaseController
{
        public function index()
    {
       if (session()->get('user_type')       == 'user') {

        $data['title']                       = 'Pending Transactions';
        return view('user/rfa/tracker/index',$data);

        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
