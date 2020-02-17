@component('mail::message')
# Поръчката ви е приета

Здравейте {{$order->customer->name}},<br>
Статуса на поръчка №{{$order->id}}/{{$order->created_at}} е променен на 
<b>{{$order->status()->latest()->first()->status}}</b>.<br>

@component('mail::table')
| # | Артикул | Единична цена | Количество | Цена |
| -- | :------------------------ | :--------:| -----:| --------:|
@foreach ($order->product as $product)
| {{++$loop->index}} | {{$product->name}} | {{$product->price}} | {{$product->pivot->quantity}} | {{$product->pivot->quantity*$product->price}} |
@endforeach
@endcomponent

@component('mail::button', ['url' => route('order.show', $order->id)])
Преглед
@endcomponent

Очаквайте email за обработката на вашата поръчка.<br>

Поздрави,<br>
екипът на <b>[{{ config('app.name') }}](http://profitstore.bg)</b>

<br><br><small>Ако това съобщение не се отнася до Вас,
моля да го пренебрегнете.</small><br>
@endcomponent
