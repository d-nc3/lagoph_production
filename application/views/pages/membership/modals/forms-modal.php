<div class="modal fade" id="seminar_instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header"
        style="background-color: #008080; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <h5 class="modal-title w-100 text-white text-center" id="profileProgressModalLabel">
          <i class="bi me-2"></i> Note to Applicant
        </h5>
      </div>
      <div class="modal-body text-center">
        <div class="mb-3">
          <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" height="50" width="50">
        </div>
        <h5 style="color: #008080;">Dear valued Applicant!</h5>
        <div class="modal-body">

          <p>To access the seminar scheduling page, follow these steps:</p>
          <ol>
            <li>Click on the link above to open the seminar scheduling page.</li>
            <li>Fill in the required details on the form, such as your name, email, and preferred seminar date.</li>
            <li>Click the "Submit" button to confirm your seminar schedule.</li>
          </ol>
        </div>
        <p class="fw-semibold">Thank you!</p>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="<?= site_url('Membership/schedules') ?>" class="btn btn-lg" style="background-color: #008080; color: white;">
          Go to Seminar Scheduler
        </a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="payment_instruction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header"
        style="background-color: #008080; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <h5 class="modal-title w-100 text-white" id="profileProgressModalLabel">
          <i class="bi me-2"></i> Note to Applicant
        </h5>
      </div>
      <div class="modal-body">
        <div class="mb-3 text-center">
          <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" height="50" width="50">
        </div>
        <h5 class="text-center" style="color: #008080;">Dear valued Applicant!</h5>

        <p>Please pay your accountabilities to the following bank account:</p>

        <div class="text-center mb-3">
          <h5><strong>Bank Account Details:</strong></h5>
          <pre>
Bank Name: Sample Bank
Account Name: John Doe
Account Number: 123-456-789
Routing Number: 987654321
            </pre>
        </div>

        <p><strong>After payment, please log in to your member account and upload your proof of payment:</strong></p>

        <ul class="text-left" style="margin-left: 20px;">
          <li>Login to your account using your registered credentials.</li>
          <li>Go to your membership tab in the side navigation.</li>
          <li>Navigate to the <strong>Membership</strong> section.</li>
          <li>In the <strong>Membership Fee</strong> and <strong>Contribution</strong> areas, select <strong>Yes</strong> where applicable.</li>

          <li>
            Click the <strong>"Upload Proof of Payment"</strong> button in the Proof of Payment field,
            enter your <strong>Reference Number</strong> and <strong>Account Number</strong>,
            then select the file from your device.
          </li>

        </ul>

        <p><strong>Example Data for Upload:</strong></p>
        <ul style="text-align: left; margin-left: 20px;">
          <li>File Name: <strong>Proof_of_Payment_JohnDoe.pdf</strong></li>
          <li>File Type: <strong>PDF, JPG, PNG</strong></li>
        </ul>

        <p class="fw-semibold text-center">Thank you!</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>