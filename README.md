# Memo

簡易メモのためのWebアプリ。メモ(タイトルと内容)のCRUDをサポートする。

# 開発準備

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

## Composer

```
$ composer install
```

## ログディレクトリを準備

```
$ mkdir -p log
$ chmod 777 log
```
