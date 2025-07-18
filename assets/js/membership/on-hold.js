document.addEventListener('DOMContentLoaded', () => {
    const complyBtn = document.querySelector(".reject"); // Changed getElementById to querySelector and use .reject properly

    if (complyBtn) {
        complyBtn.addEventListener("click", function (event) {
            event.preventDefault();
            const member_id = $(this).data('member-id');
            showBlockUI();

            $.ajax({
                url: `${BASE_URL}Membership/comply`, // Make sure BASE_URL is declared globally
                type: "POST",
                data: {
                    member_id:member_id  // example: data-id="123" from HTML
                },
                dataType: 'json',
                success: function (response) {
                    hideBlockUI();
                    if (response.status) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(() => {
                            window.location.href = BASE_URL + 'Membership';
                        });
                    } else {
                        let html = '<div class="text-start">Please check the following fields:</br>';
                        html += '<ol>';
                        if (response.validation_errors) {
                            $.each(response.validation_errors, function (key, value) {
                                html += '<li><b>' + value['label'] + '</b> : ' + value['message'] + '</li>';
                            });
                        }
                        html += '</ol></div>';
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            html: html,
                            showCloseButton: true,
                            focusConfirm: true,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function (xhr) {
                    hideBlockUI();
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    }
});
