@extends('layouts.app')

@section('title', 'Dashboard IoT')

@section('content')
<div class="py-3 text-center mt-0">
    <div class="container text-white" style="max-width: 700px;">
        <div class="d-flex align-items-center justify-content-center">
            <img src="images/ayam1.png" alt="Hens Care" style="width: 160px; height: 140px; margin-right: -30px;">
            <h4 class="mb-3">
                Selamat datang di Dashboard Hens Care Sistem Monitoring Pakan Ayam Cerdas Berbasis IoT
            </h4>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-thermometer-half text-danger dashboard-icon"></i>
                <div class="title">Suhu Kandang</div>
                <div id="suhu-value" class="value">-- °C</div>
                <div id="chart-temp" style="width: 100%; height: 240px;"></div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-droplet-fill text-primary dashboard-icon"></i>
                <div class="title">Kelembapan Kandang</div>
                <div id="kelembapan-value" class="value">-- %</div>
                <div id="chart-humidity" style="width: 100%; height: 240px;"></div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-cup-straw text-success dashboard-icon"></i>
                <div class="title">Informasi Air Pakan</div>
                <div class="value"></div>
                <div id="chart-tinggi-air" style="width: 100%; height: 275px;"></div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-lightbulb-fill text-warning dashboard-icon"></i>
                <div class="title">Lampu</div>
                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <img id="lampu-gambar" src="images/light_off.png" alt="Lampu" class="device-image">
                </div>
                <div id="lampu-status" class="value">OFF</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-wind dashboard-icon text-secondary"></i>
                <div class="title">Kipas</div>
                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <img id="fan-gambar" src="images/fan_off.png" alt="Fan" class="device-image">
                </div>
                <div id="fan-status" class="value">OFF</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="dashboard-box">
                <i class="bi bi-water dashboard-icon text-primary"></i>
                <div class="title">Kran Air Pakan</div>
                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <img id="kran-gambar" src="images/water_off.png" alt="Kran" class="device-image">
                </div>
                <div id="kran-status" class="value">TERTUTUP</div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/dashboard.js"></script>
@include('partials.footer')

@endsection