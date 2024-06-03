@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Question</h4>
            </div>
            <div class="card-body">
                <form action="" id="formQuestion" enctype="multipart/form-data">
                    <input type="hidden" name="quiz_id" value="{{ $id }}">
                    <div class="mb-3">
                        <label for="" class="form-label">Questions</label>
                        <input type="text" name="Question" required autocomplete="off" class="form-control" placeholder="" />
                    </div>
                </form>
                <hr>
                <div style="display: none" class="default-answer">
                    <form action="">
                        <div class="mb-3">
                            <label for="" class="form-label">Answer Title</label>
                            <input type="text" name="answer_title" required autocomplete="off" class="form-control" placeholder="" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Answer Subtitle</label>
                            <input type="text" name="answer_subtitle" required autocomplete="off" class="form-control" placeholder="" />
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="answer-container row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3><b>Answer</b></h3>
                        <div>
                            <button class="btn btn-primary btn-add-answer">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('quizShow', $id) }}" class="btn btn-secondary">
                    Back
                </a>
                <button type="submit" form="formQuestion" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    const quizID = "{{ $id ?? '' }}"
    const questionID = "{{ $questionID ?? '' }}"

    function renderData()
    {
        $.ajax({
            type: "GET",
            url: apiRoutes.quizQuestions + "/" + quizID,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                question = response.data.Question.filter(function(value, index) {
                    return value.QuestionID == questionID;
                })[0];
                $(`input[name='Question']`).val(question.Question)

                if (question.Answer.length > 0) {
                    $.each(question.Answer, function (index, element) {
                        answer = $(".default-answer:hidden").clone()
                        answer.find("[name='answer_title']").val(element.AnswerTitle)
                        answer.find("[name='answer_subtitle']").val(element.AnswerSubtitle)

                        answer.show()
                        $(".answer-container").append(answer)
                    });
                }
            }
        });
    }

    function submitAnswer(id)
    {
        $(".default-answer:visible").each(function(index, element) {
            dataAnswer = new FormData($(element).find('form')[0])
            dataAnswer = formDataToJson(dataAnswer)

            $.ajax({
                type: "POST",
                url: apiRoutes.quizAddAnswer.replace(":id", id),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                data: dataAnswer,
                async: false,
                error: function() {
                    $("#loader-overlay").hide();
                }
            });
        })
    }

    $(function () {
        if (questionID != "")
            renderData()

        $(document).on('click', '.btn-add-answer', function() {
            answer = $(".default-answer:hidden").clone()

            answer.show()

            $(".answer-container").append(answer)
        })

        $(document).on('submit', '#formQuestion', function(e) {
            e.preventDefault()

            $("#loader-overlay").show();

            data = new FormData($(this)[0])
            data = formDataToJson(data)

            $.ajax({
                type: "POST",
                url: apiRoutes.quizAddQuestion.replace(":id", quizID),
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                data: data,
                success: function (response) {
                    if ($(".default-answer:visible").length >= 1) {
                        submitAnswer(response.QuestionID)
                    }

                    window.location = webRoutes.modul
                    $("#loader-overlay").hide();
                },
                error: function() {
                    $("#loader-overlay").hide();
                }
            });
        })
    });
</script>
@endpush
