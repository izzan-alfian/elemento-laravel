@extends('layout.base')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Magic Card</h4>
            </div>
            <div class="card-body">
                <form action="" id="formMagicCard" enctype="multipart/form-data">
                    <input type="hidden" name="ID" value="{{ $id ?? '' }}">
                    <input type="hidden" name="alias" value="">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Molekul</label>
                        <input type="text" name="namaMolekul" required autocomplete="off" class="form-control" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">User Molekul</label>
                        <input type="text" name="unsurMolekul" required autocomplete="off" class="form-control" placeholder="" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea type="text" name="description" required autocomplete="off" class="form-control" placeholder=""></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" name="file" type="file" id="formFile" accept="image/*" required autocomplete="off">
                    </div>
                </form>
                <hr>
                <div style="display: none" class="senyawa-unsur">
                    <form action="">
                        <input type="hidden" name="MagicCardId" value="{{ $id ?? '' }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" name="judul" required autocomplete="off" class="form-control" placeholder=""/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Unsur</label>
                            <input type="text" name="unsur" required autocomplete="off" class="form-control" placeholder=""/>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" required autocomplete="off" class="form-control" rows="5"></textarea>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="senyawa-container row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3><b>Unsur Senyawa</b></h3>
                        <div>
                            <button class="btn btn-primary btn-add-senyawa">Tambah Senyawa</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('magic-card') }}" class="btn btn-secondary">
                    Back
                </a>
                <button type="submit" form="formMagicCard" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    const ID = "{{ $id ?? '' }}"

    function renderData()
    {
        $.ajax({
            type: "GET",
            url: apiRoutes.magicCard + "/" + ID,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+token());
            },
            success: function (response) {
                console.log(response.data)
                $("[name='namaMolekul']").val(response.data.NamaMolekul)
                $("[name='unsurMolekul']").val(response.data.UnsurMolekul)
                $("[name='description']").html(response.data.Description)

                if (response.data.ListSenyawa.length > 0) {
                    $.each(response.data.ListSenyawa, function (index, element) {
                        senyawa = $(".senyawa-unsur:hidden").clone()
                        senyawa.find("[name='judul']").val(element.Judul)
                        senyawa.find("[name='unsur']").val(element.Unsur)
                        senyawa.find("[name='deskripsi']").val(element.Deskripsi)

                        senyawa.show()
                        $(".senyawa-container").append(senyawa)
                    });
                }
            }
        });
    }

    $(function () {
        if (ID != "")
            renderData()

        $(document).on('click', '.btn-add-senyawa', function() {
            senyawa = $(".senyawa-unsur:hidden").clone()

            senyawa.show()

            $(".senyawa-container").append(senyawa)
        })

        $(document).on('submit', '#formMagicCard', function(e) {
            e.preventDefault()

            $("#loader-overlay").show();

            nama = $("input[name='namaMolekul']").val()
            $("input[name='alias']").val(`gambar_${nama}`)

            data = new FormData($(this)[0])

            $.ajax({
                type: "POST",
                url: apiRoutes.magicCard,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if ($(".senyawa-unsur:visible").length >= 1) {
                        $("input[name='ID']").each(function(index, element) {
                            $(element).val(response.data.ID)
                        })

                        $(".senyawa-unsur:visible").each(function(index, element) {
                            dataSenyawa = new FormData($(element).find('form')[0])

                            $.ajax({
                                type: "POST",
                                url: apiRoutes.magicCardSenyawa,
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader('Authorization', 'Bearer '+token());
                                },
                                data: dataSenyawa,
                                async: false,
                                error: function() {
                                    $("#loader-overlay").hide();
                                }
                            });
                        })
                    }

                    window.location = webRoutes['magic-card']
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
