@extends('student.layouts.layout')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>

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
            <div class="col-md-6  text-right m-auto white-text">
                <h2 class="pr-4">
                    <span id="minutes">
                        <p id=""></p>
                    </span>:<span id="seconds">03</span>

                </h2>
            </div>

        </div>
    </section>
    <section style="background:#fafafa;">
        <div class="row m-0 p-0 ">
            <div class="col-md-8">

                <div class="py-5 px-5">

                    <h5 class="font-weight-bold" id="question_widget">

                    </h5>
                    <h5 class="question">

                        <br>
                        जावास्क्रिप्टमध्ये विविध डेटा प्रकार कोणते आहेत?<br>
                        जावास्क्रिप्ट में मौजूद विभिन्न डेटा प्रकार क्या हैं?
                    </h5>
                    <!-- answer -->
                    <hr>
                    <div class="mt-4">
                        <!-- Group of default radios - option 1 -->

                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="groupOfDefaultRadios"
                                id="option_a_widget_input" value="1">

                            <label class="custom-control-label" for="option_a_widget_input">
                                <p id="option_a_widget"></p> <span>option
                                    Marathi</span>
                            </label>
                        </div>


                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="option_b_widget_input"
                                name="groupOfDefaultRadios" value="2">
                            <label class="custom-control-label" for="option_b_widget_input">
                                <p id="option_b_widget"></p><span>option Marathi</ span>
                            </label>

                        </div>

                        <!-- Group of default radios - option 3 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="option_c_widget_input"
                                name="groupOfDefaultRadios" value="3">
                            <label class="custom-control-label" for="option_c_widget_input">
                                <p id="option_c_widget"></p><span>option Marathi</ span>
                            </label>
                        </div>
                        <!-- Group of default radios - option 3 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="groupOfDefaultRadios"
                                id="option_d_widget_input" value="4">
                            <label class="custom-control-label" for="option_d_widget_input">
                                <p id="option_d_widget">{!! $questionPaper['questions']->first()->option_d !!}</p><span>option Marathi</ span>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="row text-right   ">
                    <div class="col-md-2 m-0 p-0">
                        <a class="btn btn-custom btn-md btn-outline-danger shadow-none" rel="noopener noreferrer"
                            id="save">Save</a>
                    </div>



                    <div class="col-md-3 m-0 p-0">
                        <a class="btn btn-custom btn-md btn-success shadow-none" rel="noopener noreferrer"
                            id="save_and_next">Save & Next</a>

                    </div>


                    <div class="col-md-2 m-0 p-0">
                        <a class="btn btn-custom btn-md btn-outline-danger shadow-none" rel="noopener noreferrer"
                            id="next_question">Next</a>
                    </div>

                    <div class="col-md-2 m-0 p-0">
                        <a class="btn btn-custom btn-md btn-outline-danger shadow-none" rel="noopener noreferrer"
                            id="update">Update</a>
                    </div>



                    <div class="col-md-3 m-0 p-0">
                        <a class="btn btn-custom btn-md btn-success shadow-none" rel="noopener noreferrer"
                            id="submit">Submit</a>

                    </div>
                </div>
            </div>

            <div class="col-md-4 m-0 p-0">
                <div class="card shadow-none py-5 m-0">
                    <div class="card-body m-0 p-0">
                        <div class="px-4">
                            <h4 class="card-title font-weight-bold" id="student_name"></h4>
                            <p class="mb-0 text-16">Course / Branch :
                            <p id=banch_name></p>
                            </p>

                        </div>
                        <hr class="mb-0 pb-0">
                        <div class="px-4 py-2">
                            <svg height="20" width="20">
                                <circle cx="10" cy="10" r="7" stroke="black" stroke-width="1" fill="white" />
                            </svg> <span class="text-14" id="all_questions_count">20</span>&ensp;
                            <svg height="20" width="20">
                                <circle cx="10" cy="10" r="7" stroke="" stroke-width="1" fill="red" />
                            </svg> <span class="text-14" id="not_attempted_question_count">10</span>&ensp;
                            <svg height="20" width="20">
                                <circle cx="10" cy="10" r="7" stroke="" stroke-width="1" fill="green" />
                            </svg> <span class="text-14" id="attempted_question_count">10</span>&ensp;
                        </div>
                        <hr class="m-0 p-0">
                        <div class="px-3">
                            <ul class="list-inline" id="questions_panel_widget">
                                {{-- <li class="list-inline-item active">
                                    <a class="btn-floating btn-white d-flex align-items-center "><span
                                            class="black-text">1</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-danger d-flex align-items-center border-none white-text "><span
                                            class="">2</span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn-floating btn-success d-flex align-items-center border-none white-text "><span
                                            class="">3</span></a>
                                </li> --}}

                            </ul>
                        </div>
                    </div>



                    <script type="text/javascript">
                        $(document).ready(function() {
                            var backObject = @json($questionPaper);
                            var questions = @json($questionPaper['questions']);


                            var durationInMinutes = {{ $questionPaper['student_exam']['time_remaining'] }};
                            var studentName = "{{ $questionPaper['student']['name'] }}";

                            var questionWidget = $("#question_widget");
                            var OptionAWidget = $("#option_a_widget");
                            var OptionBWidget = $("#option_b_widget");
                            var OptionCWidget = $("#option_c_widget");
                            var OptionDWidget = $("#option_d_widget");

                            var questionsCount = "{{ $questionPaper['questions']->count() }}";
                            var attemptedQuestionsCount =
                                "{{ $questionPaper['questions']->whereNotNull('selected_answer')->count() ?? 0 }}";
                            var notAtteptedQuestionCount = 0;

                            //$("#update_test").on('click', updateExam);


                            console.log(questions);
                            questionWidget.html(1 + " . " + questions[0]['question']);
                            questionWidget.attr("number", "1");

                            OptionAWidget.html(questions[0]['option_a']);
                            OptionBWidget.html(questions[0]['option_b']);
                            OptionCWidget.html(questions[0]['option_c']);
                            OptionDWidget.html(questions[0]['option_d']);

                            switch (backObject['questions'][0]['selected_answer']) {
                                        case "1":
                                            $('#option_a_widget_input').prop('checked', true);
                                            break;
                                        case "2":
                                            $('#option_b_widget_input').prop('checked', true);
                                            break;
                                        case "3":
                                            $('#option_c_widget_input').prop('checked', true);
                                            break;
                                        case "4":
                                            $('#option_d_widget_input').prop('checked', true);
                                            break;
                                        default:
                                            $('input:radio[name=groupOfDefaultRadios]').each(function() {
                                                $(this).prop('checked', false);
                                            });
                                            break;
                                    }

                            if (backObject['is_exam_started']) {
                                setQuestionNumberPanel();
                            }

                            $('#save_and_next').on('click', saveAndNext);
                            $('#next_question').on("click", nextQuestion);
                            $('#submit').on('click', submitButtonClicked);
                            $('#save').on('click', save);
                            $('#update').on('click', updateExam);

                            $("#student_name").text(studentName);
                            $("#all_questions_count").text(questionsCount);
                            $("#attempted_question_count").text(attemptedQuestionsCount);
                            $("#not_attempted_question_count").text(notAtteptedQuestionCount);


                            setQuestionsListPanelWidget();


                            var secondsWidget = $('#seconds').text(60);
                            var minutesWidget = $('#minutes').text(--durationInMinutes);

                            var timeCounter = 0;
                            setInterval(function() {
                                timeCounter++;
                                let seconds = secondsWidget.text();
                                let minutes = minutesWidget.text();

                                if (seconds <= 0) {
                                    if (minutes <= 0) {
                                        submitExam();
                                    }
                                    seconds = 59;
                                    minutes--;
                                } else {
                                    seconds--;
                                }
                                secondsWidget.text(seconds);
                                minutesWidget.text(minutes);

                                if (timeCounter % 300 == 0) {
                                    updateExam();
                                }
                            }, 1000);


                            function submitButtonClicked() {
                                if (confirm('Do you really want to submit this exam.?')) {
                                    submitExam();
                                }
                            }


                            function submitExam() {

                                let url = "{{ route('submit.exam') }}";
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "data": backObject,

                                    },
                                    success: function(result) {
                                        if (result['status'] == 'S') {
                                            alert(result['message']);
                                            window.location.replace("{{ route('exam.completed.message',$questionPaper['student_exam']['id']) }}");

                                        } else {
                                            alert(result['message']);
                                            if (result['is_submitted'] == 1) {
                                                window.location.replace("{{ route('exam.completed.message',$questionPaper['student_exam']['id']) }}");
                                            }
                                        }

                                        console.log(result);
                                    },
                                    error: function(xhr, resp, text) {
                                        console.log(xhr, resp, text);
                                    }
                                });
                            }


                            function updateExam() {

                                let url = "{{ route('update.exam') }}";
                                $.ajax({
                                    url: url,
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "data": backObject,
                                    },
                                    success: function(result) {
                                        if (result['status'] == 'S') {
                                            console.log("Exam updated successfully");
                                            // backObject = result['backObject'];

                                        } else {
                                            //alert(result['message']);
                                            if (result['is_submitted'] == 1) {
                                                window.location.replace("{{ route('exam.completed.message',$questionPaper['student_exam']['id']) }}");
                                            }
                                        }

                                        console.log(result);
                                    },
                                    error: function(xhr, resp, text) {
                                        console.log(xhr, resp, text);
                                    }
                                });
                            }




                            function setQuestionsListPanelWidget() {
                                for (let i = 0; i < questions.length; i++) {
                                    if (backObject['questions'][i]['selected_answer']) {
                                        $("#questions_panel_widget").append(
                                            `<li class="list-inline-item active" id="question_panel_` + (i + 1) +
                                            `">
                                        <a class="btn-floating btn-success d-flex align-items-center " id="question_panel_anchor_` +
                                            (i + 1) + `"><span
                                                class="black-text">` + (i + 1) + `</span></a>
                                    </li>`);
                                    } else {
                                        $("#questions_panel_widget").append(
                                            `<li class="list-inline-item active" id="question_panel_` + (i + 1) +
                                            `">
                                        <a class="btn-floating btn-white d-flex align-items-center " id="question_panel_anchor_` +
                                            (i + 1) + `"><span
                                                class="black-text">` + (i + 1) + `</span></a>
                                    </li>`);
                                    }
                                }
                            }


                            for (let i = 0; i < backObject['questions'].length; i++) {
                                const element = "#question_panel_anchor_" + (i + 1);
                                $(element).on('click', function() {
                                    x = i + 1;
                                    questionWidget.html(x + " . " + questions[i]['question']);
                                    OptionAWidget.html(questions[i]['option_a']);
                                    OptionBWidget.html(questions[i]['option_b']);
                                    OptionCWidget.html(questions[i]['option_c']);
                                    OptionDWidget.html(questions[i]['option_d']);
                                    questionWidget.attr("number", x);
                                    console.log("answer : " + backObject['questions'][i]['selected_answer']);


                                    switch (backObject['questions'][i]['selected_answer']) {
                                        case "1":
                                            $('#option_a_widget_input').prop('checked', true);
                                            break;
                                        case "2":
                                            $('#option_b_widget_input').prop('checked', true);
                                            break;
                                        case "3":
                                            $('#option_c_widget_input').prop('checked', true);
                                            break;
                                        case "4":
                                            $('#option_d_widget_input').prop('checked', true);
                                            break;
                                        default:
                                            $('input:radio[name=groupOfDefaultRadios]').each(function() {
                                                $(this).prop('checked', false);
                                            });
                                            break;
                                    }

                                });
                            }


                            function nextQuestion() {
                                var questionNumber = parseInt(questionWidget.attr("number"));
                                //alert(questions.length+questionNumber);
                                if (questionNumber <= questions.length - 1) {
                                    //alert(" question number = "+questionNumber+" questions length = "+questions.length);
                                    questionNumber++;
                                    questionWidget.html(questionNumber + " . " + questions[questionNumber - 1]['question']);
                                    OptionAWidget.html(questions[questionNumber - 1]['option_a']);
                                    OptionBWidget.html(questions[questionNumber - 1]['option_b']);
                                    OptionCWidget.html(questions[questionNumber - 1]['option_c']);
                                    OptionDWidget.html(questions[questionNumber - 1]['option_d']);

                                    questionWidget.attr("number", questionNumber);

                                    //alert("question_panel_anchor_" + (questionNumber - 1));

                                    $("#question_panel_anchor_" + (questionNumber - 1)).css("btn-danger");

                                    $("#question_panel_anchor_" + (questionNumber - 1)).removeAttr("class");
                                    $("#question_panel_anchor_" + (questionNumber - 1)).attr("class",
                                        "btn-floating btn-danger d-flex align-items-center");
                                    //attemptedQuestionsCount++;
                                   // notAtteptedQuestionCount++;
                                    $("#not_attempted_question_count").text(++notAtteptedQuestionCount);
                                    $("#attempted_question_count").text(attemptedQuestionsCount);

                                } else {
                                    alert('This is the last question');
                                }

                                //questionWidget.attr("number", "1");
                            }

                            function saveAndNext() {
                                //updateExam();
                                var questionNumber = parseInt(questionWidget.attr("number"));
                                let selectedOption = $('input[name="groupOfDefaultRadios"]:checked').val();
                                if (!selectedOption) {
                                    return alert("NO option selected.!");
                                }


                                if (!backObject['questions'][questionNumber - 1]['selected_answer']) {
                                    attemptedQuestionsCount++;
                                    $("#attempted_question_count").text(attemptedQuestionsCount);

                                }

                                backObject['questions'][questionNumber - 1]['selected_answer'] = selectedOption;
                                 if (questionNumber <= questions.length - 1) {
                                    questionNumber++;

                                    questionWidget.html(questionNumber + " . " + questions[questionNumber - 1]['question']);

                                    OptionAWidget.html(questions[questionNumber - 1]['option_a']);
                                    OptionBWidget.html(questions[questionNumber - 1]['option_b']);
                                    OptionCWidget.html(questions[questionNumber - 1]['option_c']);
                                    OptionDWidget.html(questions[questionNumber - 1]['option_d']);

                                    questionWidget.attr("number", questionNumber);

                                    // alert("question_panel_anchor_" + (questionNumber - 1));

                                    $("#question_panel_anchor_" + (questionNumber - 1)).css("btn-success");

                                    $("#question_panel_anchor_" + (questionNumber - 1)).removeAttr("class");
                                    $("#question_panel_anchor_" + (questionNumber - 1)).attr("class",
                                        "btn-floating btn-success d-flex align-items-center");

                                    let selectedOption = $('input[name="groupOfDefaultRadios"]:checked').val();

                                } else {
                                    alert('This is the last question');
                                }
                                $('input:radio[name=groupOfDefaultRadios]').each(function() {
                                    $(this).prop('checked', false);
                                });
                                //questionWidget.attr("number", "1");
                            }

                            function save() {

                                var questionNumber = parseInt(questionWidget.attr("number"));

                                if(! backObject['questions'][questionNumber - 1]['selected_answer']){
                                    attemptedQuestionsCount++;
                                }


                                let selectedOption = $('input[name="groupOfDefaultRadios"]:checked').val();
                                if (!selectedOption) {
                                    return alert("NO option selected.!");
                                }

                                backObject['questions'][questionNumber - 1]['selected_answer'] = selectedOption;
                                console.log(backObject['questions'][questionNumber - 1]);
                                $("#question_panel_anchor_" + questionNumber).css("btn-success");

                                $("#question_panel_anchor_" + questionNumber).removeAttr("class");
                                $("#question_panel_anchor_" + questionNumber).attr("class",
                                    "btn-floating btn-success d-flex align-items-center");



                              $("#attempted_question_count").text(attemptedQuestionsCount);

                                // updateExam();

                            }

                            function setQuestionNumberPanel() {
                            }


                        });
                    </script>
