<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $allowedFields = ['comments', 'user_id', 'created_at'];
    protected $useTimestamps = false;

    public function getFeedbackWithUsersPaginated($perPage = 7)
    {
        return $this->select('feedback.*, user.first_name, user.last_name')
                    ->join('user', 'user.id = feedback.user_id', 'left')
                    ->orderBy('feedback.created_at', 'DESC')
                    ->paginate($perPage);
    }
}
