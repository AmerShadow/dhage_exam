<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>


</head>

<body>
    <div>
        <p> name: {{ $exam->name }} </p>
        <p> start date : {{ $exam->start_date }}</p>
        <p> end_date : {{ $exam->end_date }}</p>
        <p> duration : {{ $exam->duration }}</p>
        <p> branch : {{ $exam->batch }}</p>

        <h2>Questions</h2>


        <form id="add_question_form">
            @csrf
            <div>
                <label for="question"></label>
                <input type="text" id="question" name="question">
            </div>


            <div>
                <label for="option_a"></label>
                <input type="text" id="option_a" name="option_a">
            </div>


            <div>
                <label for="option_b"></label>
                <input type="text" id="option_b" name="option_b">
            </div>


            <div>
                <label for="option_c"></label>
                <input type="text" id="option_c" name="option_c">
            </div>


            <div>
                <label for="option_d"></label>
                <input type="text" id="option_d" name="option_d">
            </div>


            <div>
                <label for="answer"></label>
                <select name="answer" id="answer">
                    <option value="a">option A</option>
                    <option value="b">option B</option>
                    <option value="c">option C</option>
                    <option value="d">option D</option>
                </select>
            </div>

            <input type="submit" value="Add question">
        </form>

        <div id="questions">
            <table border="1px" id="questions_table">
                <thead>
                    <tr>
                        <th>sr No</th>
                        <th>Question</th>
                        <th>option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php $srNo = 1; ?>
                <tbody>
                @foreach ($questions as $key => $question)
                    <tr id="{{$question->id}}">
                        <td>{{ $srNo++ }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->option_a }}</td>
                        <td>{{ $question->option_b }}</td>
                        <td>{{ $question->option_c }}</td>
                        <td>{{ $question->option_d }}</td>
                        <td>{{ $question->answer }}</td>

                        <td><a href="{{route('exam.delete.question',$question->id)}}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
            </table>

        </div>
    </div>
</body>


<script type="text/javascript">
    $(document).ready(function() {

        $('#add_question_form').on('submit', function(e) {
            e.preventDefault();
            var question = $('#question').val();
            var option_a = $('#option_a').val();
            var option_b = $('#option_b').val();
            var option_c = $('#option_c').val();
            var option_d = $('#option_d').val();
            var answer = $('#answer').val();
            url = "{{ route('exam.add.question', $exam->id) }}";

            if (question && option_a && option_b && option_c && option_d) {
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "question": question,
                        "option_a": option_a,
                        "option_b": option_b,
                        "option_c": option_c,
                        "option_d": option_d,
                        "answer": answer,
                    },
                    success: function(result) {
                        if (result["status"] === "S") {
                            let question = result['data'];
                            alert(question);
                            let questionsTable = $("#questions_table tr:last");
                            let tr = `
                            <tr id="${question['id']}">
                                <td>{{ $srNo++ }}</td>
                                <td>${question['question']}</td>
                                <td>${question['option_a']}</td>
                                <td>${question['option_b']}</td>
                                <td>${question['option_c']}</td>
                                <td>${question['option_d']}</td>
                                <td>${question['answer']}</td>
                                <td><a href="{{url('exam/delete/question/')}}/${question['id']}">Delete</a></td>
                            </tr>
                            `;
                            questionsTable.after(tr);
                        } else {
                            alert(result["message"]);
                        }
                    },
                    error: function(xhr, resp, text) {
                        console.log(xhr, resp, text);
                    }
                });
            } else {
                alert('Please fill all the mendatory fields');
            }
        });
    });
</script>

</html>
