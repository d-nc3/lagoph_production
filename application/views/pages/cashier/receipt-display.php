<?php
	   $payment_proof = isset($receipt['payment_proof']) && $receipt['payment_proof'] ? ($receipt['payment_proof']) : NULL;
     
?>
<?php $this->load->view('layout/header'); ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('layout/sidenav'); ?>
            <div class="layout-page">
                <?php $this->load->view('layout/navbar'); ?>
                
                <!-- Content wrapper -->
                <div class="content-wrapper">   
                <div class="container mt-4">
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <!-- Image Display -->
                        <div class="col-lg-10 col-md-12 mb-4">
                            <div class="card border-0 shadow-sm">   
                                <h5 class="card-header bg-primary text-white">Payment Proof</h5>
                                <div class="card-body text-center">
                                    <?php if ($payment_proof): ?>
                                        <img src="<?= base_url($payment_proof) ?>" alt="Payment Proof" class="img-fluid rounded mt-5" style="max-width: 100; height: auto; border: 1px solid #ddd; padding: 5px;">
                                    <?php else: ?>
                                        <p class="text-muted">No payment proof found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                    </div>


                </div>
<!--/ Content wrapper -->
</div>
<?php $this->load->view('layout/footer'); ?>