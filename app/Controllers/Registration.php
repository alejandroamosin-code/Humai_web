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

        // Check if email already exists
        $email = $this->request->getPost('email');
        $existingUser = $userModel->where('email', $email)->first();
        
        if ($existingUser) {
            return redirect()->back()->with('error', 'Email already registered. Please use a different email.');
        }

        // Validate and format phone number
        $phone = $this->request->getPost('phone');
        $phone = preg_replace('/[^0-9]/', '', $phone); // Remove non-numeric characters
        
        // Remove leading 0 if present (for Philippine numbers)
        if (strlen($phone) == 11 && substr($phone, 0, 1) === '0') {
            $phone = substr($phone, 1);
        }
        
        // Check if phone is exactly 10 digits
        if (strlen($phone) != 10) {
            return redirect()->back()->with('error', 'Phone number must be 10 digits (e.g., 9957647823).');
        }

        $data = [
            'first_name'      => $this->request->getPost('first_name'),
            'last_name'       => $this->request->getPost('last_name'),
            'email'           => $email,
            'password'        => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'type_id'         => 1, // Force new users to Admin
            'phone_number'    => $phone,
            'registered_date' => date('Y-m-d H:i:s')
        ];

        $userModel->save($data);

        return redirect()->to('/login')->with('success', 'Account created! Please login.');
    }
}