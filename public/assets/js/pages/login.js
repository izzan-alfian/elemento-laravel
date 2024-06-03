$(function () {
    $.removeCookie("user");

    $("#formLogin").submit(function (e) {
        e.preventDefault()

        $("#loader-overlay").show();

        data = new FormData($(this)[0])
        data = formDataToJson(data)

        $.ajax({
            type: "POST",
            url: apiRoutes.login,
            data: data,
            success: function (response) {
                $.cookie("user", response.data);
                window.location = webRoutes.dashboard
                $("#loader-overlay").hide();
            },
            error: function (response) {
                error = JSON.stringify(response.responseJSON.messages)

                html = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul>
                        ${error}
                    </ul>
                </div>`

                $(".error-container").append(html)
                $("#loader-overlay").hide();
            }
        });
    })
});
