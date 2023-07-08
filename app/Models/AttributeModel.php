<?php

namespace App\Models;

use CodeIgniter\Model;

class AttributeModel extends Model
{
    protected $table = 'attributes';
    protected $primaryKey = 'attr_id';
    protected $DBGroup = 'default';
    protected $allowedFields = ['attr_id', 'attr_name'];
}
