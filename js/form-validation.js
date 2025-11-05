// フォームバリデーション
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const messageInput = document.getElementById('message');
    const submitButton = form.querySelector('button[type="submit"]');

    // エラーメッセージをクリアする関数
    function clearError(fieldId) {
        const errorElement = document.getElementById(fieldId + 'Error');
        if (errorElement) {
            errorElement.textContent = '';
        }
        const inputElement = document.getElementById(fieldId);
        if (inputElement) {
            inputElement.classList.remove('error');
        }
    }

    // エラーメッセージを表示する関数
    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + 'Error');
        const inputElement = document.getElementById(fieldId);
        if (errorElement) {
            errorElement.textContent = message;
        }
        if (inputElement) {
            inputElement.classList.add('error');
        }
    }

    // お名前のバリデーション
    function validateName() {
        const name = nameInput.value.trim();
        if (name === '') {
            showError('name', 'お名前を入力してください');
            return false;
        }
        if (name.length > 50) {
            showError('name', 'お名前は50文字以内で入力してください');
            return false;
        }
        clearError('name');
        return true;
    }

    // メールアドレスのバリデーション
    function validateEmail() {
        const email = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email === '') {
            showError('email', 'メールアドレスを入力してください');
            return false;
        }
        if (!emailPattern.test(email)) {
            showError('email', '正しいメールアドレスを入力してください');
            return false;
        }
        if (email.length > 100) {
            showError('email', 'メールアドレスは100文字以内で入力してください');
            return false;
        }
        clearError('email');
        return true;
    }

    // 件名のバリデーション
    function validateSubject() {
        const subject = subjectInput.value.trim();
        if (subject === '') {
            showError('subject', '件名を入力してください');
            return false;
        }
        if (subject.length > 100) {
            showError('subject', '件名は100文字以内で入力してください');
            return false;
        }
        clearError('subject');
        return true;
    }

    // お問い合わせ内容のバリデーション
    function validateMessage() {
        const message = messageInput.value.trim();
        if (message === '') {
            showError('message', 'お問い合わせ内容を入力してください');
            return false;
        }
        if (message.length < 10) {
            showError('message', 'お問い合わせ内容は10文字以上で入力してください');
            return false;
        }
        if (message.length > 1000) {
            showError('message', 'お問い合わせ内容は1000文字以内で入力してください');
            return false;
        }
        clearError('message');
        return true;
    }

    // すべてのバリデーションを実行
    function validateAll() {
        const nameValid = validateName();
        const emailValid = validateEmail();
        const subjectValid = validateSubject();
        const messageValid = validateMessage();
        
        return nameValid && emailValid && subjectValid && messageValid;
    }

    // リアルタイムバリデーション（入力中にチェック）
    if (nameInput) {
        nameInput.addEventListener('blur', validateName);
        nameInput.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateName();
            }
        });
    }

    if (emailInput) {
        emailInput.addEventListener('blur', validateEmail);
        emailInput.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateEmail();
            }
        });
    }

    if (subjectInput) {
        subjectInput.addEventListener('blur', validateSubject);
        subjectInput.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateSubject();
            }
        });
    }

    if (messageInput) {
        messageInput.addEventListener('blur', validateMessage);
        messageInput.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateMessage();
            }
        });
    }

    // フォーム送信時のバリデーション
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // 一旦送信を止める
            
            // すべてのバリデーションを実行
            if (validateAll()) {
                // バリデーション成功時は送信を許可
                // 実際の送信処理は後でPHPなどで実装するため、ここではそのまま送信
                // サーバー側の実装がない場合は、alertで確認
                if (confirm('この内容で送信しますか？')) {
                    form.submit();
                }
            } else {
                // バリデーション失敗時は最初のエラーにフォーカス
                const firstError = form.querySelector('.error');
                if (firstError) {
                    firstError.focus();
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }
});

