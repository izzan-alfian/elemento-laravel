@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">List Questions <span id="quizTitle"></span></h4>
                <div class="card-toolbar">
                    <a href="{{ route('quiz.question.create', $id) }}" class="btn btn-primary btn-sm">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tableQuestions">
                        <thead>
                            <tr>
                                <th scope="col" width="3">#</th>
                                <th scope="col">Question</th>
                                <th scope="col" width="45">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    const quizID = "{{ $id ?? '' }}"

    function renderTable() {
        $.ajax({
            url: apiRoutes.quizQuestions + "/" + quizID,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                html = ""
                data = response.data

                $("#quizTitle").html(data.Title)
                $("#quizStatus").html(data.Status)

                console.log(data)
                $.each(data.Question, function (index, element) {
                    html += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${element.Question}</td>
                        <td>
                            <a href="${webRoutes.quizQuestionEdit.replace(":id", quizID).replace(":questionID", element.QuestionID)}" class="btn btn-warning btn-sm">
                                View
                            </a>
                        </td>
                    </tr>
                    `
                });

                $("#tableQuestions").find("tbody").html("")
                if ( $.fn.DataTable.isDataTable('#tableQuestions') ) {
                    $('#tableQuestions').DataTable().destroy();
                }
                $("#tableQuestions").find("tbody").html(html)
                $("#tableQuestions").DataTable()

            }
        });
    }

    $(function () {
        renderTable()
    });
</script>
@endpush
