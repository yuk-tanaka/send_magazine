<?php
/**
 * メールドライバー設定：mail.php/.env
 * キューイング設定：queue.php/.env
 * データベース設定：database.php/.env
 * 認証設定：very_basic_auth/.env
 */
return [
    /**
     * CSV取込設定
     */
    //送信可否判定を行うカラム番号 全送信する場合はnull
    'is_send_column_number' => 0,
    //送信可否判定を行う際に、送信OKとみなすカラム文字列
    'is_send_validate_string' => 'true',
    //送信者名カラム番号
    'name_column_number' => 2,
    //メールアドレスカラム番号
    'email_column_number' => 1,

    /**
     * 送信フォーム設定
     */
    //wysiwygエディタの画像保存先パス /storage 前提のため外部ストレージを使用する場合は要プログラム変更
    'wysiwyg_image_storage_path' => 'wysiwyg',
    //フッター初期値 ヒアドキュメント
    'default_footer' => <<<HTML
<p>フッター初期値</p>
<strong>タグ使用可能</strong>
HTML
    ,

];