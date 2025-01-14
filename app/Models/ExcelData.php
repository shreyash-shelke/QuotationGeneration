<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelData extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'qty',
        'amount',
        'phone',        // Added phone field
        'quotation_number',  // Added quotation_number field
    ];
}
