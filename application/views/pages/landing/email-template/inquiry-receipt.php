<body style="font-family: 'Segoe UI', sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px;">

    <div

        style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">

        

        <div style="background-color: #1abc9c; padding: 20px 30px; display: flex; align-items: center;">

            <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Lagoph Co. Logo"

                style="height: 40px; margin-right: 15px;">

            <h1 style="margin: 0; color: #ffffff; font-size: 25px;">Lagoph Co.</h1>

        </div>



        <div style="padding: 30px;">

            <h2 style="color: #333;">Hello <?= html_escape($fullName) ?>,</h2>

            <p style="color: #555; font-size: 16px;">

                Thank you for reaching out to <strong>Lagoph Co.</strong> via our contact form.

                We have received your message and will get back to you shortly.

            </p>



            <h4 style="color: #1abc9c; margin-top: 30px;">Your Inquiry Details</h4>



            <div style="margin-top: 15px; color: #333;">

                <p><strong>Full Name:</strong> <?= html_escape($fullName) ?></p>

                <p><strong>Email Address:</strong> <?= html_escape($email) ?></p>

                <p><strong>Message:</strong><br><?= nl2br(html_escape($message)) ?></p>

            </div>



            <p style="color: #555; font-size: 14px; margin-top: 30px;">

                If you did not send this inquiry, you can safely ignore this message.

            </p>



            <p style="color: #333; font-size: 15px; margin-top: 30px;">

                Best regards,<br>

                <strong>Lagoph Co. Admin</strong>

            </p>

        </div>



        <div style="background-color: #f0f0f0; padding: 15px 30px; text-align: center;">

            <p style="font-size: 12px; color: #777;">

                This is an automated message. Please do not reply.

            </p>

        </div>

    </div>

</body>

