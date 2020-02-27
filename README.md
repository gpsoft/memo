# Memo

簡易メモのためのWebアプリ。メモ(タイトルと本文)のCRUDをサポートする。

# 開発準備

## ソース

```
$ git clone https://github.com/gpsoft/memo.git
```

## DB

MySQLを使用する。

```
CREATE DATABASE memo;
USE memo;

CREATE TABLE `notes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
    `content` text COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
```

## コンフィグ

`config.sample.php`を参考にして、`config.php`を作成する。

```php
<?php

// About DB
const DSN='mysql:dbname=memo;host=localhost;charset=utf8mb4';
const DBUSER='root';
const DBPASS='';

// About run mode
const DEBUG=true;
const LOGLEVEL=Monolog\Logger::INFO;
```

## Composer

必要な外部ライブラリをインストール。

```
$ composer install
```

## ログディレクトリを準備

```
$ mkdir -p log
$ chmod 777 log
```
