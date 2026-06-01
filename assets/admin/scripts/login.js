$(document).ready(function () {
    console.log("login.js loaded");

    $("#UserLoginFormid").validate({
        rules: {
            email: { required: true },
            password: { required: true },
        },
        messages: {
            email: { required: "Please enter the email" },
            password: { required: "Please enter the password" },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {
            let actionUrl = $('meta[name="base-url"]').attr("content") + "/login";
            let formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    $("#loader").show();
                    $("#loginMsg").html("");
                    $(form).find("button[type='submit']").prop("disabled", true);
                },

                success: function (response) {
                    if (response.success) {

                        showToast(response.message, "success");

                        setTimeout(function () {
                            window.location.href = $('meta[name="base-url"]').attr("content") + "/admin/dashboard";
                        }, 1000);
                    }
                },

                error: function (xhr) {
                    if (xhr.responseJSON) {

                        if (xhr.responseJSON.message) {
                            showToast(xhr.responseJSON.message, "error");
                            return;
                        }

                        if (xhr.responseJSON.errors) {
                            printErrorMsg(xhr.responseJSON.errors);
                            return;
                        }
                    }

                    showToast("Something went wrong. Please try again.", "error");
                },

                complete: function () {
                    $("#loader").fadeOut();
                    $(form).find("button[type='submit']").prop("disabled", false);
                },
            });
        },
    });
});

function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        $("." + key + "_err")
            .text(value)
            .show();
    });
}