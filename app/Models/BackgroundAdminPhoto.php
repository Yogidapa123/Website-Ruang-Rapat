<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundAdminPhoto extends Model
{
    use HasFactory;

    // Menentukan nama tabel (opsional jika sudah sesuai dengan konvensi Laravel)
    protected $table = 'background_admin_photos';

    // Menentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = ['code', 'img'];

    // Menambahkan aturan validasi untuk code (opsional)
    public static $validCodes = ['admin', 'user', 'ruangan', 'pinjamSementara', 'pinjamRuang', 'fotoBackground'];
    
    public static function isValidCode($code)
    {
        return in_array($code, self::$validCodes);
    }

    // Kamu bisa menambahkan fungsi lain sesuai kebutuhan
}
