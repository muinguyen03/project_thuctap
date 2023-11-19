function infomationCheckout(){
    document.addEventListener('DOMContentLoaded', function () {
        Validator({
            form: '#checkout-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#name', 'Vui lòng nhập họ tên'),
                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email'),
                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#phone', 'Số điện thoại không hợp lệ'),
                Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
            ],
        });
    });
}
infomationCheckout()
