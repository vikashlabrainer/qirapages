# Razorpay FTX Theme I

Qirapages built with Razorpay. 

Qirapages allow people to write blogs , Q/A, articles, tips& tricks, beauty secrets, stocks recommendation. 

What make it different from any other blogging platform?

 - People can implement in-page locking of elements present in the blogs.
 - Simply set "#hide" to particular element to make it private
 
 - "#hide" tagged will be blurred for visitors to the page and theses elements can only be accessed if the payment was done.

# Requirements

This project has been completed with minimal requirements which any people can get easily.

 1. Paid/ Free Hosting with XAMPP installed
 2. Razorpay API
 

## INSTALLATION

1. Clone this repository to your Hosting Provider.
2. Configure the Database
3. Enter the Database name,  Server Name, User Name and Password of database to **config/dbconnect.php** file.
4. Once you have completed these steps import tables in your MySQL database from **tables** folder
5.  You can name this table as per your choice.
6.  Go to **define.php** and insert table name in it accordingly.
7. Also, you must configure all other required configurations.

## DEFINE.PHP

 - **TABLE_NAME**: Table Name to store data from the blog.
 - **CAPTCHA_SECRET**: Enter here your own Google Captcha secret key
 - **RAZORPAY_KEY**: Enter the key provided by Razopay. 
 - **RAZORPAY_SECRET**: Enter the secret key provided by Razorpay.
 - **RAZORPAY_CURRENCY**: Change currency to USD, AUD, INR, etc of your own choice.
 - **TABLE_PAYMENTS**: Enter table name where the payments are stored.
 - **WITHDRAWAL_PAYMENTS**: Enter table name where the withdrawals data are stored.
  

## DEMO URL

https://anonpe.com/qirapages/

Configured it onto my PHP learning personal paid domain in order to make my work available for public.

## SAMPLE MYSQL TABLE

 - Go to **tables** folder.
 - Import it to your database


## API's and their functioning

In the **api** directory of this repo, there are 5 different API's for doing 5 different tasks:-

 - **sendotp.php**: To send OTP to the email id provided.
  - **validateotp.php**: To validate OTP sent to the email.
 - **img.php**: To encrypt the image for public viewers.
 -  **store.php**: API To store data after the blog is published to the table
 - **decryptor.php**: API to restore the original connect after the payment is done.

## SETTING UP THE WEBHOOK

 - Go the the Razorpay. Add webhook address to https://DOMAIN_NAME/qirapages/hook.php

For this demo purpose, Authorization key is not added and can be exploited easily by hackers.

So don't forget to set SECRET in razorpay webhook section and in your hook.php page.

## SETTING UP THE WITHDRAWAL MECHANISM:-

To withdraw money from wallet, we have implemented RazorpayX payout links.
---Not working under **TEST MODE**

 - Go to withdrawal.php
 - Enter the account number of virtual wallet or any which was issued by Razorpay.
 - -Generate the BASE64 KEY for (Razorpay Key : Secret)
 - Add it to the curl request. 


 