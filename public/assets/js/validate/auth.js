function loginValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#form-1',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu'),
                Validator.isEmail('#email'),
                Validator.minLength('#password', 3),
            ]
        });
    });
}

function registerValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#register-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#name', 'Vui lòng nhập họ và tên'),
                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#password', 'Vui lòng nhập mật khẩu'),
                Validator.minLength('#password', 3),
                Validator.isRequired('#password_confirmation', 'Vui lòng nhập lại mật khẩu'),
                Validator.minLength('#password_confirmation', 3),
                Validator.isConfirmed('#password_confirmation', function () {
                    return document.querySelector('#register-form #password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ]
        });
    });
}

function forgotPasswordValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#forgot-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email'),
            ]
        });
    });
}

function resetPasswordValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#reset-password-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#new_password', 'Vui lòng nhập mật khẩu mới'),
                Validator.minLength('#new_password', 3),
                Validator.isRequired('#new_password_confirmation', 'Vui lòng nhập lại mật khẩu mới'),
                Validator.minLength('#new_password_confirmation', 3),
                Validator.isConfirmed('#new_password_confirmation', function () {
                    return document.querySelector('#reset-password-form #new_password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ]
        });
    });
}
