<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "candidates";
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'year',
    ];
}
