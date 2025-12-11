<?php

namespace App\Models;

use CodeIgniter\Model;

class DiseaseModel extends Model
{
    protected $table = 'diseases';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'type', 'cause'];
}
