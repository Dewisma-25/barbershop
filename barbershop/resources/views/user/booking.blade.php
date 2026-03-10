@extends('layouts.app')

@section('title', 'Booking - Barbershop')

@push('styles')
<link rel="stylesheet" href="{{asset('css/user/booking.css')}}">
@endpush

@section('content')
<div class="booking-page">
    <div class="booking-container">
        
        <h1 class="page-title">Select a service</h1>

        <div class="booking-wrapper">
            
            <!-- LEFT COLUMN -->
            <div class="left-column">
                
                <!-- Service Selection -->
                <div class="service-section">
                    <span class="section-label">Service Haircut and Hairstyle</span>
                    
                    <div class="service-list">
                        <div class="service-item active" onclick="selectService(this, 1)">
                            <div class="service-number">1</div>
                            <div class="service-info">
                                <h4>Basic Haircut</h4>
                                <p>Cut standard hair according to the customer's desired model.</p>
                                <div class="service-price">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Price : Rp 150.000</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right service-arrow"></i>
                        </div>

                        <div class="service-item" onclick="selectService(this, 2)">
                            <div class="service-number">2</div>
                            <div class="service-info">
                                <h4>Premium Haircut</h4>
                                <p>Hair cut + shampoo + styling + light massage.</p>
                                <div class="service-price">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Price : Rp 200.000</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right service-arrow"></i>
                        </div>

                        <div class="service-item" onclick="selectService(this, 3)">
                            <div class="service-number">3</div>
                            <div class="service-info">
                                <h4>Highlight / Bleaching</h4>
                                <p>Special coloring technique for bright effects.</p>
                                <div class="service-price">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Price : Rp 350.000</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right service-arrow"></i>
                        </div>

                        <div class="service-item" onclick="selectService(this, 4)">
                            <div class="service-number">4</div>
                            <div class="service-info">
                                <h4>Hair Styling (Pomade / Wax Styling)</h4>
                                <p>Styling according to trends (undercut, pompadour, slick back, etc.).</p>
                                <div class="service-price">
                                    <i class="bi bi-cash-stack"></i>
                                    <span>Price : Rp 400.000</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right service-arrow"></i>
                        </div>
                    </div>
                </div>

                <!-- Barber Profile -->
                <div class="barber-section">
                    <span class="section-label">Barber Profile</span>
                    
                    <div class="barber-grid">
                        <div class="barber-card active" onclick="selectBarber(this, 'Wismuy')">
                            <span class="barber-status"></span>
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop" alt="Wismuy">
                            <div class="barber-overlay">
                                <div class="barber-name">Wismuy</div>
                            </div>
                        </div>

                        <div class="barber-card" onclick="selectBarber(this, 'Silvuy')">
                            <span class="barber-status"></span>
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=300&h=400&fit=crop" alt="Silvuy">
                            <div class="barber-overlay">
                                <div class="barber-name">Silvuy</div>
                            </div>
                        </div>

                        <div class="barber-card" onclick="selectBarber(this, 'Donuy')">
                            <span class="barber-status busy"></span>
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&h=400&fit=crop" alt="Donuy">
                            <div class="barber-overlay">
                                <div class="barber-name">Donuy</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="right-column">
                
                <!-- Filling Form -->
                <div class="form-section">
                    <span class="form-label">Filling Form</span>
                    
                    <div class="form-group">
                        <div class="form-button selected" onclick="openServiceModal()">
                            <div class="form-button-content">
                                <i class="bi bi-scissors"></i>
                                <span id="selected-service-text">Select service type</span>
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
                        <div class="form-button" onclick="openBarberModal()" id="barber-btn">
                            <div class="form-button-content">
                                <i class="bi bi-person"></i>
                                <span id="selected-barber-text">Select barber (optional)</span>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>

                    <!-- Selected Summary -->
                    <div class="selected-summary" id="summary-box" style="display: none;">
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

                    <button class="confirm-btn" id="confirm-btn" onclick="confirmBooking()">
                        Confirm
                    </button>
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
        service: { id: 1, name: 'Basic Haircut', price: 150000 },
        barber: 'Wismuy',
        date: null,
        time: null
    };

    const services = {
        1: { name: 'Basic Haircut', price: 150000 },
        2: { name: 'Premium Haircut', price: 200000 },
        3: { name: 'Highlight / Bleaching', price: 350000 },
        4: { name: 'Hair Styling', price: 400000 }
    };

    function selectService(element, id) {
        document.querySelectorAll('.service-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedData.service = { id: id, ...services[id] };
        updateSummary();
    }

    function selectBarber(element, name) {
        document.querySelectorAll('.barber-card').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        selectedData.barber = name;
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
        
        const scheduleText = `${selectedData.date} | ${selectedData.time}`;
        document.getElementById('selected-schedule-text').textContent = scheduleText;
        document.getElementById('schedule-btn').classList.add('selected');
        
        bootstrap.Modal.getInstance(document.getElementById('scheduleModal')).hide();
        updateSummary();
    }

    function updateSummary() {
        document.getElementById('selected-service-text').textContent = selectedData.service.name;
        document.getElementById('selected-barber-text').textContent = selectedData.barber;
        
        document.getElementById('summary-service').textContent = selectedData.service.name;
        document.getElementById('summary-barber').textContent = selectedData.barber;
        document.getElementById('summary-schedule').textContent = selectedData.date && selectedData.time 
            ? `${selectedData.date} | ${selectedData.time}` 
            : '-';
        document.getElementById('summary-total').textContent = `Rp ${selectedData.service.price.toLocaleString('id-ID')}`;
        
        document.getElementById('summary-box').style.display = 'block';
        
        // Enable confirm button if all selected
        if (selectedData.date && selectedData.time) {
            document.getElementById('confirm-btn').classList.add('active');
        }
    }

    function confirmBooking() {
        if (!selectedData.date || !selectedData.time) {
            alert('Please complete all fields');
            return;
        }
        alert(`Booking confirmed!\n\nService: ${selectedData.service.name}\nBarber: ${selectedData.barber}\nSchedule: ${selectedData.date} | ${selectedData.time}\nTotal: Rp ${selectedData.service.price.toLocaleString('id-ID')}`);
    }

    // Set min date to today
    document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];
</script>
@endpush