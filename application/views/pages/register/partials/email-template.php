<body style="font-family: 'Segoe UI'; background-color: #f4f6f8; margin: 0; padding: 20px;">

    <div

        style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">

        <div style="background-color: #1abc9c; padding: 20px 30px; display: flex; align-items: center;">

            <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Lagoph Co. Logo"

                style="height: 40px; margin-right: 15px;">

            <h1 style="margin: 0; color: #ffffff; font-size: 25px;">Lagoph Co.</h1>

        </div>





        <div style="padding: 30px;">

            <h2 style="color: #333;">Hello <?= html_escape($name) ?>,</h2>

            <p style="color: #555; font-size: 16px;">

                Thank you for registering with <strong>Lagoph Co.</strong> We're excited to have you on board! Please

                click the button below to verify your email address:

            </p>



            <div style="text-align: center; margin: 30px 0;">

                <p style="

                background-color: #f1f1f1;

                color: #333;

                padding: 12px;

                font-family: monospace;

                font-size: 18px;

                border-left: 4px solid #1abc9c;

                border-radius: 4px;

                display: inline-block;

                margin: 10px 0;

            ">

                    <?= html_escape($verification_code) ?>

                </p>

            </div>

            <p style="color: #555; font-size: 14px; margin-top: 30px;">

                If you did not register for this account, you can safely ignore this email.

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



</html>