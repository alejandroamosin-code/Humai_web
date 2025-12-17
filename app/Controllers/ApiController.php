<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiController extends ResourceController
{
    use ResponseTrait;

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // API: Get all users
    public function users()
    {
        try {
            $users = $this->userModel
                ->select('id, first_name, last_name, email, type_id, phone_number, registered_date')
                ->findAll();
            
            return $this->respond([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // API: Get single user
    public function user($id = null)
    {
        try {
            if (!$id) {
                return $this->fail([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 400);
            }

            $user = $this->userModel
                ->select('id, first_name, last_name, email, type_id, phone_number, registered_date')
                ->find($id);
            
            if (!$user) {
                return $this->failNotFound([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }
            
            return $this->respond([
                'success' => true,
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // API: Register (for mobile app)
    public function register()
    {
        try {
            $json = $this->request->getJSON(true);
            
            // Validate input
            $rules = [
                'first_name' => 'required|min_length[2]|max_length[50]',
                'last_name'  => 'required|min_length[2]|max_length[50]',
                'email'      => 'required|valid_email|is_unique[user.email]',
                'password'   => 'required|min_length[6]',
                'phone_number' => 'permit_empty|max_length[20]'
            ];

            if (!$this->validate($rules)) {
                return $this->fail([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors()
                ], 400);
            }
            
            $data = [
                'first_name'      => $json['first_name'],
                'last_name'       => $json['last_name'],
                'email'           => $json['email'],
                'password'        => $json['password'], // Will be hashed by model
                'phone_number'    => $json['phone_number'] ?? '',
                'type_id'         => $json['type_id'] ?? 2, // default user type
                'registered_date' => date('Y-m-d H:i:s')
            ];
            
            $userId = $this->userModel->insert($data);
            
            if (!$userId) {
                return $this->fail([
                    'success' => false,
                    'message' => 'Failed to create user'
                ], 500);
            }

            $user = $this->userModel
                ->select('id, first_name, last_name, email, type_id, phone_number, registered_date')
                ->find($userId);
            
            return $this->respondCreated([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // API: Login (for mobile app)
    public function login()
    {
        try {
            $json = $this->request->getJSON(true);
            
            $email = $json['email'] ?? '';
            $password = $json['password'] ?? '';
            
            if (empty($email) || empty($password)) {
                return $this->fail([
                    'success' => false,
                    'message' => 'Email and password are required'
                ], 400);
            }
            
            $user = $this->userModel->where('email', $email)->first();
            
            // Use the same logic as your web login (plain text for now)
            if (!$user || $password !== $user['password']) {
                return $this->failUnauthorized([
                    'success' => false,
                    'message' => 'Invalid email or password'
                ]);
            }
            
            // Remove password from response
            unset($user['password']);
            
            return $this->respond([
                'success' => true,
                'message' => 'Login successful',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // API: Update user
    public function updateUser($id = null)
    {
        try {
            if (!$id) {
                return $this->fail([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 400);
            }

            $json = $this->request->getJSON(true);
            
            $user = $this->userModel->find($id);
            if (!$user) {
                return $this->failNotFound([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }
            
            // Only update fields that are provided
            $updateData = [];
            if (isset($json['first_name'])) $updateData['first_name'] = $json['first_name'];
            if (isset($json['last_name'])) $updateData['last_name'] = $json['last_name'];
            if (isset($json['phone_number'])) $updateData['phone_number'] = $json['phone_number'];
            if (isset($json['password'])) $updateData['password'] = $json['password'];
            
            if (empty($updateData)) {
                return $this->fail([
                    'success' => false,
                    'message' => 'No data to update'
                ], 400);
            }

            $this->userModel->update($id, $updateData);
            
            $updatedUser = $this->userModel
                ->select('id, first_name, last_name, email, type_id, phone_number, registered_date')
                ->find($id);
            
            return $this->respond([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $updatedUser
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // API: Delete user
    public function deleteUser($id = null)
    {
        try {
            if (!$id) {
                return $this->fail([
                    'success' => false,
                    'message' => 'User ID is required'
                ], 400);
            }

            $user = $this->userModel->find($id);
            if (!$user) {
                return $this->failNotFound([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }
            
            $this->userModel->delete($id);
            
            return $this->respond([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->fail([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}