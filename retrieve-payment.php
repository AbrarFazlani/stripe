<?php
require 'vendor/autoload.php';

$stripe = new \Stripe\StripeClient('sk_test_51Nf6NjBOKaFywcAl7t1UQXgSXUApRUVFPBJzMj4fSnlg8dji0kUXIiSEW9lxqzWhb70dDsn6SPywNRQF2QC8EMGw001fEkKsR3');

// Retrieve custom field data
$companynameData = $_POST['companyname'];

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [
    [
      'price' => 'price_1NtvwJBOKaFywcAl29mGTDz0',
      'quantity' => 1,
    ],
  ],
  'metadata' => [
    'companyname' => $companynameData,
  ],
  'mode' => 'payment',
  'allow_promotion_codes' => true,
  'phone_number_collection' => ['enabled' => true],
  'success_url' => 'http://localhost/GPC-stripe/success.html?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => 'http://localhost/GPC-stripe/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>
