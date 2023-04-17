<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PendingTransactionsController extends BaseController
{
    public function index()
    {
       if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Pending Transactions';
            return view('admin/transactions/pending/index',$data);
        }else {
           return redirect()->back();
        }
    }
}
