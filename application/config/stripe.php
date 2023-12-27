<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Stripe API Configuration
| -------------------------------------------------------------------
|
| You will get the API keys from Developers panel of the Stripe account
| Login to Stripe account (https://dashboard.stripe.com/)
| and navigate to the Developers >> API keys page
|
|  stripe_api_key            string   Your Stripe API Secret key.
|  stripe_publishable_key    string   Your Stripe API Publishable key.
|  stripe_currency           string   Currency code.
*/
$config['stripe_api_key'] = 'sk_test_51IWiw1EyQTsPSXRl1FstUiU6Z2GWvlFOWgobQuRF08Am1KHlXqxDc6e2NFfuoQKSGTJZN8wxs5dkYeqvDSIF2cYK00LlQ5qzcM';
$config['stripe_publishable_key'] = 'pk_test_51IWiw1EyQTsPSXRlDr8Mgwy9xYocqk2T0YygKvWsOBSZkvC6HW8pBEem9LghGktOOAhUVl9J8uo9fLByHfAsK9Zs00ysPRrXJ5';
$config['stripe_currency'] = 'usd';
