# PAYJP charge example

PAY.JP のクレジット払い機能のサンプルコードです

## このドキュメントのサンプルコードでできること

- 支払い
- 顧客登録


## サンプルの説明

* simple_charge.php
  * 支払い機能を試すサンプルです
* customer_charge.php
  * 支払い機能と顧客機能を試すサンプルです
* product_charge.php
  * PAY.JPに登録した商品の金額を支払うサンプルです
  * 利用にはあらかじめプロダクトを登録しておいてください
  * 登録後、表示させたいプロダクトのIDを `.env` ファイルに記述してください


### ライブラリインストール

初回実行時にインストールコマンドを実行してください

```
$ cd app
$ composer install
```

### 環境ファイル設定

`app/.env.default` をコピーして、`app/.env` ファイルを作成してください

`app/.env` の中にPAY.JPサイトの公開鍵と秘密鍵を設定してください

## 起動

### Dockerを使う場合

下記コマンドで起動します

```
$ docker-compose up
```

### Dockerを使わない場合

phpが動く環境を準備した上で、下記コマンドで起動します

```
$ php -S 0.0.0.0:8080 -t app/
```

## サンプル表示

下記のURLにアクセスしてください

http://localhost:8080/


## その他

管理画面
https://pay.jp/d/

公式リファレンス
https://pay.jp/docs/api/

## プロジェクトの中身

```
.
├── Dockerfile # Docker設定ファイル
├── README.md # 本ファイル
├── app # 各サンプルコード
│   ├── checkout.php
│   ├── checkout_product.php
│   ├── checkout_with_customer.php
│   ├── composer
│   ├── composer.json
│   ├── composer.lock
│   ├── customer_charge.php
│   ├── index.php
│   ├── product_charge.php
│   ├── simple_charge.php
│   └── vendor
├── docker-compose.yml # Docker設定ファイル
└── nginx
    └── site.conf # nginx設定ファイル
```
