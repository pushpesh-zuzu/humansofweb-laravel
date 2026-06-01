$().ready(function () {


    $("#offlineBookingForm").validate({
        rules: {
            room_no: { required: true },
            total_guests: { required: true },
            check_in: { required: true },
            check_out: { required: true },

            per_day_price: { required: true, number: true },
            booking_day: { required: true, number: true },
            total_amount: { required: true, number: true },
            paid_amount: { required: true, number: true },

            "guests[0][name]": { required: true },
            "guests[0][phone]": { required: true, minlength: 10, maxlength: 10, number: true },
            cash_received_by: {
                required: function () {
                    return $('select[name="payment_mode"]').val() === 'cash';
                }
            },
            owner_payment_screenshot: {
                required: function () {
                    return $('select[name="transferred_to_owner"]').val() === 'yes'
                        && $('#booking_id').val().trim() === '';
                }
            }
        },

        messages: {
            room_no: "Select Room No",
            total_guests: "Select total guests",
            check_in: "Select check-in date",
            check_out: "Select check-out date",

            per_day_price: "Enter per day price",
            booking_day: "Select booking days",
            total_amount: "Enter total amount",
            paid_amount: "Enter paid amount",

            "guests[0][name]": "Enter guest name",
            "guests[0][phone]": "Enter valid phone number",
            cash_received_by: "Enter who received the cash",
            owner_payment_screenshot: "Please upload payment screenshot"
        },

        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".col-md-3, .col-lg-3, .col-lg-12").append(error);
        },

        highlight: function (element) {
            $(element).addClass("is-invalid");
        },

        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },

        submitHandler: function (form) {

            var formData = new FormData(form);
            const actionUrl = $(form).attr("action");

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    $("#loader").show();
                },

                success: function (response) {
                    if (response.success) {

                        showToast(response.message, "success");

                        $("#offlineBookingForm")[0].reset();
                        let baseUrl = $('meta[name="base-url"]').attr("content");
                        // Optional: guests reset
                        window.location.href = baseUrl + '/admin/offlinebookings';


                    } else {                       
                        showToast(response.message, "error");
                    }
                },

                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        alert('d')
                        printErrorMsg(xhr.responseJSON.errors);
                    } else {
                        showToast("Something went wrong!", "error");
                    }
                },

                complete: function () {
                    $("#loader").fadeOut();
                }
            });
        }
    });


});

function printErrorMsg(msg) {
    $.each(msg, function (key, value) {
        showToast(value, "error");
        $("." + key + "_err").text(value).show()
    });
}

$(document).ready(function () {
    $(".autocompleteoff").attr("autocomplete", "off");
    setTimeout('$(".autocompleteoff").val("");', 500);
});

$("#addUserModal").on("hidden.bs.modal", function () {
    $(this).find("form")[0].reset(); // Reset the form
    $(this).find(".error").text('');
    $(this).find(".is-invalid").removeClass("is-invalid"); // Remove validation errors
    $(this).find(".invalid-feedback").remove(); // Remove error messages
    $(this).find(".custom-file-label").text("Upload File"); // Reset file label text
});
$("#editUserModal").on("hidden.bs.modal", function () {
    $(this).find(".error").text('');

    $(this).find("form")[0].reset(); // Reset the form
    $(this).find(".is-invalid").removeClass("is-invalid"); // Remove validation errors
    $(this).find(".invalid-feedback").remove(); // Remove error messages
    $(this).find(".custom-file-label").text("Upload File"); // Reset file label text

    const passwordInput = $(this).find("#passwordEdit")[0];

    if (passwordInput) {
        passwordInput.setAttribute("disabled", "disabled");
        passwordInput.removeAttribute("required");
    }
});

$(document).on("click", ".edit-record", function () {
    let encryptedId = $(this).data("id");
    let baseUrl = $('meta[name="base-url"]').attr("content");
    $.ajax({
        url: baseUrl + "/admin/user/" + encryptedId + "/edit",
        type: "GET",
        beforeSend: function () {
            $("#loader").show();
        },
        success: function (res) {
            if (res.status) {
                // Fill modal form with data
                $("#editUserModal #roleId").val(res.user.role_id);
                $("#editUserModal #userId").val(res.user.id);
                $("#editUserModal #userName").val(res.user.name);
                $("#editUserModal #userEmail").val(res.user.email);
                $("#editUserModal #userMobile").val(res.user.mobile);
                $("#editUserModal").modal("show");
            } else {
                showToast(res.message || "Something went wrong.", "error");
            }
        },
        error: function (xhr) {
            if (xhr.status === 403) {
                alert("Permission denied.");
            } else {
                alert("Failed to load user details.");
            }
        },
        complete: function () {
            $("#loader").fadeOut();
        },
    });
});
