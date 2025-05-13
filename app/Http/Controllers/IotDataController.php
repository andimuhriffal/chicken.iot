<?php

// app/Http/Controllers/IotDataController.php
namespace App\Http\Controllers;

use App\Models\IotData;
use Illuminate\Http\Request;

class IotDataController extends Controller
{
    public function index()
    {
        $data = IotData::latest()->first();
        return view('iot.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'suhu' => 'required|integer',
            'kelembapan' => 'required|integer',
            'tinggi_air' => 'required|numeric',
            'persentase_air' => 'required|numeric',
            'lampu_menyala' => 'required|boolean',
            'kipas_menyala' => 'required|boolean',
            'kran_terbuka' => 'required|boolean',
            'status_air' => 'required|string',
        ]);

        IotData::create($request->all());

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}