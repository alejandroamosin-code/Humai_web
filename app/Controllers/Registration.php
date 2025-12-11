<?php

namespace App\Controllers;

use App\Models\UserModel;

class Registration extends BaseController
{
    public function index()
    {
        return view('registration'); // your register form
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'type_id'   => 1, // Force new users to Admin
            'phone_number' => $this->request->getPost('contact_number'),
            'registered_date'  => date('Y-m-d H:i:s')
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('success', 'Account created! Please login.');
    }
}
