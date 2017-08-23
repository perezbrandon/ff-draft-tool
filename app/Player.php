<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function getDates()
    {
        return ['created_at', 'updated_at', 'dob'];
    }
}
