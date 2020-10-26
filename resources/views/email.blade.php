@component('mail::message')
# Заказ званка

@component('mail::table')
| Телефон       | Email         | 
| ------------- |:-------------:|
| {{$phone}}    | {{$email}}    |
@endcomponent

@component('mail::panel')
@if (!empty($content))
    <h3>Сообщение</h3>  
    {!!$content!!}
    @endif
@endcomponent  

<p style="text-align: center">Спасибо, PlantsShop</p> 
@endcomponent
