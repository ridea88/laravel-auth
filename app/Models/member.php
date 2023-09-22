<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;


    protected $table = "members";
    protected $primeryKey = "id";
    protected $fillable = ["name","email","password","role"];

}
