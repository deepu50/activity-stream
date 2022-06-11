<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stud extends Model
{
    use HasFactory;
    protected $table="studs";
    protected $fillable=['firstname','lastname','email','phone'];
}
