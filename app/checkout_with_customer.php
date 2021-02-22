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

// Email(顧客管理機能を利用する場合)
$email = trim($_POST['email']);

$customerParam = array(
  "description" => 'test user',
  "card" => $token
);

if (!empty($email)) {
  $customerParam['email'] = $_POST['email'];
}

//秘密鍵をセット
\Payjp\Payjp::setApiKey($_ENV['PAYJP_SECRET_KEY']);

try {
  // 新規登録
  \Payjp\Payjp::setApiKey($_ENV['PAYJP_SECRET_KEY']);
  $customer = \Payjp\Customer::create($customerParam);
} catch (Exception $e) {
  var_dump($e);
  exit;
}

try {
  // 顧客情報を使って支払い
  $charge = \Payjp\Charge::create(array(
    'amount' => $amount,
    'currency' => 'jpy',
    'customer' => $customer->id
  ));
} catch (Exception $e) {
  var_dump($e);
  exit;
}

echo $charge->amount . "yen payed!!";
