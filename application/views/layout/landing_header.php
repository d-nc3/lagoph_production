
<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?=base_url('assets')?>/"
  data-template="front-pages-no-customizer">
<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title><?= $page_data['title'] ?> | Cybercommunity Cooperative Philippines</title>
  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon/favicon.ico')?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

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

  <script src="<?=base_url('assets/js/config.js')?>"></script>
    <script src="<?=base_url('assets/js/dropdown-hover.js')?>"></script>
     <script src="<?=base_url('assets/js/mega-dropdown.js')?>"></script>


</head>
<body>