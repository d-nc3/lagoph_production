<body style="font-family: 'Segoe UI', sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px;">

    <div

        style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">

        

        <div style="background-color: #1abc9c; padding: 20px 30px; display: flex; align-items: center;">

            <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Lagoph Co. Logo"

                style="height: 40px; margin-right: 15px;">

            <h1 style="margin: 0; color: #ffffff; font-size: 25px;">Lagoph Co.</h1>

        </div>



        <div style="padding: 30px;">

            <h2 style="color: #333;">New Customer Inquiry Received</h2>

            <p style="color: #555; font-size: 16px;">

                A new message has been submitted through the contact form. Below are the details:

            </p>



            <h4 style="color: #1abc9c; margin-top: 30px;">Inquiry Information</h4>



            <div style="margin-top: 15px; color: #333;">

                <p><strong>Full Name:</strong> <?= html_escape($fullName) ?></p>

                <p><strong>Email Address:</strong> <?= html_escape($email) ?></p>

                <p><strong>Date Received:</strong> <?= date('F j, Y - g:i A') ?></p>

                <p><strong>Message:</strong><br>

                    <span style="display: block; background: #f9f9f9; padding: 12px; border-left: 4px solid #1abc9c; border-radius: 5px;">

                        <?= nl2br(html_escape($message)) ?>

                    </span>

                </p>

            </div>



            <p style="color: #333; font-size: 15px; margin-top: 30px;">

                Please follow up with the customer as soon as possible.

            </p>



            <p style="color: #333; font-size: 14px; margin-top: 10px;">

                Regards,<br>

                <strong>Automated Inquiry Notification System</strong>

            </p>

        </div>



        <div style="background-color: #f0f0f0; padding: 15px 30px; text-align: center;">

            <p style="font-size: 12px; color: #777;">

                Internal use only — do not forward outside the team.

            </p>

        </div>

    </div>

</body>

