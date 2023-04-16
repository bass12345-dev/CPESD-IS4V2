<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class CompletedTransactionsController extends BaseController
{
    public function index()
    {
         if (session()->get('user_type') == 'admin') {
            $data['title'] = 'Completed Transaction';
            return view('admin/transactions/completed/index',$data);
        }else {
           return redirect()->back();
        }
    }
}
