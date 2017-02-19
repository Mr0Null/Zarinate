<?php


$MerchantID = ''; //Required
$Amount = $_POST['amount']; //Amount will be based on Toman - Required
$Description = 'کمک ' . $Amount . ' تومانی'; // Required
$Email = $_POST['useremail']; // Optional
$Mobile = ''; // Optional
$CallbackURL = 'https://vahedinia.me/verify.php?amount=' . $Amount . '&name=' . $_POST['username'] . '&email=' . $Email; // Required


$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
[
'MerchantID' => $MerchantID,
'Amount' => $Amount,
'Description' => $Description,
'Email' => $Email,
'CallbackURL' => $CallbackURL,
]
);

//Redirect to URL You can do it also by creating a form
if ($result->Status == 100) {
Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
//ﺏﺭﺍی ﺎﺴﺘﻓﺍﺪﻫ ﺍﺯ ﺯﺭیﻥ گیﺕ ﺏﺍیﺩ ﺍﺩﺮﺳ ﺐﻫ ﺹﻭﺮﺗ ﺯیﺭ ﺖﻏییﺭ کﻥﺩ:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
} else {
echo'ERR: '.$result->Status;
}
?>
