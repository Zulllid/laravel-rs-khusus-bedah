<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['no_rm', 'nik', 'name', 'gender', 'birth_date', 'phone', 'address'];
}
