@extends('layouts.app')

@section('title', 'Dashboard - IoT Manager')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-4 bg-white" style="border-radius: 0.75rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle">
                    <i class="bi bi-cpu-fill fs-3"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-muted mb-0">Panel kontrol dan monitoring real-time IoT Anda siap digunakan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white hover-effect" style="border-radius: 0.75rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-3" id="wrapper-broker-icon">
                    <i class="bi bi-broadcast fs-4 spinner-animation" id="icon-broker-status"></i>
                </div>
                <div>
                    <small class="text-muted fw-semibold d-block">Broker Status</small>
                    <strong class="text-warning fs-5 transition-all" id="txt-broker-status">Connecting...</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white hover-effect" style="border-radius: 0.75rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 bg-success bg-opacity-10 text-success rounded-3">
                    <i class="bi bi-hdd-rack-fill fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-semibold d-block">Total Devices</small>
                    <strong class="text-success fs-5" id="stat-total-devices">{{ $totalDevices ?? 0 }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white hover-effect" style="border-radius: 0.75rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 bg-info bg-opacity-10 text-info rounded-3">
                    <i class="bi bi-broadcast-pin fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-semibold d-block">Total Sensors</small>
                    <strong class="text-info fs-5" id="stat-total-sensors">{{ $totalSensors ?? 0 }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm p-3 bg-white hover-effect" style="border-radius: 0.75rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-3">
                    <i class="bi bi-clock-history fs-4"></i>
                </div>
                <div>
                    <small class="text-muted fw-semibold d-block">Last Update</small>
                    <strong class="text-warning fs-6" id="txt-last-update">{{ $lastUpdate ?? '--:--:--' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm p-3 p-md-4 bg-white" style="border-radius: 0.75rem;">
            <div class="row align-items-center">
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-1">
                        <i class="bi bi-signal text-primary me-2"></i>Status Koneksi Protokol Jaringan
                    </h6>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span id="mqtt-status-badge" class="badge bg-warning text-dark px-3 py-1 fs-6 transition-all">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" id="badge-spinner"></span>
                            <span id="badge-text">Menghubungkan ke Broker Shiftr...</span>
                        </span>
                        <small class="text-muted flex-shrink-0">Server: <code class="fs-6">syberkee.cloud.shiftr.io</code></small>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-2 mt-md-0">
                    <button class="btn btn-sm btn-outline-primary fw-semibold" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise me-1"></i>Muat Ulang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100 bg-white hover-effect" style="border-radius: 1rem;">
            <div class="card-body p-4">
                <div class="p-3 bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3" style="width: fit-content;">
                    <i class="bi bi-thermometer-half fs-1"></i>
                </div>
                <h6 class="text-secondary fw-semibold mb-1">Temperatur / Suhu</h6>
                <h1 class="fw-extrabold text-dark my-2"><span id="val-suhu">--</span> <span class="fs-4 text-muted">°C</span></h1>
                <small class="text-muted">Topik: <code>iot/gedung1/suhu</code></small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center h-100 bg-white hover-effect" style="border-radius: 1rem;">
            <div class="card-body p-4">
                <div class="p-3 bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-3" style="width: fit-content;">
                    <i class="bi bi-moisture fs-1"></i>
                </div>
                <h6 class="text-secondary fw-semibold mb-1">Kelembapan Udara</h6>
                <h1 class="fw-extrabold text-dark my-2"><span id="val-kelembapan">--</span> <span class="fs-4 text-muted">%</span></h1>
                <small class="text-muted">Topik: <code>iot/gedung1/kelembapan</code></small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 bg-white hover-effect" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">
                <div class="p-3 bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-3" style="width: fit-content;">
                    <i class="bi bi-gear-wide-connected fs-1"></i>
                </div>
                <h6 class="text-secondary fw-semibold mb-1">Posisi Motor Servo</h6>
                <h3 class="fw-bold text-dark my-2" id="val-servo-text">0°</h3>
                
                <input type="range" class="form-range custom-track-slider px-2 mt-3" min="0" max="180" value="0" id="slider-servo">
                <div class="d-flex justify-content-between text-muted small px-1 mt-1">
                    <span>0°</span>
                    <span>180°</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 bg-white hover-effect" style="border-radius: 1rem;">
            <div class="card-body p-4">
                <div class="text-center">
                    <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-3" style="width: fit-content;">
                        <i class="bi bi-window-sidebar fs-1"></i>
                    </div>
                    <h6 class="text-secondary fw-semibold mb-2">Kirim Teks ke LCD</h6>
                </div>
                
                <div class="input-group mt-3 shadow-sm">
                    <input type="text" class="form-control" placeholder="Ketik teks..." id="input-lcd-text" maxlength="16">
                    <button class="btn btn-success" type="button" id="btn-send-lcd"><i class="bi bi-send-fill"></i></button>
                </div>
                <div class="text-center mt-1">
                    <small class="text-muted" style="font-size: 0.75rem;">Maksimal 16 Karakter</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-white" style="border-radius: 0.75rem;">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-dark m-0"><i class="bi bi-cpu-fill text-primary"></i> Hub Komunikasi Perangkat Lapangan</h5>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0 mb-0">
                        <thead class="table-light text-secondary small fw-bold">
                            <tr>
                                <th>SERIAL NUMBER</th>
                                <th>NAMA DEVICE</th>
                                <th>WILDCARD TOPIK SUBSCRIBE</th>
                                <th class="text-center">STATUS KONEKSI CHIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devices ?? [] as $device)
                            <tr>
                                <td class="fw-semibold">{{ $device->serial_number }}</td>
                                <td>{{ $device->name }}</td>
                                <td><code>iot/#</code></td>
                                <td class="text-center">
                                    <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm transition-all" id="status-chip-{{ $device->serial_number }}">
                                        Offline
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="fw-semibold">pqrstuvqxyz</td>
                                <td>Node Simulator Wokwi Utama</td>
                                <td><code>iot/#</code></td>
                                <td class="text-center">
                                    <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm transition-all animate-pulse" id="status-chip-pqrstuvqxyz">
                                        Offline
                                    </span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-effect { transition: all 0.25s ease; }
    .hover-effect:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08) !important; }
    .transition-all { transition: all 0.4s ease-in-out; }
    .spinner-animation { display: inline-block; animation: spin 2s linear infinite; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    .animate-pulse { animation: pulse 1.5s infinite ease-in-out; }
    @keyframes pulse { 0% { opacity: 0.6; } 50% { opacity: 1; } 100% { opacity: 0.6; } }

    /* CSS Custom Slider untuk Efek Isi Jalur Biru Dinamis saat Digeser */
    .custom-track-slider {
        -webkit-appearance: none;
        width: 100%;
        height: 6px;
        border-radius: 5px;
        background: #dee2e6;
        outline: none;
    }
    .custom-track-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0d6efd;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 0 4px rgba(0,0,0,0.25);
    }
</style>
@endpush

<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('%c[Sistem] Memulai inisialisasi jaringan MQTT...', 'color: blue; font-weight: bold;');

        const clientId = 'web_' + Math.random().toString(16).substring(2, 8);
        const host = 'wss://syberkee.cloud.shiftr.io:443/ws';

        console.log(`[Sistem] Mencoba mengetuk pintu broker: ${host}`);
        const client = mqtt.connect(host, {
            username: 'syberkee',
            password: 'oSOFuM2doNrsGQZM', 
            clientId: clientId,
            clean: true,
            connectTimeout: 10000,
            reconnectPeriod: 3000,
            rejectUnauthorized: false
        });

        const topicSuhu     = 'iot/gedung1/suhu';
        const topicLembap   = 'iot/gedung1/kelembapan';
        const topicServo    = 'iot/gedung1/servo';
        const topicLcd      = 'iot/gedung1/lcd';
        const topicStatus   = 'iot/gedung1/status';

        // Fungsi pewarnaan background isi slider biru di kiri, abu-abu di kanan
        function paintSliderFill(slider) {
            const percentage = (slider.value - slider.min) / (slider.max - slider.min) * 100;
            slider.style.background = `linear-gradient(to right, #0d6efd 0%, #0d6efd ${percentage}%, #dee2e6 ${percentage}%, #dee2e6 100%)`;
        }

        const initialSlider = document.getElementById('slider-servo');
        if(initialSlider) paintSliderFill(initialSlider);

        // 1. HANDLER JIKA SUKSES TERHUBUNG KE BROKER SHIFTR
        client.on('connect', () => {
            console.log('%c[SUKSES] BOOM! Web Laravel Berhasil Masuk ke Shiftr.io!', 'color: green; font-weight: bold;');
            client.subscribe('iot/#');

            document.getElementById('wrapper-broker-icon').className = 'p-2 bg-success bg-opacity-10 text-success rounded-3';
            document.getElementById('icon-broker-status').className = 'bi bi-broadcast fs-4'; 
            document.getElementById('txt-broker-status').innerText = 'Online';
            document.getElementById('txt-broker-status').className = 'text-success fs-5';

            document.getElementById('badge-spinner').className = 'd-none';
            const badge = document.getElementById('mqtt-status-badge');
            badge.className = 'badge bg-success text-white px-3 py-1 fs-6 transition-all';
            document.getElementById('badge-text').innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Terhubung Sukses ke Shiftr.io!';
        });

        // 2. HANDLER JIKA SALAH PASSWORD / AUTH ERROR SHIFTR
        client.on('error', (err) => {
            console.error('%c[ERROR MQTT] Gagal Otentikasi:', 'color: red; font-weight: bold;', err);
            document.getElementById('txt-broker-status').innerText = 'Auth Error';
            document.getElementById('txt-broker-status').className = 'text-danger fs-6';
            
            document.getElementById('badge-spinner').className = 'd-none';
            const badge = document.getElementById('mqtt-status-badge');
            badge.className = 'badge bg-danger text-white px-3 py-1 fs-6 transition-all';
            document.getElementById('badge-text').innerHTML = `<i class="bi bi-x-circle-fill me-1"></i> Gagal: Token Salah / Jaringan Private`;
        });

        // 3. HANDLER JIKA KONEKSI INTERNET PUTUS / RECONNECTING
        client.on('close', () => {
            const currentStatus = document.getElementById('txt-broker-status').innerText;
            if(currentStatus !== 'Auth Error') {
                document.getElementById('txt-broker-status').innerText = 'Reconnecting';
                document.getElementById('txt-broker-status').className = 'text-warning fs-5';
                document.getElementById('icon-broker-status').className = 'bi bi-broadcast fs-4 spinner-animation';
                document.getElementById('wrapper-broker-icon').className = 'p-2 bg-warning bg-opacity-10 text-warning rounded-3';
                
                document.getElementById('badge-spinner').className = 'spinner-border spinner-border-sm me-1';
                document.getElementById('mqtt-status-badge').className = 'badge bg-warning text-dark px-3 py-1 fs-6';
                document.getElementById('badge-text').innerText = 'Mencoba Menyambung Kembali...';
            }
        });

        // 4. HANDLER JIKA ADA DATA MASUK (SUBSCRIBE TOPIC)
        client.on('message', (topic, message) => {
            const payload = message.toString();
            console.log(`[Data Masuk] ${topic} -> ${payload}`);

            const waktu = new Date().toLocaleTimeString('id-ID');
            document.getElementById('txt-last-update').innerText = waktu;

            if (topic === topicSuhu) document.getElementById('val-suhu').innerText = payload;
            if (topic === topicLembap) document.getElementById('val-kelembapan').innerText = payload;
            
            if (topic === topicServo) {
                document.getElementById('val-servo-text').innerText = payload + '°';
                const slider = document.getElementById('slider-servo');
                slider.value = payload;
                paintSliderFill(slider); // Sinkronkan isi slider biru saat Wokwi memutar servo
            }
            if (topic === topicLcd) {
                document.getElementById('input-lcd-text').value = payload;
            }
            
            // PELACAK STATUS REAL-TIME DINAMIS BERBASIS JSON DARI WOKWI
            if (topic === topicStatus) {
                try {
                    const parsedData = JSON.parse(payload);
                    const serialNumber = parsedData.serial_number;
                    const deviceStatus = parsedData.status;

                    // Mengincar ID dinamis "status-chip-[serial_number]" di tabel
                    const targetChip = document.getElementById('status-chip-' + serialNumber);
                    
                    if (targetChip) {
                        if (deviceStatus === 'Online' || deviceStatus === 'online') {
                            targetChip.innerText = 'Online';
                            targetChip.className = 'badge bg-success px-3 py-2 rounded-pill shadow-sm transition-all';
                        } else {
                            targetChip.innerText = 'Offline';
                            targetChip.className = 'badge bg-danger px-3 py-2 rounded-pill shadow-sm transition-all';
                        }
                    }
                } catch (e) {
                    console.error("Format status MQTT bukan paket JSON yang valid:", e);
                }
            }
        });

        // Event Listener Slider Range Servo agar jalur di belakangnya berwarna biru solid
        const sliderElement = document.getElementById('slider-servo');
        sliderElement.addEventListener('input', (e) => {
            paintSliderFill(e.target); // Isi warna biru secara real-time saat digeser mouse
            document.getElementById('val-servo-text').innerText = e.target.value + '°';
            client.publish(topicServo, e.target.value, { qos: 1, retain: true });
        });

        // Event Listener Tombol Kirim Teks LCD
        document.getElementById('btn-send-lcd').addEventListener('click', () => {
            const text = document.getElementById('input-lcd-text').value;
            client.publish(topicLcd, text, { qos: 1, retain: true });
        });
    });
</script>