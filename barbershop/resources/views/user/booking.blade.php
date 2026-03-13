@extends('layouts.app')

@section('title', 'Booking - Barbershop')

@push('styles')
<link rel="stylesheet" href="{{asset('css/user/booking.css')}}">
@endpush

@section('content')
<div class="booking-page">
    <div class="booking-container">

        <h1 class="page-title">Select a service</h1>

        {{-- SUCCESS / ERROR MESSAGE --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="booking-wrapper">

            <!-- LEFT COLUMN -->
            <div class="left-column">

                <!-- Service Selection -->
                <div class="service-section">
                    <span class="section-label">Service Haircut and Hairstyle</span>

                    <div class="service-list">
                        @foreach($services as $index => $service)
                        <div class="service-item {{ $index === 0 ? 'active' : '' }}"
                             onclick="selectService(this, {{ $service->id }}, '{{ $service->nama_service }}', {{ $service->harga }})">
                            <div class="service-number">{{ $index + 1 }}</div>
                            <div class="service-info">
                                <h4>{{ $service->nama_service }}</h4>
                                <div class="service-price">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Price : Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right service-arrow"></i>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Barber Profile -->
                <div class="barber-section">
                    <span class="section-label">Barber Profile</span>

                    <div class="barber-grid">
                        @foreach($barbers as $index => $barber)
                        <div class="barber-card {{ $index === 0 ? 'active' : '' }}"
                             onclick="selectBarber(this, {{ $barber->id }}, '{{ $barber->nama }}')">
                            <span class="barber-status"></span>
                            {{-- gunakan avatar inisial karena tidak ada foto --}}
                            <div class="barber-avatar">
                                {{ strtoupper(substr($barber->nama, 0, 1)) }}
                            </div>
                            <div class="barber-overlay">
                                <div class="barber-name">{{ $barber->nama }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-column">

                <!-- Filling Form -->
                <div class="form-section">
                    <span class="form-label">Filling Form</span>

                    {{-- FORM submit ke BookingController@store --}}
                    <form id="booking-form" action="{{ route('user.booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_service" id="input-service" value="{{ $services->first()->id ?? '' }}">
                        <input type="hidden" name="id_barber"  id="input-barber"  value="{{ $barbers->first()->id ?? '' }}">
                        <input type="hidden" name="tanggal"    id="input-tanggal" value="">

                        <div class="form-group">
                            <div class="form-button selected" onclick="openScheduleModal()">
                                <div class="form-button-content">
                                    <i class="bi bi-scissors"></i>
                                    <span id="selected-service-text">
                                        {{ $services->first()->nama_service ?? 'Select service type' }}
                                    </span>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-button" onclick="openScheduleModal()" id="schedule-btn">
                                <div class="form-button-content booking-schedule">
                                    <i class="bi bi-calendar3"></i>
                                    <span id="selected-schedule-text">Booking Schedule</span>
                                </div>
                                <i class="bi bi-calendar-check"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-button" id="barber-btn">
                                <div class="form-button-content">
                                    <i class="bi bi-person"></i>
                                    <span id="selected-barber-text">
                                        {{ $barbers->first()->nama ?? 'Select barber (optional)' }}
                                    </span>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>

                        <!-- Selected Summary -->
                        <div class="selected-summary" id="summary-box" style="display:none;">
                            <h5>Booking Summary</h5>
                            <div class="summary-item">
                                <span>Service</span>
                                <span id="summary-service">-</span>
                            </div>
                            <div class="summary-item">
                                <span>Barber</span>
                                <span id="summary-barber">-</span>
                            </div>
                            <div class="summary-item">
                                <span>Schedule</span>
                                <span id="summary-schedule">-</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total</span>
                                <span id="summary-total">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" class="confirm-btn" id="confirm-btn">
                            Confirm
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label text-white-50 mb-2">Select Date</label>
                    <input type="date" class="form-control bg-dark text-white border-secondary" id="booking-date">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white-50 mb-2">Select Time</label>
                    <div class="time-slot-grid">
                        <div class="time-slot" onclick="selectTime(this)">10:00</div>
                        <div class="time-slot" onclick="selectTime(this)">11:00</div>
                        <div class="time-slot" onclick="selectTime(this)">13:00</div>
                        <div class="time-slot" onclick="selectTime(this)">14:00</div>
                        <div class="time-slot" onclick="selectTime(this)">15:00</div>
                        <div class="time-slot" onclick="selectTime(this)">16:00</div>
                        <div class="time-slot disabled">17:00</div>
                        <div class="time-slot" onclick="selectTime(this)">19:00</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveSchedule()">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let selectedData = {
        serviceId:   document.getElementById('input-service').value,
        serviceName: document.getElementById('selected-service-text').textContent.trim(),
        servicePrice: {{ $services->first()->harga ?? 0 }},
        barberId:    document.getElementById('input-barber').value,
        barberName:  document.getElementById('selected-barber-text').textContent.trim(),
        date: null,
        time: null
    };

    function selectService(element, id, name, price) {
        document.querySelectorAll('.service-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedData.serviceId   = id;
        selectedData.serviceName = name;
        selectedData.servicePrice = price;
        document.getElementById('input-service').value = id;
        document.getElementById('selected-service-text').textContent = name;
        updateSummary();
    }

    function selectBarber(element, id, name) {
        document.querySelectorAll('.barber-card').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedData.barberId   = id;
        selectedData.barberName = name;
        document.getElementById('input-barber').value = id;
        document.getElementById('selected-barber-text').textContent = name;
        updateSummary();
    }

    function openScheduleModal() {
        const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
        modal.show();
    }

    function selectTime(element) {
        if (element.classList.contains('disabled')) return;
        document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        selectedData.time = element.textContent;
    }

    function saveSchedule() {
        const dateInput = document.getElementById('booking-date').value;
        if (!dateInput || !selectedData.time) {
            alert('Please select date and time');
            return;
        }
        selectedData.date = dateInput;

        // gabungkan tanggal + jam untuk kolom tanggal di DB
        const fullDatetime = dateInput + ' ' + selectedData.time + ':00';
        document.getElementById('input-tanggal').value = fullDatetime;

        const scheduleText = `${dateInput} | ${selectedData.time}`;
        document.getElementById('selected-schedule-text').textContent = scheduleText;
        document.getElementById('schedule-btn').classList.add('selected');

        bootstrap.Modal.getInstance(document.getElementById('scheduleModal')).hide();
        updateSummary();
    }

    function updateSummary() {
        document.getElementById('summary-service').textContent  = selectedData.serviceName;
        document.getElementById('summary-barber').textContent   = selectedData.barberName;
        document.getElementById('summary-schedule').textContent = selectedData.date && selectedData.time
            ? `${selectedData.date} | ${selectedData.time}`
            : '-';
        document.getElementById('summary-total').textContent =
            'Rp ' + selectedData.servicePrice.toLocaleString('id-ID');
        document.getElementById('summary-box').style.display = 'block';
    }

    // min date = hari ini
    document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];

    // tampilkan summary awal
    updateSummary();
</script>
@endpush