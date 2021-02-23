<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 作成されたトークン
$token = $_POST['payjp-token'];

$totalAmount = 0;

foreach ($_POST['product'] as $productId => $count) {
  $count = intval($count);

  // 0個はスキップ
  if ($count === 0) {
    continue;
  }

  // 商品情報を取得
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, sprintf('https://api.pay.jp/v1/products/%s', $productId));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERPWD, $_ENV['PAYJP_SECRET_KEY']);
  $buf = curl_exec($ch);
  $product = json_decode($buf);

  // 合計金額に購入単価*個数を加算
  $totalAmount += $product->amount * $count;
}

//秘密鍵をセット
\Payjp\Payjp::setApiKey($_ENV['PAYJP_SECRET_KEY']);

try {
  // 指定金額を支払い
  $charge = \Payjp\Charge::create(array(
    'card' => $token,
    'amount' => $totalAmount,
    'currency' => 'jpy'
  ));

} catch (Exception $e) {
  var_dump($e);
  exit;
}

echo $charge->amount . "yen payed!!";
