<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class RFADashboardController extends BaseController
{
    public function index()
    {
        if (session()->get('user_type') == 'admin') {
            $data['title']                              = 'RFA Dashboard';
        
            return view('admin/rfa_dashboard/index',$data);
        }else {
           throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
