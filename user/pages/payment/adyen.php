<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Adyen\Util\Uuid;

function savePaymentRecord($uuid, $name, $type, $amount, $cnum) {
  include __DIR__ . '/../conn.php';

  $sql = "
    INSERT INTO `tbl_payments`
    (`status`, `cnum`, `oldcnum`, `name`, `typee`, `payment_type`, `amount`, `refnum`, `photoupload`, `datepaid`, `dateprocessed`) VALUES ('PENDING', ?, ?, ?, ?, 'gcash', ?, ?, 'N/A', ?, ?)
  ";

  $date = date('Y-m-d');
  $amount = strval($amount);

  $query = $conn->prepare($sql);
  $query->bind_param('ssssssss', $cnum, $cnum, $name, $type, $amount, $uuid, $date, $date);
  $query->execute();
}

function updatePaymentRecordStatus($uuid, $cnum, $status) {
  include __DIR__ . '/../conn.php';

  $sql = "
    UPDATE `tbl_payments` SET `status` = ?, `datepaid` = ?, `cnum` = ? WHERE `refnum` = ?
  ";

  $date = date('Y-m-d');

  $query = $conn->prepare($sql);
  $query->bind_param('ssss', $status, $date, $cnum, $uuid);
  $query->execute();

  $sql = "
    UPDATE `tbl_request` SET `request_type` = 'NEW' WHERE `cnum` = ?
  ";
  
  $query = $conn->prepare($sql);
  $query->bind_param('s', $cnum);
  $query->execute();
}

function client() {
  $client = new \Adyen\Client();
  $client->setXApiKey("AQEnhmfuXNWTK0Qc+iSRlmU7psWYS4RYA4chYLntympDpA0lrrQmKitcEMFdWw2+5HzctViMSCJMYAc=-6NSZGjYmEk6B2v76J3AcfWZVOsxfwY6nWUVondScMjI=-ppZbM9Mfh<>CGt56");
  $client->setEnvironment(\Adyen\Environment::TEST);
  $client->setTimeout(30);

  return $client;
}

function adyen($name, $type, $redirectUrl, $cnum, $amount = 35) {
  $client = client();
  $uuid = Uuid::generateV4();

  $url = 'http://localhost:8081';
  // $url = 'https://milawid.online';
  $redirectUrl = $url . $redirectUrl;

  $service = new \Adyen\Service\Checkout($client);
  $params = [
    'amount' => [
      'currency' => 'PHP',
      'value' => $amount * 100,
    ],
    'reference' => $uuid,
    'paymentMethod' => [
      'type' => 'gcash',
    ],
    'returnUrl' => $url . '/user/pages/payment/verify.php?reference=' . $uuid . '&redirectUrl=' . urlencode($redirectUrl) . '&cnum=' . $cnum,
    'merchantAccount' => 'AdacaAccountECOM',
  ];

  savePaymentRecord($uuid, $name, $type, $amount, $cnum);

  return $service->payments($params);
}

