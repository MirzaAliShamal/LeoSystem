<!-- Consultation Booking Modal Start-->
<div class="modal fade" id="consultationBookingModal" tabindex="-1" aria-labelledby="consultationBookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultationBookingModalLabel">{{ __('Buy Ticket Now') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row booking-header-row consultation-select-date-hour">
                <div class="input-group flex-nowrap col-md-6 consultantion-calendar-box">
                    <input type="hidden" id="eventID" name="eventID" class="form-control" />
                    <label class="col-md-5 col-form-label font-17 font-semi-bold color-heading">{{ __('Select Date') }}:</label>
                        <div class="book-schedule-calendar-wrap position-relative appendDatePicker">
                           <!-- Append from booking.js -->
                        </div>
                </div>
                <div class="input-group col-md-6 consultantion-hours-box">
                    <label class="col-md-5 col-form-label font-17 font-semi-bold color-heading">{{ __('Ticket Price') }}</label>
                    <input type="text" class="form-control font-medium" name="eventTicketPrice" id="eventTicketPrice" disabled value="0" style="width: 50px;">
                    <input type="hidden" class="form-control font-medium" value="0">
                </div>
                <input type="hidden" class="booking_instructor_user_id" value="">
            </div>

            <div class="row booking-header-row">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <label class="col-sm-12 col-md-12 col-form-label font-17 font-semi-bold color-heading">{{ __('Ticket Type') }}</label>
                    </div>
                    <div class="col-sm-6 col-md-9">
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group row ticket-type-checkbox">
                                    <div class="col Online">
                                        <div class="time-slot-item">
                                            <input type="radio" name="available_type" class="btn-check" value="2"
                                                id="standardTicket" autocomplete="off" onclick="setTicketTypePrice('Standard', {{$event->standard_ticket_price}})">
                                            <label class="btn btn-outline-primary mb-0" for="standardTicket">{{ __('Standard Ticket') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group row ticket-type-checkbox">
                                    <div class="col Online">
                                        <div class="time-slot-item">
                                            <input type="radio" name="available_type" class="btn-check" value="2"
                                                id="advancedTicket" autocomplete="off" onclick="setTicketTypePrice('Advanced', {{$event->advanced_ticket_price}})">
                                            <label class="btn btn-outline-primary mb-0" for="advancedTicket">{{ __('Advanced Ticket') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group row ticket-type-checkbox">
                                    <div class="col Online">
                                        <div class="time-slot-item">
                                            <input type="radio" name="available_type" class="btn-check" value="2"
                                                id="proTicket" autocomplete="off" onclick="setTicketTypePrice('Pro', {{$event->pro_ticket_price}})">
                                            <label class="btn btn-outline-primary mb-0" for="proTicket">{{ __('PRO Ticket') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="input-group row ticket-type-checkbox">
                                    <div class="col Online">
                                        <div class="time-slot-item">
                                            <input type="radio" name="available_type" class="btn-check" value="2"
                                                id="vipTicket" autocomplete="off" onclick="setTicketTypePrice('Vip', {{$event->vip_ticket_price}})">
                                            <label class="btn btn-outline-primary mb-0" for="vipTicket">{{ __('VIP Ticket') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="appendDayAndTime">

            </div>

            <div class="modal-footer d-flex justify-content-between align-items-center">
                <button type="button" class="theme-btn theme-button1 default-hover-btn w-100 makePayment"
                    data-route="{{ route('student.addToCartConsultation') }}">{{ __('Buy Ticket Now') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- Consultation Booking Modal End-->

<input type="hidden" class="getInstructorBookingTimeRoute" value="{{ route('getInstructorBookingTime') }}">

<script>
    function setTicketTypePrice(ticket_type, ticket_price){
        if(ticket_type === "Standard"){
            $('#eventTicketPrice').val("$"+ticket_price);
        } else if(ticket_type === "Advanced"){
            $('#eventTicketPrice').val("$"+ticket_price);
        } else if(ticket_type === "Pro"){
            $('#eventTicketPrice').val("$"+ticket_price);
        } else if(ticket_type === "Vip"){
            $('#eventTicketPrice').val("$"+ticket_price);
        }
    }
</script>