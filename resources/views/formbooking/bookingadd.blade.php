@extends('layouts.master')
@section('menu')
@extends('sidebar.bookingadd')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Add Booking</h3>
                </div>
            </div>
        </div>
        <form action="{{ route('form/booking/save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <select class="form-control @error('name') is-invalid @enderror" id="sel1" name="name" value="{{ old('name') }}">
                                    <option selected disabled> --Select Name-- </option>
                                    @foreach ($user as $users )
                                    <option value="{{ $users->name }}">{{ $users->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rooms</label>
                                <select class="form-control @error('room_type') is-invalid @enderror" id="sel2" name="room">
                                    <option selected disabled> --Select Rooms-- </option>
                                    @foreach ($data as $items )
                                    <option value="{{ $items->name }}">{{ $items->name.' - '.$items->room_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rent</label>
                                <select class="form-control @error('room_type') is-invalid @enderror" id="sel4" name="rent">
                                    <option selected disabled> --Select Rent-- </option>
                                    @foreach ($type as $item)
                                    <option value="{{ $item->rent }}">{{ $item->room_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Members</label>
                                <input type="number" class="form-control @error('total_numbers') is-invalid @enderror" name="total_numbers" value="{{ old('total_numbers') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="time-icon">
                                    <input type="text" class="form-control @error('time') is-invalid @enderror" id="datetimepicker3" name="time" value="{{ old('time') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Arrival Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker @error('arrival_date') is-invalid @enderror" name="arrival_date" value="{{ old('arrival_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Depature Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker @error('depature_date') is-invalid @enderror" name="depature_date" value="{{ old('depature_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="1.5" id="message" name="message" value="{{ old('message') }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary buttonedit1">Create Booking</button>
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