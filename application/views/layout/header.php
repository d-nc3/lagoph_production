<!doctype html>

<html

  lang="en"

  class="light-style layout-wide customizer-hide"

  dir="ltr"

  data-theme="theme-default"

  data-assets-path="<?=base_url('assets')?>/"

  data-template="vertical-menu-template">

  <head>

    <meta charset="utf-8" />

    <meta

      name="viewport"

      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



    <title><?= $page_data['title'] ?> | Communities Savings and Credit Coopertive Philippines</title>



    <meta name="description" content="" />



    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon/favicon.ico')?>" />



    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />



    <link

      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"

      rel="stylesheet" />



    <!-- Icons -->

    <link rel="stylesheet" href="<?=base_url('assets/vendor/fonts/boxicons.css')?>" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/fonts/fontawesome.css')?>" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/fonts/flag-icons.css')?>" />



    <!-- Core CSS -->

    <link rel="stylesheet" href="<?=base_url('assets/vendor/css/rtl/core.css')?>" class="template-customizer-core-css" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/css/rtl/theme-default.css')?>" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="<?=base_url('assets/css/demo.css')?>" />



    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')?>" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/typeahead-js/typeahead.css')?>" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/sweetalert2/sweetalert2.css')?>" />

    <!-- Vendor -->

    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/@form-validation/form-validation.css')?>" />

    <link rel="stylesheet" href="<?=base_url('assets/vendor/libs/spinkit/spinkit.css')?>" />



    <!-- Page CSS -->

    <?php if (isset($page_data['styles_path']) && !empty($page_data['styles_path'])) : ?>

        <?php foreach ($page_data['styles_path'] as $value) : ?>

            <link rel="stylesheet" href="<?=base_url($value)?>" />

        <?php endforeach; ?>

    <?php endif; ?>





    <!-- Helpers -->

    <script src="<?=base_url('assets/vendor/js/helpers.js')?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->

    <script src="<?=base_url('assets/vendor/js/template-customizer.js')?>"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="<?=base_url('assets/js/config.js')?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_API_KEY ?>&libraries=places"></script>




  </head>



  <body>