<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IotData extends Model
{
    use HasFactory;

    protected $table = 'iot_data';

    protected $fillable = [
        'suhu',
        'kelembapan',
        'tinggi_air',
        'persentase_air',
        'lampu_menyala',
        'kipas_menyala',
        'kran_terbuka',
        'status_air',
        'status_pakan_ayam',
    ];
}