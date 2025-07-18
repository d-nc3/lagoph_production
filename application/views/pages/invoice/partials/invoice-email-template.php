<div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px; border: 1px solid #ddd;">
  <h2 style="text-align: center; color: #1abc9c;">Payment Notification</h2>

  <p>Dear <?= $name ?>,</p>

  <p>Greetings from LagoPH Credit Cooperative!</p>
  <p>Please be informed that your LagoPH account has confirmed payment for <strong><?= $transaction_category_id ?></strong>.</p><br />

  <p>Below are the details of your transaction:</p>

  <table style="width: 100%; border-collapse: collapse; margin: 20px 0; font-family: Arial, sans-serif; font-size: 14px;">
    <tr>
      <td><strong>Transaction Date and Time:</strong></td>
      <td><?= $payment_date ?></td>
    </tr>
    <tr>
      <td><strong>Transaction Name:</strong></td>
      <td><?= $transaction_category_id ?></td>
    </tr>
    <tr>
      <td><strong>Invoice Number:</strong></td>
      <td><?= $reference_number ?></td>
    </tr>
    <tr>
      <td><strong>Total Amount:</strong></td>
      <td><strong><?= $total_payment ?></strong></td>
    </tr>
  </table>


  <p>You may print or save this email confirmation for futrue reference.</p>

  <p> Please verify with your bank of transfer has been successfuly completed. If not, notify your banks via email or phone call.</p>
 
  <p>If you have any questions or concerns, feel free to reply to this email or contact our support team.</p>

  <p>Best regards,<br>
    LagoPH</p>

  <hr style="margin: 30px 0;">

  <p style="font-size: 12px; color: #999; text-align: center;">
    © 2025 LagoPh. All rights reserved.<br>
    This is an automated message. Please do not reply directly to this email.
  </p>
</div>