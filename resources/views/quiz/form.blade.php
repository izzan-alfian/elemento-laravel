@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Quiz</h4>
            </div>
            <div class="card-body">
                <form action="" id="formQuiz" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="title" required autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="form-select" required autocomplete="off">
                            <option value="not finished">Not Finished</option>
                            <option value="finished">Finished</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('quiz') }}" class="btn btn-secondary">
                    Back
                </a>
                <button type="submit" form="formQuiz" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    // const quizID = "{{ $id ?? '' }}"

    $(function () {
        // if (quizID != "")
        //     renderData()

        $(document).on('submit', '#formQuiz', function(e) {
            e.preventDefault()

            $("#loader-overlay").show();

            data = new FormData($(this)[0])
            data = formDataToJson(data)

            $.ajax({
                type: "POST",
                url: apiRoutes.quiz,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                data: data,
                success: function (response) {
                    window.location = webRoutes.quiz
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
