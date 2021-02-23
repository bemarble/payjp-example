<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$productList = getProductList();

function getProductList() {
  // PAY.JPに登録した商品リストを取得
  $products = getProducts();

  // 表示させたい商品
  $product_ids = json_decode($_ENV['PRODUCT_IDS']);

  $list = [];
  // 表示用に商品リスト整形
  foreach ($product_ids as $product_id) {
    foreach ($products as $product) {
      if ($product->id === $product_id) {
        $list[] = $product;
      }
    }
  }
  return $list;
}

function getProducts() {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.pay.jp/v1/products');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_USERPWD, $_ENV['PAYJP_SECRET_KEY']);
  $buf = curl_exec($ch);
  return json_decode($buf)->data;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Payjp Cart Example</title>
</head>
<body>
  <div class="container-fluid">
    <div class="main-form">
      <form action="/checkout_product.php" method="post">

        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">商品名</th>
              <th scope="col">単価</th>
              <th scope="col">個数</th>
            </tr>
          </thead>
          <tbody>
<?php
foreach ($productList as $product) {
?>
            <tr>
              <td><?php echo htmlspecialchars($product->metadata->display_name); ?></td>
              <td><?php echo htmlspecialchars($product->amount); ?></td>
              <td>
                <select class="form-control" name="<?php echo sprintf('product[%s]', $product->id); ?>">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </td>
            </tr>
<?php
}
?>
          </tbody>
        </table>
        <script src="https://checkout.pay.jp/"
          class="payjp-button"
          data-key="<?php echo $_ENV['PAYJP_PUBLIC_KEY'];?>"
          data-payjp="<?php echo $_ENV['PAYJP_OAUTH_CLIENT_ID'];?>">
        </script>
      </form>
    </div>
  </div>
</body>
</html>
