<!-- Navbar: Start -->

<nav class="layout-navbar shadow-none py-0">

  <div class="container">

    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">



      <!-- Menu logo wrapper: Start -->

      <div class="navbar-brand app-brand demo d-flex py-0 me-4">


        <!-- Mobile menu toggle: End-->
        <a href="landing-page.html" class="app-brand-link">
          <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">LagoPH</span>
        </a>
      </div>

      <!-- Menu logo wrapper: End -->



      <!-- Menu wrapper: Start -->

      <div class="landing-nav-menu" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fw-medium" href="<?=site_url('Landing')?>">Home</a>
          </li>
          <li class="nav-item">
             <a class="nav-link fw-medium" href="<?=site_url('About-us')?>#coopServices">About Us</a>
           </li>


          <li class="nav-item">
            <a class="nav-link fw-medium" href="<?=site_url('Member-process')?>">Membership</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="<?=site_url('FAQ')?>">FAQ</a>
          </li>
          <li class="nav-item">
   <a class="nav-link fw-medium" href="<?= site_url('Landing') ?>#landingContact">Contact Us</a>

          </li>

          <!-- Pages Dropdown -->
          <li class="nav-item dropdown">

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pricing.html">Pricing</a></li>
              <li><a class="dropdown-item" href="payment.html">Payment</a></li>
              <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
              <li><a class="dropdown-item" href="help-center.html">Help Center</a></li>
            </ul>
          </li>

          <!-- Admin Page -->

        </ul>
      </div>

      <div class="landing-menu-overlay d-lg-none"></div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li>
          <a href="<?= site_url('Auth') ?>" class="btn btn-primary" target="_blank"><span
              class="tf-icons bx bx-user me-md-1"></span><span class="d-none d-md-block">Login</span></a>
        </li>
        <!-- navbar button: End -->
      </ul>
      <!-- Toolbar: End -->
    </div>
  </div>
</nav>