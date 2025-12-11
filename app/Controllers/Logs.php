<?php

namespace App\Controllers;

use App\Models\LogModel;

class Logs extends BaseController
{
    public function index()
    {
        $logModel = new LogModel(); // Load the LogModel
        $data['logs'] = $logModel->getLogsWithUsersPaginated(); // Fetch the logs with user info
        $data['pager']=$logModel->pager;

        // Load the view and pass the logs data
        return view('logs', $data);
    }
}