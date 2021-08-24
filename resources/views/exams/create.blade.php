@extends('layouts.layout')
@section('content')
<div class="page-header">
    <h3 class="page-title">Form elements</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Form elements </li>
      </ol>
    </nav>
  </div>
  <div class="card mb-5">
    <div class="card-body">
        <h4 class="card-title">Default form</h4>
        <p class="card-description">Basic form layout</p>
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
        <div>
            {{$errors}}
            <form class="forms-sample" action="{{ route('admin.exam.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name of Exam</label>
                            <input type="text" name="name" id="name" class="form-control"  placeholder="" />
                          </div>

                    </div>


                    <div class="col-md-6">
                        <div class="form-group">

                        <label for="duration">Duration In Minutes</label>
                        <input type="text" class="form-control" name="duration" id="duration">
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <select class="js-example-basic-single" style="width: 100%;" name="branch" id="branch" required>
                                <option value="">Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch['id'] }}">{{ $branch['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="Year">Year</label>
                        <select name="year" id="year" class="js-example-basic-single" style="width: 100%;" required>
                            <option value="">Select Branch</option>
                            <option value="1">First Year</option>
                            <option value="2">Second Year</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="start_date">
                    </div>


                    <div class="col-md-6">
                        <label for="end_date">End Date</label>
                        <input type="datetime-local" class="form-control" name="end_date" id="end_date">
                    </div>

                </div>

                <input type="submit" value="Create new exam" class="btn btn-primary my-4">


            </form>
        </div>
      </div>
  </div>

@endsection
