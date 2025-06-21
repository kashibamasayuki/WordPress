<?php
// 記事更新通知メール
add_action('transition_post_status', function($new_status, $old_status, $post) {
    // 新規投稿時かつ、投稿タイプがpostの場合
    if ($new_status == 'publish' && $old_status != 'publish' && $post->post_type == 'post') {
        // 送信先のメールアドレス（複数の場合はカンマ区切り）
        $to = 'info@example.com';

        // 件名
        $subject = '新しい記事が公開されました';

        // 本文
        $message = $post->post_title . "\n";
        $message .= get_permalink($post->ID);

        // ヘッダー
        $headers = [];

        // 添付ファイル
        $attachments = [];

        wp_mail($to, $subject, $message, $headers, $attachments);
    }
}, 10, 3);