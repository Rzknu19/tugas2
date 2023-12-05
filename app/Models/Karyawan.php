<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($karyawan) {
            $karyawan->nip = static::generateNextNIP();
        });
    }

    public static function generateNextNIP()
    {
        $latestNIP = Karyawan::latest('id')->value('nip');

        if (!$latestNIP) {
            return '001';
        }

        return str_pad((int) $latestNIP + 1, 3, '0', STR_PAD_LEFT);
    }
}
