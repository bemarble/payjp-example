# PAYJP charge example

PAY.JP のクレジット払い機能のサンプルコードです

## このドキュメントのサンプルコードでできること

- 支払い
- 顧客登録

## 初期設定

※ 事前にDockerのインストールが必要です

### ライブラリインストール

インストールコマンドを実行してください

```
$ composer install
```

### 環境ファイル設定

`app/.env.default` をコピーして、`app/.env` ファイルを作成してください

 `app/.env` の中にPAY.JPサイトの公開鍵と秘密鍵を設定してください

## 起動

下記コマンドで起動します

```
$ docker-compose up
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
├── Dockerfile # Docker設定ファイル
├── README.md # 本ファイル
├── app
│   ├── checkout.php # 支払い処理
│   ├── composer # composer本体
│   ├── composer.json # composer設定ファイル
│   ├── index.php　# サンプルページ
│   └── vendor # 関連ライブラリ
├── docker-compose.yml # Docker設定ファイル
└── nginx
    └── site.conf # nginx設定ファイル
```
