@extends('layouts.master')
@section('menu')
@extends('sidebar.bookingedit')
@endsection
@section('content')
    <style>
        .avatar {
            background-color: #aaa;
            border-radius: 50%;
            color: #fff;
            display: inline-block;
            font-weight: 500;
            height: 38px;
            line-height: 38px;
            margin: -38px 10px 0 0;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            vertical-align: middle;
            width: 38px;
            position: relative;
            white-space: nowrap;
            z-index: 2;
        }
    </style>
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Booking</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/booking/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Booking ID</label>
                                    <input class="form-control" type="text" name="bkg_id" value="{{ $bookingEdit->bkg_id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ $bookingEdit->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rooms</label>
                                    <select class="form-control @error('room') is-invalid @enderror" id="sel2" name="room">
                                        <option selected disabled> --Select Rooms-- </option>
                                        @foreach ($data as $items )
                                        <option value="{{ $bookingEdit->room }}">{{ $items->name .' - '. $items->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rent</label>
                                    <select class="form-control @error('room') is-invalid @enderror" id="sel3" name="rent">
                                        <option selected disabled> --Select Rent-- </option>
                                        @foreach ($data as $items )
                                        <option value="{{ $bookingEdit->rent }}">{{ $items->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Members</label>
                                    <input class="form-control" type="number" name="total_numbers" value="{{ $bookingEdit->total_numbers }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="date" value="{{ $bookingEdit->date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="time-icon">
                                        <input type="text" class="form-control" id="datetimepicker3" name="time" value="{{ $bookingEdit->time }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Arrival Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="arrival_date" value="{{ $bookingEdit->arrival_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Depature Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="depature_date" value="{{ $bookingEdit->depature_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" rows="1.5" id="message" name="message">{{ $bookingEdit->message }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
        </script>
    @endsection
@endsection