<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// @see Document https://github.com/payjp/payjp-php
// @see Testcard https://pay.jp/docs/testcard

// 作成されたトークン
$token = $_POST['payjp-token'];

// 値段を受け取る
$amount = intval($_POST['amount']);

//秘密鍵をセット
\Payjp\Payjp::setApiKey($_ENV['PAYJP_SECRET_KEY']);

try {
  $charge = \Payjp\Charge::create(array(
    'card' => $token,
    'amount' => $amount,
    'currency' => 'jpy'
  ));

} catch (Exception $e) {
  var_dump($e);
  exit;
}

echo $charge->amount . "yen payed!!";
