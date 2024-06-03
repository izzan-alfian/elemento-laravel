@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Modul</h4>
            </div>
            <div class="card-body">
                <form action="" id="formModul" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" name="TitleModul" required autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subtitle</label>
                        <input type="text" name="SubtitleModul" required autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" name="file" type="file" id="formFile" accept="image/*" required autocomplete="off">
                    </div>
                </form>
                <hr>
                <div style="display: none" class="default-bab">
                    <form action="">
                        <input type="hidden" name="id">
                        <input type="hidden" name="modulID" value="{{ $id ?? '' }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Title Bab</label>
                            <input type="text" name="titleBab" required autocomplete="off" class="form-control" placeholder="" aria-describedby="helpId" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi Bab</label>
                            <textarea name="descriptionBab" required autocomplete="off" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Task</label>
                            <textarea name="taskBab" required autocomplete="off" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="text-right">
                            <butotn type="button" class="btn btn-danger btn-sm btn-delete-bab">
                                Delete
                            </butotn>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="bab-container row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3><b>Bab</b></h3>
                        <div>
                            <button class="btn btn-primary btn-add-bab">Tambah Bab</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('modul') }}" class="btn btn-secondary">
                    Back
                </a>
                <button type="submit" form="formModul" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    const modulID = "{{ $id ?? '' }}"

    function renderData()
    {
        $.ajax({
            type: "GET",
            url: apiRoutes.modul + "/" + modulID,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                $.each(response.data, function (index, element) {
                    $(`input[name='${index}Modul']`).val(element)
                });

                if (response.data.Babs.length > 0) {
                    $.each(response.data.Babs, function (index, element) {
                        bab = $(".default-bab:hidden").clone()
                        bab.find("[name='id']").val(element.ID)
                        bab.find("[name='titleBab']").val(element.Title)
                        bab.find("[name='descriptionBab']").val(element.Description)
                        bab.find("[name='taskBab']").val(element.Task)

                        bab.show()
                        $(".bab-container").append(bab)
                    });
                }
            }
        });
    }

    function submitBab(id)
    {
        $("input[name='modulID']").each(function(index, element) {
            $(element).val(id)
        })

        $(".default-bab:visible").each(function(index, element) {
            dataBab = new FormData($(element).find('form')[0])

            $.ajax({
                type: "POST",
                url: apiRoutes.modulBab,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                processData: false,
                contentType: false,
                data: dataBab,
                async: false,
                error: function() {
                    $("#loader-overlay").hide();
                }
            });
        })
    }

    $(function () {
        if (modulID != "")
            renderData()

        $(document).on('click', '.btn-add-bab', function() {
            bab = $(".default-bab:hidden").clone()

            bab.show()

            $(".bab-container").append(bab)
        })

        $(document).on('click', '.btn-delete-bab', function() {
            element = $(this).closest(".default-bab")

            if (id = element.find("[name='id']").val()) {
                $.ajax({
                    type: "DELETE",
                    url: apiRoutes.modulBab + "/" + id,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('Authorization', 'Bearer '+token());
                    },
                    success: function (response) {
                        element.remove();
                    }
                });
            } else {
                element.remove();
            }
        })

        $(document).on('submit', '#formModul', function(e) {
            e.preventDefault()

            $("#loader-overlay").show();

            data = new FormData($(this)[0])

            $.ajax({
                type: "POST",
                url: apiRoutes.modul,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if ($(".default-bab:visible").length >= 1) {
                        submitBab(response.data.modulID)
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
