<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PendingRFAController extends BaseController
{
    public function index()
    {
        
         if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Pending RFA';
            return view('admin/rfa/pending/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
