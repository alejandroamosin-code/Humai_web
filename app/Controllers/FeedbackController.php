<?php

namespace App\Controllers;

use App\Models\FeedbackModel;
use CodeIgniter\Controller;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbackModel = new FeedbackModel();

        $data['feedbacks'] = $feedbackModel->getFeedbackWithUsersPaginated(7);
        $data['pager'] = $feedbackModel->pager;

        return view('feedback', $data);
    }

    public function delete($id)
    {
        $feedbackModel = new FeedbackModel();
        $feedbackModel->delete($id);

        return redirect()->to('/feedback')->with('message', 'Feedback deleted successfully');
    }

    public function search()
    {
        $keyword = $this->request->getPost('keyword');
        $feedbackModel = new FeedbackModel();

        $data['feedbacks'] = $feedbackModel
            ->select('feedback.*, user.first_name, user.last_name')
            ->join('user', 'user.id = feedback.user_id', 'left')
            ->like('feedback.comments', $keyword)
            ->orLike('user.first_name', $keyword)
            ->orLike('user.last_name', $keyword)
            ->orderBy('feedback.created_at', 'DESC')
            ->paginate(7);

        $data['pager'] = $feedbackModel->pager;

        return view('feedback', $data);
    }
}
