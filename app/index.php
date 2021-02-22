<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Payjp Example</title>
</head>
<body>
  <div class="container-fluid">
    <div class="main-form">
      <form action="/checkout_with_customer.php" method="post">
        <div class="form-group">
          <label>Email</label>
          <input class="form-control form-control-lg" type="text" placeholder="your email" name="email">
          <small class="form-text text-muted">顧客として登録する場合使う</small>
        </div>

        <div class="form-group">
          <label>支払い金額</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="amount" value="1000"><label class="form-check-label">1,000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="amount" value="2000" checked="checked"><label class="form-check-label">2,000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="amount" value="3000"><label class="form-check-label">3,000</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="amount" value="10000"><label class="form-check-label">10,000</label>
          </div>
        </div>
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
