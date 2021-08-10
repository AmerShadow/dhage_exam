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

        <form name="radio_form">
            <input type="radio" name="question_type" id="new_question_radio" value="new_question_radio" checked>
            <label for="new_question_radio">Add New Question</label>
            <input type="radio" name="question_type" id="added_question_radio" value="added_question_radio">
            <label for="added_question_radio">Add Question From QUestion Bank</label>
        </form>


        <div id="new_question">
            <form id="add_question_form">
                @csrf
                <div>
                    <label for="question">Question</label>
                    <input type="text" id="question" name="question">
                </div>


                <div>
                    <label for="option_a">Option A</label>
                    <input type="text" id="option_a" name="option_a">
                </div>


                <div>
                    <label for="option_b">Option B</label>
                    <input type="text" id="option_b" name="option_b">
                </div>


                <div>
                    <label for="option_c">Option C</label>
                    <input type="text" id="option_c" name="option_c">
                </div>


                <div>
                    <label for="option_d">Option D</label>
                    <input type="text" id="option_d" name="option_d">
                </div>


                <div>
                    <label for="answer">Answer</label>
                    <select name="answer" id="answer">
                        <option value="a">option A</option>
                        <option value="b">option B</option>
                        <option value="c">option C</option>
                        <option value="d">option D</option>
                    </select>
                </div>

                <input type="submit" value="Add question">
            </form>
        </div>

        <div id="added_question">
            <form action="">
                <select id="imported_question_select">
                    @foreach ($importedQuestions as $importedQuestion)
                        <option value="{{ $importedQuestion['id'] }}">{!! $importedQuestion['question'] !!}</option>
                    @endforeach
                </select>
            </form>
            <div id="selected_question_details">

            </div>

            <div id="add_selected_question_form_div">
                <form id="add_selected_question_form" action="">
                    @csrf

                    <input type="text" name="importedQuestion" id="importedQuestion" hidden>
                    <input type="text" name="importedQuestion_option_a" id="importedQuestion_option_a" hidden>
                    <input type="text" name="importedQuestion_option_b" id="importedQuestion_option_b" hidden>
                    <input type="text" name="importedQuestion_option_c" id="importedQuestion_option_c" hidden>
                    <input type="text" name="importedQuestion_option_d" id="importedQuestion_option_d" hidden>
                    <input type="text" name="importedQuestion_answer" id="importedQuestion_answer" hidden>
                    <input type="submit" value="Add This Question in Exam Paper">
                </form>
            </div>
        </div>

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
                        <tr id="{{ $question->id }}">
                            <td>{{ $srNo++ }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->option_a }}</td>
                            <td>{{ $question->option_b }}</td>
                            <td>{{ $question->option_c }}</td>
                            <td>{{ $question->option_d }}</td>
                            <td>{{ $question->answer }}</td>

                            <td><a href="{{ route('exam.delete.question', $question->id) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('added_question').style.display = "none";
        document.getElementById('new_question').style.display = "block";
        document.getElementById('add_selected_question_form_div').style.display = "none";


        $('#add_question_form').on('submit', function(e) {
            e.preventDefault();
            let question = $('#question').val();
            let option_a = $('#option_a').val();
            let option_b = $('#option_b').val();
            let option_c = $('#option_c').val();
            let option_d = $('#option_d').val();
            let answer = $('#answer').val();
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
                                <td><a href="{{ url('exam/delete/question/') }}/${question['id']}">Delete</a></td>
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

        var radio_button = document.radio_form.question_type;
        var prev = null;
        for (var i = 0; i < radio_button.length; i++) {
            radio_button[i].addEventListener('change', function() {

                if (this !== prev) {
                    prev = this;
                }
                switch (this.value) {
                    case "added_question_radio":
                        document.getElementById('new_question').style.display = "none";
                        document.getElementById('added_question').style.display = "block";



                        break;

                    case "new_question_radio":
                        document.getElementById('added_question').style.display = "none";
                        document.getElementById('new_question').style.display = "block";
                        break;

                    default:
                        break;
                }
            });
        }

        let importedQuestionSelect = $('#imported_question_select');
        importedQuestionSelect.on('change', function() {


            let selectedQuestionId = importedQuestionSelect.find(":selected").val();

            let selectedQuestionDetails = $('#selected_question_details');
            selectedQuestionDetails.empty();
            @foreach ($importedQuestions as $importedQuestion)
                if ({{ $importedQuestion['id'] }} == selectedQuestionId) {
                var importedQuestion=`{!! $importedQuestion['question'] !!}`;
                var importedQuestion_option_a=`{!! $importedQuestion['A'] !!}`;
                var importedQuestion_option_b=`{!! $importedQuestion['B'] !!}`;
                var importedQuestion_option_c=`{!! $importedQuestion['C'] !!}`;
                var importedQuestion_option_d=`{!! $importedQuestion['D'] !!}`;
                var importedQuestion_answer=`{!! $importedQuestion['ans'] !!}`;

                //console.log("$importedQuestion['question']"+question);
                selectedQuestionDetails.append(`
                Question : ${importedQuestion} <br />
                Option A : ${importedQuestion_option_a} <br />
                Option B : ${importedQuestion_option_b} <br />
                Option C : ${importedQuestion_option_c} <br />
                Option D : ${importedQuestion_option_d} <br />
                Answer Option: ${importedQuestion_answer} <br />
                `);

                let question = $('#importedQuestion').val(importedQuestion);
                let option_a = $('#importedQuestion_option_a').val(importedQuestion_option_a);
                let option_b = $('#importedQuestion_option_a').val(importedQuestion_option_b);
                let option_c = $('#importedQuestion_option_a').val(importedQuestion_option_c);
                let option_d = $('#importedQuestion_option_a').val(importedQuestion_option_d);
                let answer = $('#importedQuestion_answer').val(importedQuestion_answer);

                document.getElementById('add_selected_question_form_div').style.display = "block";

                }
            @endforeach
        });

        $('#add_selected_question_form').submit(false);
        $('#add_selected_question_form').on('submit', function(e) {

            let question = $('#importedQuestion').val();
            let option_a = $('#importedQuestion_option_a').val();
            let option_b = $('#importedQuestion_option_a').val();
            let option_c = $('#importedQuestion_option_a').val();
            let option_d = $('#importedQuestion_option_a').val();
            let answer = $('#importedQuestion_answer').val();

            url = "{{ route('exam.add.question', $exam->id) }}";


            if (question && option_a && option_b && option_c && option_d  && answer) {
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
                                <td><a href="{{ url('exam/delete/question/') }}/${question['id']}">Delete</a></td>
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
                alert('The following question doesnt have all the required field');
            }

        });

    });
</script>

</html>
