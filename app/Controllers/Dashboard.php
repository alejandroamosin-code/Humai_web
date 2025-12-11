<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DiagnosisModel;
use App\Models\DiseaseModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        // ✅ Get logged-in user data from session
        // $userName = $session->get('first_name') . ' ' . $session->get('last_name');

        $first = $session->get('first_name') ?? '';
        $last  = $session->get('last_name') ?? '';
        $userName = trim($first . ' ' . $last);


        // ✅ Load models
        $userModel = new UserModel();
        $diagnosisModel = new DiagnosisModel();
        $diseaseModel = new DiseaseModel();

        // ✅ Query counts
        $totalUsers = $userModel->countAllResults();
        $totalDiagnosis = $diagnosisModel->countAllResults();
        $totalDiseases = $diseaseModel->countAllResults();

        // ✅ Pass to view
        return view('dashboard', [
            'userName' => $userName,
            'totalUsers' => $totalUsers,
            'totalDiagnosis' => $totalDiagnosis,
            'totalDiseases' => $totalDiseases
        ]);
    }
}
