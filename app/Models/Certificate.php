<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    public $timestamps = false; // Nonaktifkan timestamps

    protected $table = 'certificate'; // Ensure plural form of table
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'issued_by',
        'issued_at',
        'description',
        'file',
    ];
}
