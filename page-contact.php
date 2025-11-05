<?php
/**
 * Template Name: Contact
 * Contact ページテンプレート
 */

get_header();

// メール送信処理
$result = anju_portfolio_contact_form_handler();
$errors = isset($result['errors']) ? $result['errors'] : array();
$error_message = isset($result['error']) ? $result['error'] : '';
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Contact</h1>
            <p class="page-header__subtitle">お問い合わせ</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-form-wrapper">
                <?php if ($error_message) : ?>
                    <div class="form-error-message" style="background-color: #fee; color: #c33; padding: 1rem; margin-bottom: 1rem; border-radius: 4px;">
                        <?php echo esc_html($error_message); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)) : ?>
                    <div class="form-error-message" style="background-color: #fee; color: #c33; padding: 1rem; margin-bottom: 1rem; border-radius: 4px;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo esc_html($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo esc_url(get_permalink()); ?>" method="post" class="contact-form" id="contactForm">
                    <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>
                    
                    <div class="form-group">
                        <label for="name" class="form-label">お名前 <span class="required">必須</span></label>
                        <input type="text" id="name" name="name" class="form-input" value="<?php echo isset($_POST['name']) ? esc_attr($_POST['name']) : ''; ?>" required>
                        <span class="form-error" id="nameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">メールアドレス <span class="required">必須</span></label>
                        <input type="email" id="email" name="email" class="form-input" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>" required>
                        <span class="form-error" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">件名 <span class="required">必須</span></label>
                        <input type="text" id="subject" name="subject" class="form-input" value="<?php echo isset($_POST['subject']) ? esc_attr($_POST['subject']) : ''; ?>" required>
                        <span class="form-error" id="subjectError"></span>
                    </div>

                    <div class="form-group">
                        <label for="message" class="form-label">お問い合わせ内容 <span class="required">必須</span></label>
                        <textarea id="message" name="message" rows="6" class="form-textarea" required><?php echo isset($_POST['message']) ? esc_textarea($_POST['message']) : ''; ?></textarea>
                        <span class="form-error" id="messageError"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="contact_submit" class="btn btn--primary">送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

