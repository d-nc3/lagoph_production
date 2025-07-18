
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <title>Feature Not Available</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #e6f4ea; /* light green background */
      }

      .error-container {
        text-align: center;
        max-width: 600px;
        padding: 40px;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 10px rgba(0, 128, 0, 0.08);
        border: 2px solid #4caf50;
      }

      .error-image {
        max-width: 180px;
        margin-bottom: 20px;
        filter: hue-rotate(70deg) saturate(1.5);
      }

      h2 {
        color: #388e3c;
        font-weight: 700;
      }

      .text-muted {
        color: #388e3c !important;
        opacity: 0.8;
      }

      .btn-primary {
        background-color: #43a047;
        border-color: #388e3c;
      }
      .btn-primary:hover, .btn-primary:focus {
        background-color: #388e3c;
        border-color: #2e7031;
      }
    </style>
  </head>
  <body>
       <div class="error-container">
      <!-- Use Boxicons CDN for icon -->
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
      <i class="bx bx-error-circle" style="font-size: 100px; color: #43a047; margin-bottom: 20px;"></i>
      <h2 class="mb-3">Feature Not Available</h2>
      <p class="text-muted mb-4">
        Oops! 😕 This feature is currently unavailable or under development.
      </p>
      <a href="<?= $_SERVER['HTTP_REFERER'] ?? url('landing') ?>" class="btn btn-primary">
        Go Back
      </a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>
  </body>
</html>
