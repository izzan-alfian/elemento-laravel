@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">List Feedback</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tableFeedback">
                        <thead>
                            <tr>
                                <th scope="col" class="w-5">#</th>
                                <th scope="col" class="w-25">Guru</th>
                                <th scope="col" class="w-25">Siswa</th>
                                <th scope="col" class="w-25">Kategori</th>
                                <th scope="col" class="w-25">Feedback</th>
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
    function renderTable() {
        $.ajax({
            url: apiRoutes.feedback,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                html = ""
                $.each(response.data, function (index, element) {
                    html += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${element.Teacher}</td>
                        <td>${element.Student}</td>
                        <td>${element.Category ? element.Category : "-"}</td>
                        <td>${element.FeedBack}</td>
                    </tr>
                    `
                });

                $("#tableFeedback").find("tbody").html("")
                if ( $.fn.DataTable.isDataTable('#tableFeedback') ) {
                    $('#tableFeedback').DataTable().destroy();
                }
                $("#tableFeedback").find("tbody").html(html)
                $("#tableFeedback").DataTable()
            }
        });
    }

    $(function () {
        renderTable()
    });
</script>
@endpush
