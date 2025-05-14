@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold">📊 Data Pakan Ayam - Realtime Monitoring</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow rounded text-center align-middle custom-table">
            <thead class="table-dark">
                <tr>
                    <th>🌡️ Suhu (°C)</th>
                    <th>Status Suhu</th>
                    <th>💧 Air Pakan (%)</th>
                    <th>Status Air</th>
                    <th>🌫️ Kelembapan (%)</th>
                    <th>Status Kelembapan</th>
                    <th>🍗 Pakan (kg)</th>
                    <th>Status Pakan</th>
                    <th>🕒 Terakhir Update</th>
                </tr>
            </thead>
            <tbody id="realtime-table">
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/dashboard.js"></script>
@endsection