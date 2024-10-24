<?php

$reference = '';
$redirectResult = '';
$redirectUrl = '';
$cnum = '';

if (isset($_GET['reference'])) {
  $reference = $_GET['reference'];
  include '../conn.php';
$update ="UPDATE `tbl_payments` SET oldcnum ='".$_GET['cnum']."' WHERE refnum ='".$_GET['reference']."' ";
$insnew2=$conn->query($update);
}

if (isset($_GET['redirectResult'])) {
  $redirectResult = $_GET['redirectResult'];
}

if (isset($_GET['redirectUrl'])) {
  $redirectUrl = $_GET['redirectUrl'];
}

if (isset($_GET['cnum'])) {
  $cnum = $_GET['cnum'];
   $cnum2 = $_GET['cnum'];
}

if (empty($reference) || empty($redirectResult) || empty($redirectUrl) || empty($cnum)) {
  header('Location: /user/pages/index.php');
  exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/adyen.php';

$client = client();
$service = new \Adyen\Service\Checkout($client);

$params = [
  'details' => [
    'redirectResult' => $redirectResult,
  ],
];

$result = $service->paymentsDetails($params);

if ($result['resultCode'] === 'Authorised') {
  updatePaymentRecordStatus($reference, $cnum, 'PAID');
  header('Location: ' . urldecode($redirectUrl));
  exit;
}



header('Location: /user/pages/index.php');
