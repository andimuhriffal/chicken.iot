function fetchAndUpdateData() {
    fetch("/api/get-iot")
        .then((response) => response.json())
        .then((data) => {
            const suhuValue = data.suhu;
            const kelembapanValue = data.kelembapan;
            const tinggiAir = data.tinggi_air;
            const lampuStatus = data.lampu_menyala === 1 ? "ON" : "OFF";
            const fanStatus = data.kipas_menyala === 1 ? "ON" : "OFF";
            const kranStatus = data.kran_terbuka === 1 ? "TERBUKA" : "TERTUTUP";

            animateChartValue("suhuChart", suhuValue);
            document.getElementById("suhu-value").innerText = suhuValue + " °C";

            animateChartValue("kelembapanChart", kelembapanValue);
            document.getElementById("kelembapan-value").innerText = kelembapanValue + " %";

            animateChartValue("tinggiAirChart", tinggiAir);

            updateLampuStatus(lampuStatus);
            updateFanStatus(fanStatus);
            updateKranStatus(kranStatus);
        })
        .catch((error) => console.error("Gagal memuat data grafik:", error));
}

function fetchAndUpdateTable() {
    fetch("/api/get-iot")
        .then((res) => res.json())
        .then((data) => {
            if (!data) return;

            const html = `
                <tr>
                    <td>${data.suhu}</td>
                    <td>${renderStatusSuhu(data.suhu)}</td>
                    <td>${data.persentase_air}%</td>
                    <td>${renderStatusAir(data.persentase_air)}</td>
                    <td>${data.kelembapan}%</td>
                    <td>${renderStatusKelembapan(data.kelembapan)}</td>
                    <td>${data.status_pakan_ayam}kg</td>
                    <td>${renderStatusPakan(data.status_pakan_ayam)}</td>
                    <td>${new Date(data.created_at).toLocaleString('id-ID')}</td>
                </tr>
            `;

            const tableBody = document.getElementById("realtime-table");

            // Tambahkan baris baru ke bawah
            tableBody.insertAdjacentHTML("beforeend", html);

            // Batasi jumlah baris hanya 10
            const rows = tableBody.querySelectorAll("tr");
            if (rows.length > 12) {
                // Hapus baris paling atas (terlama)
                tableBody.removeChild(rows[0]);
            }
        })
        .catch((err) => console.error("Gagal fetch data tabel:", err));
}

// --- Reusable Status Renderers ---
function renderStatusSuhu(suhu) {
    if (suhu < 21) return `<span class="badge bg-primary">Dingin</span>`;
    if (suhu > 30) return `<span class="badge bg-warning text-dark">Hangat</span>`;
    return `<span class="badge bg-success">Normal</span>`;
}

function renderStatusAir(persen) {
    return persen <= 0
        ? `<span class="badge bg-danger">Air Pakan Kosong</span>`
        : `<span class="badge bg-success">Air Terisi</span>`;
}

function renderStatusKelembapan(kelembapan) {
    return kelembapan > 90
        ? `<span class="badge bg-warning text-dark">Sangat Lembab</span>`
        : `<span class="badge bg-success">Normal</span>`;
}

function renderStatusPakan(pakan) {
    return pakan <= 0
        ? `<span class="badge bg-warning text-dark">Kosong</span>`
        : `<span class="badge bg-success">Terisi</span>`;
}

// --- Animation + Status Update Helpers ---
function animateChartValue(chartId, newValue, duration = 500) {
    const chart = FusionCharts.items[chartId];
    if (!chart) return;

    const currentValue = parseFloat(chart.getData());
    const stepCount = 20;
    const stepTime = duration / stepCount;
    const valueDiff = newValue - currentValue;

    let step = 0;
    const interval = setInterval(() => {
        step++;
        const interpolatedValue = currentValue + valueDiff * (step / stepCount);
        chart.setData(interpolatedValue.toFixed(2));
        if (step >= stepCount) {
            clearInterval(interval);
            chart.setData(newValue);
        }
    }, stepTime);
}

function updateLampuStatus(status) {
    const lampuImage = document.getElementById("lampu-gambar");
    const lampuText = document.getElementById("lampu-status");
    if (lampuImage && lampuText) {
        if (status === "ON") {
            lampuImage.src = "/images/light_on.png";
            lampuText.innerText = "Lampu: ON";
        } else {
            lampuImage.src = "/images/light_off.png";
            lampuText.innerText = "Lampu: OFF";
        }
    }
}

function updateFanStatus(status) {
    const fanImage = document.getElementById("fan-gambar");
    const fanText = document.getElementById("fan-status");
    if (fanImage && fanText) {
        if (status === "ON") {
            fanImage.src = "/images/fan_on.png";
            fanText.innerText = "Kipas: ON";
        } else {
            fanImage.src = "/images/fan_off.png";
            fanText.innerText = "Kipas: OFF";
        }
    }
}

function updateKranStatus(status) {
    const kranImage = document.getElementById("kran-gambar");
    const kranText = document.getElementById("kran-status");
    if (kranImage && kranText) {
        if (status === "TERBUKA") {
            kranImage.src = "/images/water_on.png";
            kranText.innerText = "Kran: TERBUKA";
        } else {
            kranImage.src = "/images/water_off.png";
            kranText.innerText = "Kran: TERTUTUP";
        }
    }
}

// --- FusionCharts Init + Realtime Loop ---
FusionCharts.ready(function () {
    new FusionCharts({
        id: "suhuChart",
        type: "thermometer",
        renderAt: "chart-temp",
        width: "100%",
        height: "260",
        dataFormat: "json",
        dataSource: {
            chart: {
                lowerLimit: "-10",
                upperLimit: "50",
                numberSuffix: "°C",
                thmFillColor: "#f45b00",
                showhovereffect: "1",
                showGaugeBorder: "1",
                chartBottomMargin: "20",
                theme: "fusion",
            },
            value: 0,
        },
    }).render();

    new FusionCharts({
        id: "kelembapanChart",
        type: "thermometer",
        renderAt: "chart-humidity",
        width: "100%",
        height: "250",
        dataFormat: "json",
        dataSource: {
            chart: {
                lowerLimit: "0",
                upperLimit: "100",
                numberSuffix: "%",
                thmFillColor: "#0075c2",
                showhovereffect: "1",
                showGaugeBorder: "1",
                chartBottomMargin: "20",
                theme: "fusion",
            },
            value: 0,
        },
    }).render();

    new FusionCharts({
        id: "tinggiAirChart",
        type: "cylinder",
        renderAt: "chart-tinggi-air",
        width: "100%",
        height: "260",
        dataFormat: "json",
        dataSource: {
            chart: {
                theme: "fusion",
                caption: "",
                lowerLimit: "0",
                upperLimit: "4",
                lowerLimitDisplay: "Kosong",
                upperLimitDisplay: "Penuh",
                numberSuffix: " cm",
                showValue: "1",
                chartBottomMargin: "30",
                cylFillColor: "#0075c2",
            },
            value: 0,
        },
    }).render();

    // Call both functions periodically
    fetchAndUpdateData();
    fetchAndUpdateTable();
    setInterval(fetchAndUpdateData, 2000);  // grafik setiap 2 detik
    setInterval(fetchAndUpdateTable, 3000); // tabel setiap 3 detik
});
