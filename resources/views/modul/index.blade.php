@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card col-md-12">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">List Modul</h4>
                <div class="card-toolbar">
                    <a href="{{ route('modul.create') }}" class="btn btn-primary btn-sm">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tableModul">
                        <thead>
                            <tr>
                                <th scope="col" class="w-5">#</th>
                                <th scope="col" class="w-25">Title</th>
                                <th scope="col" class="w-25">Subtitle</th>
                                <th scope="col" class="w-25">Image</th>
                                <th scope="col" class="w-25">Action</th>
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
            url: apiRoutes.modul,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                html = ""
                $.each(response.data, function (index, element) {
                    html += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${element.Title}</td>
                        <td>${element.Subtitle}</td>
                        <td>
                            <img src="${element.ImageUrl}" alt="${element.Title}" height="125"/>
                        </td>
                        <td>
                            <a href="${webRoutes.modulEdit.replace(":id", element.ModulID)}" class="btn btn-warning btn-sm">
                                View/Edit
                            </a>
                            <a href="javascript:void(0)" data-nama="${element.Title}" data-id="${element.ModulID}" class="btn btn-danger btn-sm btn-delete">
                                Delete
                            </a>
                        </td>
                    </tr>
                    `
                });

                $("#tableModul").find("tbody").html("")
                if ( $.fn.DataTable.isDataTable('#tableModul') ) {
                    $('#tableModul').DataTable().destroy();
                }
                $("#tableModul").find("tbody").html(html)
                $("#tableModul").DataTable()
            }
        });
    }

    $(function () {
        renderTable()

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data("id")
            let nama = $(this).data("nama")

            Swal.fire({
                title: `Delete Modul <br> ${nama}?`,
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Save",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: apiRoutes.modul + "/" + id,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer '+token());
                        },
                        success: function (response) {
                            window.location.reload()
                        }
                    });
                }
            });
        })
    });
</script>
@endpush
