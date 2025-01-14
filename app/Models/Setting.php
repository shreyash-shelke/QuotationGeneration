<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Add value to fillable
    protected $fillable = [
        'key',   // If needed
        'value', // This allows mass assignment on the 'value' column
    ];

    // Optionally, you could use $guarded instead of $fillable to block specific columns from mass assignment
    // protected $guarded = ['id'];
}
