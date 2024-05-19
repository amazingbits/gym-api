<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = "tbl_session";
    protected $primaryKey = "session_id";
    public $timestamps = false;
}
