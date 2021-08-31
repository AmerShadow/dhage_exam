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
                        Your exam completed successfully.!
                    </h5>
                    <h5 class="question">
                        @if ($result)
                        <h6 class="font-weight-bold">
                            Status : {{$result['status'] }}
                        </h6>

                        <br>

                        <h6 class="font-weight-bold">
                            You got {{$result['marks'] }} marks out of {{$result['totalMarks']}} marks.
                         </h6>
                        @endif
                    </h5>
                    <!-- answer -->
                    <hr>
                    <div class="mt-4">
