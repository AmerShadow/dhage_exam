<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>



</head>

<body>
    <table>
        <tr>
            <th>sr No</th>
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
                            <a href="{{route('exam.set.paper',$exam)}}">Set Paper</a>
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
</body>

</html>
