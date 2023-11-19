<x-mail::message>
# Đăng ký tài khoản thành công !

Xin chào,
Cảm ơn bạn đã đăng ký tài khoản, chúng tôi xin gửi thông tin đăng nhập của quý khách

<x-mail::panel>
    Tài khoản
</x-mail::panel>

<x-mail::table>
    |           |                             |
    |-----------|-----------------------------|
    |Email      |{{$email}}                   |
    |Mật khẩu   |{{$password}}                |
</x-mail::table>

Sau khi đăng nhập, quý khách vui lòng truy cập " Thông tin cá nhân > Đổi mật khẩu " để đổi mật khẩu mới.

Xin chân thành cảm ơn,<br>
{{ config('app.name') }}
</x-mail::message>
