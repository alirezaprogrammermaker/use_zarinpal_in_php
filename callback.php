<?php

define("MerchantID", '');

$Amount     = $_GET['Amount'];
$Authority  = $_GET['Authority'];
$status     = $_GET['Status'];
$id         = $_GET['id'];

if ($status != 'OK') {
    $result  =  " پراخت لغو شد";
} else {

    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
    $result = $client->PaymentVerification(
        [
            'MerchantID'  => MerchantID,
            'Authority'   => $Authority,
            'Amount'      => $Amount
        ]
    );

    if ($result->Status == 100) {
        $result = "پرداخت موفقیت آمیز";

        
    } else {
        $result = "پرداخت شما لغو شده";


    }
}
echo $result . "\n";
echo "id : " . $id;