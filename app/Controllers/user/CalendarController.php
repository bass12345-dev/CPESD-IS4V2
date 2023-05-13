<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class CalendarController extends BaseController
{
    public function index()
    {
        if (session()->get('user_type') == 'user') {
        $data['title'] = 'Calendar of Activities';
        return view('user/calendar/index',$data);
        }else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
