@component('mail::message')
# Dear Customer {{$customerName}},

The detail of the order information are as follow :

## Invoice No
{{$customerOrder->invoice_no}}

## Biller Address
{{$customerOrder->biller_address}}

## Delivery Address
{{$customerOrder->delivery_address}}

# Order Informations
@component('mail::table')
| No                | Item No          |Description       | Quantity      | Remark        |
| :-------------:   |:-------------:   |:-------------:   |:-------------:|:-------------:|
@foreach ($orderItems as $key => $order)
| {{$key+1}}        | {{$order['item_no']}} | {{$order['description']}} |  {{$order['quantity']}} | {{$order['remark']}} |
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
