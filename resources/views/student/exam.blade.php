@extends('layouts.layout')
@section('content')

<section class="bg-custom">
    <div class="row m-0 p-0">
        <div class="col-md-6 ">
        <h4 class="h4 h4-responsive white-text  py-1 head">
              <img src="{{asset('svg/logo.png')}}" class="img img-fluid" width="130" alt="">
              <span class="m-auto">
              Innovative View Publication
              </span>
        </h4>
        </div>
        <div class="col-md-6  text-right m-auto white-text">
            <h2 class="pr-4">
            20:03

            </h2>
        </div>

    </div>
</section>
<section style="background:#fafafa;">
<div class="row m-0 p-0 ">
        <div class="col-md-8">
        <div class="py-5 px-5">
        <h5 class="font-weight-bold">
            Q1.
        </h5>
        <h5 class="question">
        What are the different data types present in javascript?
            <br>
            जावास्क्रिप्टमध्ये विविध डेटा प्रकार कोणते आहेत?<br>
            जावास्क्रिप्ट में मौजूद विभिन्न डेटा प्रकार क्या हैं?
        </h5>
        <!-- answer -->
        <hr>
        <div class="mt-4">
       <!-- Group of default radios - option 1 -->
       <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="opt1" name="groupOfDefaultRadios">
            <label class="custom-control-label" for="opt1">Option 1 <span>option Marathi</span></label>
            </div>

            <!-- Group of default radios - option 2 -->
            <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="opt2" name="groupOfDefaultRadios" >
            <label class="custom-control-label" for="opt2">Option 2</label>
            </div>

            <!-- Group of default radios - option 3 -->
            <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="opt3" name="groupOfDefaultRadios">
            <label class="custom-control-label" for="opt3">Option 3</label>
            </div>
            <!-- Group of default radios - option 3 -->
            <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="opt4" name="groupOfDefaultRadios">
            <label class="custom-control-label" for="opt4">Option 4</label>
            </div>

        </div>
        </div>
        <div class="row text-right   ">
        <div class="col-md-2 m-0 p-0">
            <a href="http://" class="btn btn-custom btn-md btn-outline-danger shadow-none" rel="noopener noreferrer">Save</a>
        </div>
        <div class="col-md-3 m-0 p-0">
        <a href="http://" class="btn btn-custom btn-md btn-success shadow-none" rel="noopener noreferrer">Save & Next</a>

        </div><div class="col-md-3 m-0 p-0">
        <a href="http://" class="btn btn-custom btn-md btn-success shadow-none" rel="noopener noreferrer">Submit</a>

        </div>
    </div>
        </div>

        <div class="col-md-4 m-0 p-0">
            <div class="card shadow-none py-5 m-0">
                <div class="card-body m-0 p-0">
                    <div class="px-4">
                    <h4 class="card-title font-weight-bold">Tauseef Ahmed</h4>
                    <p class="mb-0 text-16">Course / Branch</p>

                    </div>
                    <hr class="mb-0 pb-0">
                    <div class="px-4 py-2">
                    <svg height="20" width="20">
                        <circle cx="10" cy="10" r="7" stroke="black" stroke-width="1" fill="white" />
                        </svg> <span class="text-14">20</span>&ensp;
                        <svg height="20" width="20">
                        <circle cx="10" cy="10" r="7" stroke="" stroke-width="1" fill="red" />
                        </svg>  <span class="text-14">10</span>&ensp;
                        <svg height="20" width="20">
                        <circle cx="10" cy="10" r="7" stroke="" stroke-width="1" fill="green" />
                        </svg>  <span class="text-14">10</span>&ensp;
                    </div>
                    <hr class="m-0 p-0">
                   <div class="px-3">
                    <ul class="list-inline">
