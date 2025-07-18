<script> const BASE_URL = '<?= base_url() ?>'; </script>



<!-- Core JS -->

<!-- build:js assets/vendor/js/core.js -->



<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>

<script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/hammer/hammer.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/i18n/i18n.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/typeahead-js/typeahead.js') ?>"></script>

<script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>

<!-- endbuild -->



<!-- Vendors JS -->

<script src="<?= base_url('assets/vendor/libs/cleavejs/cleave.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/block-ui/block-ui.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/bs-stepper/bs-stepper.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/select2/select2.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/@form-validation/popular.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/@form-validation/bootstrap5.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/@form-validation/auto-focus.js') ?>"></script>

<script src="<?= base_url('assets/vendor/libs/sweetalert2/sweetalert2.js') ?>"></script>









<script>

    const showBlockUI = function (message = '') {

        $.blockUI({

            message:

                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>' + message,

            css: {

                backgroundColor: 'transparent',

                color: '#fff',

                border: '0'

            },

            overlayCSS: {

                opacity: 0.5

            }

        });

    }



    const hideBlockUI = function () {

        $.unblockUI();

    }



    const btnLogout = document.querySelector('#btn-logout');

    if (btnLogout) {

        btnLogout.onclick = function () {

            Swal.fire({

                title: 'Are you sure?',

                text: "You will be logged out.",

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Yes!',

                customClass: {

                    confirmButton: 'btn btn-primary me-3',

                    cancelButton: 'btn btn-label-secondary'

                },

                buttonsStyling: false

            }).then(function (result) {

                if (result.value) {

                    Swal.fire({

                        icon: 'success',

                        title: 'Success!',

                        text: 'Logged out successfully!',

                        customClass: {

                            confirmButton: 'btn btn-success'

                        }

                    }).then(() => {

                        window.location.href = BASE_URL + 'Auth/logout';

                    });

                }

            });

        };

    }

</script>



<!-- Main JS -->

<script src="<?= base_url('assets/js/main.js') ?>"></script>



<!-- Page JS -->

<?php if (isset($page_data['scripts_path']) && !empty($page_data['scripts_path'])): ?>

    <?php foreach ($page_data['scripts_path'] as $value): ?>

        <script src="<?= base_url($value) ?>"></script>

    <?php endforeach; ?>

<?php endif; ?>



</body>

</html>