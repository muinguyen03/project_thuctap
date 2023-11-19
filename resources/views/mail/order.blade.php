<x-mail::message>
# Order Success !

Hello {{ $name }},

Thank you for your order, we would like to send you your order information

<x-mail::table>
| Infomation        | Detail                     |
| ----------------- | -------------------------- |
| Invoice           | {{ $info['order_code'] }}  |
| Date              | {{ $info['order_date'] }}  |
| Payment method    | {{ $info['payment'] }}     |
| Total             | {{ $info['total'] }}       |
</x-mail::table>

To view order details, please click the button below
<x-mail::button :url="$url">
View
</x-mail::button>

Thank,<br>
{{ config('app.name') }}
</x-mail::message>
