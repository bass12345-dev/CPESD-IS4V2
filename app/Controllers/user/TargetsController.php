<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class TargetsController extends BaseController
{
    public function index()
    {
         if (session()->get('user_type') == 'user') {
        $data['title'] = 'Targets';
        return view('user/targets/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
