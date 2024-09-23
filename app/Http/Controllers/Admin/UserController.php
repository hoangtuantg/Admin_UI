<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\Role;

class UserController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {

    }

    public function show() //$id
    {
        return view('admin.pages.users.profile');
    }

    public function edit($id)
    {
  
    }

    public function resetPassword($id)
    {
 
    }
}
