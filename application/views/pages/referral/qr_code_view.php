<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Generate a QR Code</h1>
    <form id="qrForm">
        <label for="data">Enter Data for QR Code:</label>
        <input type="text" name="data" id="qrData" placeholder="Enter URL or text" required>
        <button type="submit">Generate QR Code</button>
    </form>

    <h2>Generated QR Code</h2>
    <div id="qrCodeContainer"></div>

    <script>
        // Add an event listener to the form submission to handle validation
        document.getElementById('qrForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const input = document.getElementById('qrData').value;
            
            // Validate the input
            if (!input) {
                alert('Please enter some data!');
                return; // Stop further execution if input is empty
            }

            // If validation passes, send the data using AJAX
            $.ajax({
                url: "<?php echo base_url('Referral_member/generate'); ?>", // URL to send data to
                type: "GET", // We use GET as the form method is 'GET'
                data: { data: input }, // Send the data entered in the input field
                success: function(response) {
                    // Assuming the response contains the base64 image string of the QR code
                    $('#qrCodeContainer').html('<img src="data:image/png;base64,' + response + '" alt="QR Code">');
                },
                error: function() {
                    alert('An error occurred while generating the QR code.');
                }
            });
        });
    </script>
</body>
</html>
