@extends('layouts.layout')
@section('content')
<div class="page-header">
    <h3 class="page-title">Exams</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Exams</a></li>
        <li class="breadcrumb-item active" aria-current="page"> Add Exam </li>
      </ol>
    </nav>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add Exam</h4>

          </p>
          <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Branch</th>
                    <th>Year</th>
                    <th>Batch</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($exams as $key=> $exam)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$exam->name}}</td>
                        <td>{{$exam->start_date}}</td>
                        <td>{{$exam->end_date}}</td>
                        <td>{{$exam->branch}}</td>
                        <td>{{$exam->year}}</td>
                        <td>{{$exam->batch}}</td>
                        <td>{{$exam->duration}}</td>
                        <td>@switch($exam->status)
                            @case(1)
                                <p>Exam Created</p>
                                @break
                            @case(2)
                                 <p>Paper Set</p>

                                @break
                            @default

                        @endswitch</td>
                        <td>
                            @switch($exam->status)
                                @case(1)
                                    <a href="{{route('admin.exam.set.paper',$exam)}}">Set Paper</a>
                                    @break
                                @case(2)
                                     <a href="#">Edit Paper</a>
                                    @break
                                @default

                            @endswitch
                        </td>


                    </tr>
                @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
