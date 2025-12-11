<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller
{
    public function index()
    {
        $path = FCPATH . 'uploads/';
        $files = [];

        if (is_dir($path)) {
            $files = array_diff(scandir($path), ['.', '..']);
        }

        return view('manage', ['files' => $files]);
    }

    public function upload()
    {
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $newName);
            return redirect()->to('/images')->with('success', 'Image uploaded successfully!');
        }

        return redirect()->to('/images')->with('error', 'Failed to upload image.');
    }
}
