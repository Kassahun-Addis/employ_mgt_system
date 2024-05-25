<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    function department()
    {
        return $this->belongsTo(Department::class);
    }
    protected $fillable = ['title', 'full_name', 'photo','address','mobile','status'];
}
