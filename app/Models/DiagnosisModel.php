<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosisModel extends Model
{
    protected $table = 'diagnosis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'image_path', 'disease_id','confidence','notes','date_diagnosed'];
}
