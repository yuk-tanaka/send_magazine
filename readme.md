# メールマガジン送信システム

## Overview
- CSVをアップロードしてメールマガジンを送信
- BASIC認証
- Laravel + Vue.js ログ保存にMySQLを使用（ほかのDBでも動くはず）

## Build
1. ```composer install```
1. ```php artisan key:generate```
1. ```php artisan storage:link```
1. .envを編集（最低限DB, Mail, Queue, BasicAuthの変更が必要）
1. ```php artisan migrate```
1. ```npm install```
1. ```npm run production```
1. 必要に応じてconfigを編集（追加分は `send_magazine.php` ）

## License
MIT