$(function () {
    $("#formRegister").submit(function (e) {
        e.preventDefault()

        data = {
            NamaLengkap: $("input[name='NamaLengkap']").val(),
            NamaHandphone: $("input[name='NamaHandphone']").val(),
            Email: $("input[name='Email']").val(),
            Password: $("input[name='Password']").val(),
            PasswordConfirmation: $("input[name='PasswordConfirmation']").val(),
        }

        data = JSON.stringify(data)

        $.ajax({
            type: "POST",
            url: apiRoutes.register,
            data: data,
            success: function (response) {
                window.location = webRoutes.login
            },
            error: function(error) {
                validatorHandler(error, $(".error-container"))
            }
        });
    })
});
