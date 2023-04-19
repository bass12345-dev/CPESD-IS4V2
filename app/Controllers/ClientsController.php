<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ClientsController extends BaseController
{
    public function index()
    {
   
        $data['title'] = 'Clients';
        return view('global/clients/index',$data);
       
    }
}
