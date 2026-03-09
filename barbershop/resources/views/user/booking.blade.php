@extends('layouts.app')

@section('title', 'Booking - Barbershop')

@push('styles')
<style>
    /* ===== BOOKING PAGE ===== */
    .booking-page {
        min-height: 100vh;
        background: #1a1a1a;
        padding: 40px 20px;
    }

    .booking-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #fff;
    }

    .booking-wrapper {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 25px;
    }

    /* ===== LEFT COLUMN ===== */
    .left-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Service Section */
    .service-section {
        background: #0f0f0f;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .section-label {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .service-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .service-item {
        background: #c0c0c0;
        border-radius: 15px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .service-item:hover {
        background: #d0d0d0;
        transform: translateX(5px);
    }

    .service-item.active {
        background: #fff;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
    }

    .service-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #4ade80;
    }

    .service-number {
        width: 28px;
        height: 28px;
        background: #1a1a1a;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .service-item.active .service-number {
        background: #4ade80;
        color: #0f0f0f;
    }

    .service-info {
        flex: 1;
    }

    .service-info h4 {
        color: #1a1a1a;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .service-info p {
        color: #555;
        font-size: 0.8rem;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .service-price {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #1a1a1a;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .service-price i {
        font-size: 0.9rem;
    }

    .service-arrow {
        color: #1a1a1a;
        font-size: 1.2rem;
        opacity: 0.5;
        transition: all 0.3s;
    }

    .service-item:hover .service-arrow,
    .service-item.active .service-arrow {
        opacity: 1;
        transform: translateX(3px);
    }

    /* Barber Profile Section */
    .barber-section {
        background: #0f0f0f;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .barber-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .barber-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        aspect-ratio: 3/4;
    }

    .barber-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .barber-card.active {
        box-shadow: 0 0 0 3px #4ade80;
    }

    .barber-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .barber-card:hover img {
        transform: scale(1.1);
    }

    .barber-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
        padding: 20px 15px 15px;
    }

    .barber-name {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: #fff;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .barber-status {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        background: #4ade80;
        border-radius: 50%;
        border: 2px solid #0f0f0f;
    }

    .barber-status.busy {
        background: #ef4444;
    }

    /* ===== RIGHT COLUMN ===== */
    .right-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-section {
        background: #0f0f0f;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .form-label {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-button {
        width: 100%;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        padding: 15px 20px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .form-button:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(255, 255, 255, 0.25);
    }

    .form-button.selected {
        background: rgba(74, 222, 128, 0.1);
        border-color: rgba(74, 222, 128, 0.4);
    }

    .form-button-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-button i:first-child {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .form-button.selected i:first-child {
        color: #4ade80;
    }

    .form-button i:last-child {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.4);
    }

    .booking-schedule {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .booking-schedule i {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Confirm Button */
    .confirm-btn {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 14px;
        color: #fff;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .confirm-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .confirm-btn.active {
        background: #4ade80;
        color: #0f0f0f;
        border-color: #4ade80;
    }

    /* Selected Summary */
    .selected-summary {
        background: rgba(74, 222, 128, 0.1);
        border: 1px solid rgba(74, 222, 128, 0.2);
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
    }

    .selected-summary h5 {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .summary-item.total {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 10px;
        margin-top: 10px;
        font-weight: 600;
        color: #4ade80;
    }

    /* Modal */
    .modal-content {
        background: #1a1a1a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        color: #fff;
    }

    .modal-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-close {
        filter: invert(1);
    }

    .time-slot-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .time-slot {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.85rem;
    }

    .time-slot:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .time-slot.selected {
        background: #4ade80;
        color: #0f0f0f;
        border-color: #4ade80;
    }

    .time-slot.disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .booking-wrapper {
            grid-template-columns: 1fr;
        }
        
        .right-column {
            order: -1;
        }
        
        .barber-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 576px) {
        .barber-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .time-slot-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
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