function changeInfomationValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#change-information-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#inputName', 'Vui lòng nhập họ tên'),
                Validator.isRequired('#inputEmail', 'Vui lòng nhập email'),
                Validator.isEmail('#inputEmail'),
                Validator.isRequired('#inputPhone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#inputPhone', 'Số điện thoại không hợp lệ'),
            ]
        });
    });
}
function changePasswordValidate(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#change-password-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#current-password', 'Vui lòng nhập mật khẩu cũ'),
                Validator.minLength('#current-password', 3),
                Validator.isRequired('#new-password', 'Vui lòng nhập mật khẩu mới'),
                Validator.minLength('#new-password', 3),
                Validator.isRequired('#confirm-password', 'Vui lòng nhập lại mật khẩu mới'),
                Validator.isConfirmed('#confirm-password', function () {
                    return document.querySelector('#change-password-form #new-password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ]
        });
    });
}
