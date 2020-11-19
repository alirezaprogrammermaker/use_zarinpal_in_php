<?php

define("MerchantID", '');
$id = '1111';
?>

<a href="<?= zarinpal(10000, ['id' => $id])?>" > لینک پرداخت </a>


<?php

function zarinpal($Amount, $parameter = [])
{
    $Description = "شارژ حساب کاربری";
    $Email = ""; // Optional
    $Mobile = ""; // Optional

    $CallbackURL = "https://YourWebsite.com" . "/test/callback.php" . "?" . http_build_query($parameter);

    $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

    $result = $client->PaymentRequest(
        [
            'MerchantID'  => MerchantID,
            'Amount'      => $Amount,
            'Description' => $Description,
            'Email'       => $Email,
            'Mobile'      => $Mobile,
            'CallbackURL' => $CallbackURL,
        ]
    );

    if ($result->Status == 100) {
        $link = "https://www.zarinpal.com/pg/StartPay/" . $result->Authority . '/ZarinGate';
    } else {
        $link = false;
    }
    return $link;
}
?>

