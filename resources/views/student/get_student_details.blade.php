@extends('student.layouts.layout')
@section('content')

    <section class="bg-custom">
        <div class="row m-0 p-0">
            <div class="col-md-6 ">
                <h4 class="h4 h4-responsive white-text  py-1 head">
                    <img src="{{ asset('svg/logo.png') }}" class="img img-fluid" width="130" alt="">
                    <span class="m-auto">
                        Innovative View Publication
                    </span>
                </h4>
            </div>


        </div>
    </section>
    <section style="background:#fafafa;">
        <div class="row m-0 p-0 ">
            <div class="col-md-8">
                <div class="py-5 px-5">
                    <h5 class="font-weight-bold">
                        {{$errors}}
                        <form action="{{ route('start.exam', $exam->id) }}" method="POST">
                            @csrf

                            <div class="row mt-3">
                                <label class="col-md-3" for="exam_name">Exam Name :</label>
                                <input class="col-md-6 form-control" type="text" name="exam_name" id="exam_name" value="{{$exam->name}}" readonly>
                            </div>


                            <div class="row mt-3">
                                <label class="col-md-3" for="seat_no">Seat No</label>
                                <input class="col-md-6 form-control" type="text" name="exam_seat_no" id="exam_seat_no">
                            </div>

                            <div class="row mt-3">
                                <label class="col-md-3" for="password">Password</label>
                                <input class="col-md-6 form-control" type="password" name="password" id="password">
                            </div>
                            <br>

                            <div class="row">
                                <input class="btn btn-primary" type="submit" id="submit" value="Start Exam">
                            </div>
                        </form>
                    </h5>
                    <h5 class="question">

                    </h5>
                    <!-- answer -->
                    <hr>
                    <div class="mt-4">
