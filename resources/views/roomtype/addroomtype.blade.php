@extends('layouts.master')
@section('menu')
@extends('sidebar.addroom')
@endsection
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Add Room</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/roomtype/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" rows="1.5" id="message" name="message" value="{{ old('message') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Food</label>
                                    <select class="form-control @error('food') is-invalid @enderror" id="food" name="food">
                                        <option disabled selected>--Select--</option>
                                        <option value="Free Breakfast">Free Breakfast</option>
                                        <option value="Free Lunch">Free Lunch</option>
                                        <option value="Free Dinner">Free Dinner</option>
                                        <option value="Free Breakfast & Dinner">Free Breakfast & Dinner</option>
                                        <option value="Free Welcome Drink">Free Welcome Drink</option>
                                        <option value="No Free Food">No Free Food</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bed Count</label>
                                    <select class="form-control @error('bed_count') is-invalid @enderror" id="bed_count" name="bed_count">
                                        <option disabled selected>--Select--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rent</label>
                                    <input type="text" class="form-control @error('rent') is-invalid @enderror" id="rent" name="rent" value="{{ old('rent') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit ml-2">Save</button>
                <button type="button" class="btn btn-primary buttonedit">Cancel</button>
            </form>
        </div>
    </div>
@endsection