@component('mail::message')
# Поръчката ви е приета

Здравейте {{$username}},<br>
Вие току що направихте поръчка №{{$order->id}}.<br>
Ако желаете да видите подробности за нея, 
моля натиснете бутона "Преглед".

@component('mail::button', ['url' => route('order.show', $order->id)])
Преглед
@endcomponent

Очаквайте email за обработката на вашата поръчка.<br>

Поздрави,<br>
екипът на <b>[{{ config('app.name') }}](http://profitstore.bg)</b>

<br><br><small>Ако това съобщение не се отнася до Вас,
моля да го пренебрегнете.</small><br>
@endcomponent
