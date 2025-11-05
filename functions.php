<?php
/**
 * Anju Portfolio Theme Functions
 */

// テーマのセットアップ
function anju_portfolio_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');
    
    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');
    
    // HTML5のサポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'anju_portfolio_setup');

// スタイルとスクリプトの読み込み
function anju_portfolio_scripts() {
    // スタイルシート（WordPressのテーマスタイルシート）
    wp_enqueue_style('anju-portfolio-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;500;600;700&display=swap', array(), null);
    
    // JavaScript
    wp_enqueue_script('anju-portfolio-main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    wp_enqueue_script('anju-portfolio-form-validation', get_template_directory_uri() . '/js/form-validation.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'anju_portfolio_scripts');

// お問い合わせフォームのメール送信処理
function anju_portfolio_contact_form_handler() {
    if (isset($_POST['contact_submit']) && wp_verify_nonce($_POST['contact_nonce'], 'contact_form')) {
        // データのサニタイズ
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // バリデーション
        $errors = array();
        
        if (empty($name)) {
            $errors[] = 'お名前を入力してください';
        }
        if (empty($email) || !is_email($email)) {
            $errors[] = '正しいメールアドレスを入力してください';
        }
        if (empty($subject)) {
            $errors[] = '件名を入力してください';
        }
        if (empty($message)) {
            $errors[] = 'お問い合わせ内容を入力してください';
        }
        
        // エラーがなければメール送信
        if (empty($errors)) {
            // 管理者へのメール
            $to = get_option('admin_email');
            $mail_subject = '[お問い合わせ] ' . $subject;
            $mail_message = "お名前: {$name}\n";
            $mail_message .= "メールアドレス: {$email}\n\n";
            $mail_message .= "お問い合わせ内容:\n{$message}";
            $headers = array(
                'From: ' . $name . ' <' . $email . '>',
                'Reply-To: ' . $email,
                'Content-Type: text/plain; charset=UTF-8'
            );
            
            $mail_sent = wp_mail($to, $mail_subject, $mail_message, $headers);
            
            if ($mail_sent) {
                // 送信成功時はリダイレクト
                wp_redirect(home_url('/contact-thanks/'));
                exit;
            } else {
                // 送信失敗時
                return array('error' => 'メールの送信に失敗しました。しばらく時間をおいて再度お試しください。');
            }
        } else {
            // バリデーションエラー
            return array('errors' => $errors);
        }
    }
    return null;
}

// お問い合わせフォームのnonceを取得
function anju_portfolio_contact_nonce() {
    return wp_create_nonce('contact_form');
}

