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

// 管理画面設定: お問い合わせフォーム送信先メールアドレス
function anju_portfolio_register_contact_settings() {
    register_setting(
        'anju_contact_options',
        'anju_contact_email',
        array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_email',
            'default'           => get_option('admin_email'),
        )
    );

    add_settings_section(
        'anju_contact_section',
        'コンタクトフォーム設定',
        'anju_portfolio_contact_section_description',
        'anju-contact-settings'
    );

    add_settings_field(
        'anju_contact_email_field',
        '送信先メールアドレス',
        'anju_portfolio_contact_email_field',
        'anju-contact-settings',
        'anju_contact_section'
    );
}
add_action('admin_init', 'anju_portfolio_register_contact_settings');

function anju_portfolio_contact_section_description() {
    echo '<p>お問い合わせフォームからの通知を受け取るメールアドレスを設定できます。</p>';
}

function anju_portfolio_contact_email_field() {
    $value = get_option('anju_contact_email', get_option('admin_email'));
    echo '<input type="email" name="anju_contact_email" value="' . esc_attr($value) . '" class="regular-text" placeholder="example@domain.com" />';
}

function anju_portfolio_add_contact_options_page() {
    add_options_page(
        'コンタクトフォーム設定',
        'コンタクトフォーム',
        'manage_options',
        'anju-contact-settings',
        'anju_portfolio_contact_settings_page'
    );
}
add_action('admin_menu', 'anju_portfolio_add_contact_options_page');

function anju_portfolio_contact_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1>コンタクトフォーム設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('anju_contact_options');
            do_settings_sections('anju-contact-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// お問い合わせフォームのメール送信処理（initアクションで実行）
function anju_portfolio_contact_form_handler() {
    // POSTリクエストでcontact_submitが送信された場合のみ処理
    if (!isset($_POST['contact_submit']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form')) {
        return;
    }
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
            // 管理者へのメール（管理画面で設定可能）
            $admin_email = get_option('anju_contact_email', get_option('admin_email'));
            $admin_subject = '[お問い合わせ] ' . $subject;
            $admin_message = "お名前: {$name}\n";
            $admin_message .= "メールアドレス: {$email}\n\n";
            $admin_message .= "お問い合わせ内容:\n{$message}";
            $admin_headers = array(
                'From: ' . $name . ' <' . $email . '>',
                'Reply-To: ' . $email,
                'Content-Type: text/plain; charset=UTF-8'
            );
            
            // 管理者へのメール送信
            $admin_mail_sent = wp_mail($admin_email, $admin_subject, $admin_message, $admin_headers);
            
            // 送信者への自動返信メール
            $auto_reply_subject = '【自動返信】お問い合わせありがとうございます';
            $auto_reply_message = "{$name} 様\n\n";
            $auto_reply_message .= "この度は、お問い合わせいただきありがとうございます。\n";
            $auto_reply_message .= "以下の内容でお問い合わせを受け付けました。\n\n";
            $auto_reply_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $auto_reply_message .= "【お問い合わせ内容】\n";
            $auto_reply_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            $auto_reply_message .= "件名: {$subject}\n\n";
            $auto_reply_message .= "お問い合わせ内容:\n{$message}\n\n";
            $auto_reply_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            $auto_reply_message .= "内容を確認次第、ご連絡させていただきます。\n";
            $auto_reply_message .= "しばらくお待ちください。\n\n";
            $auto_reply_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $auto_reply_message .= "このメールは自動送信されています。\n";
            $auto_reply_message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            
            $auto_reply_headers = array(
                'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>',
                'Content-Type: text/plain; charset=UTF-8'
            );
            
            // 送信者への自動返信メール送信
            $auto_reply_sent = wp_mail($email, $auto_reply_subject, $auto_reply_message, $auto_reply_headers);
            
            // 管理者へのメールが送信できれば成功とする
            if ($admin_mail_sent) {
                // 送信成功時はcontact-thanksページにリダイレクト
                $thanks_page = get_page_by_path('contact-thanks');
                if ($thanks_page) {
                    wp_redirect(get_permalink($thanks_page));
                } else {
                    // contact-thanksページが存在しない場合は、home_urlを使用
                    wp_redirect(home_url('/contact-thanks/'));
                }
                exit;
            } else {
                // 送信失敗時はエラーメッセージをセッションに保存
                if (!session_id()) {
                    session_start();
                }
                $_SESSION['contact_error'] = 'メールの送信に失敗しました。しばらく時間をおいて再度お試しください。';
                wp_redirect(wp_get_referer() ? wp_get_referer() : home_url('/contact/'));
                exit;
            }
        } else {
            // バリデーションエラーはセッションに保存
            if (!session_id()) {
                session_start();
            }
            $_SESSION['contact_errors'] = $errors;
            $_SESSION['contact_form_data'] = array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            );
            wp_redirect(wp_get_referer() ? wp_get_referer() : home_url('/contact/'));
            exit;
        }
}
add_action('init', 'anju_portfolio_contact_form_handler', 2);

// セッション開始（エラーメッセージとフォームデータの保持のため）
function anju_portfolio_start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'anju_portfolio_start_session', 1);

// お問い合わせフォームのnonceを取得
function anju_portfolio_contact_nonce() {
    return wp_create_nonce('contact_form');
}

