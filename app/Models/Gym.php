<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $table = "tbl_gym";
    protected $fillable = ["name", "city", "latitude", "longitude"];
}
