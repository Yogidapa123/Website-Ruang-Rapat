<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundLoginPhoto extends Model
{
    use HasFactory;

    // Nama tabel, jika tidak sama dengan nama model (opsional)
    protected $table = 'background_login_photos';

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = ['img'];
}
