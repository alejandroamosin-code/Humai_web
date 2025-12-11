<?php

namespace App\Controllers;

use App\Models\FaqModel;
use CodeIgniter\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqModel = new FaqModel();
        $data['faqs'] = $faqModel->findAll();

        return view('faq', $data);
    }

    public function edit($id)
    {
        $faqModel = new FaqModel();
        $data['faq'] = $faqModel->find($id);

        return view('faq', $data);
    }

    public function update($id)
    {
        $faqModel = new FaqModel();

        $faqModel->update($id, [
            'question' => $this->request->getPost('question'),
            'answer'   => $this->request->getPost('answer')
        ]);

        return redirect()->to('/faq');
    }

    public function delete($id)
    {
        $faqModel = new FaqModel();
        $faqModel->delete($id);

        return redirect()->to('/faq');
    }
}