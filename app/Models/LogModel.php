<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'action_id','detail', 'log_date'];

    public function getLogsWithUsersPaginated($perPage = 7)
    {
        return $this->select('logs.*,action.description as action, user.first_name, user.last_name')
                    ->join('user', 'user.id = logs.user_id')
                    ->join('action', 'action.id = logs.action_id')
                    ->orderBy('logs.log_date', 'DESC')
                    ->paginate($perPage);
    }
}
