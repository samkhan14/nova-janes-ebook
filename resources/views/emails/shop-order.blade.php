<x-mail::message>
# {{ $forCustomer ? ($order->status === 'paid' ? 'Payment confirmed' : 'Thank you for your order') : ($order->status === 'paid' ? 'New paid print order' : 'New print book order') }}

**Order:** {{ $order->order_number }}  
@if ($order->invoice)
**Invoice:** {{ $order->invoice->invoice_number }}  
@endif
**Status:** {{ str_replace('_', ' ', $order->status) }}  
**Customer:** {{ $order->customer_name }} ({{ $order->customer_email }})  
@if ($order->customer_phone)
**Phone:** {{ $order->customer_phone }}  
@endif

## Ship to
{{ $order->shipping_address_line1 }}  
@if ($order->shipping_address_line2)
{{ $order->shipping_address_line2 }}  
@endif
{{ $order->shipping_city }}@if($order->shipping_state), {{ $order->shipping_state }}@endif {{ $order->shipping_postal_code }}  
{{ $order->shipping_country }}

## Items
@foreach ($order->items as $item)
- {{ $item->product_title }} — {{ $item->variant_label }} × {{ $item->quantity }} = {{ $currencySymbol }}{{ number_format((float) $item->line_total, 2) }}
@endforeach

**Subtotal:** {{ $currencySymbol }}{{ number_format((float) $order->subtotal, 2) }}  
**Shipping:** {{ $currencySymbol }}{{ number_format((float) $order->shipping_fee, 2) }}  
**Total:** {{ $currencySymbol }}{{ number_format((float) $order->total, 2) }} {{ $order->currency }}

@if ($order->notes)
**Notes:** {{ $order->notes }}
@endif

@if ($order->status === 'paid')
Payment received via PayPal. We will prepare your shipment soon.
@else
{{ $paymentNote }}
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
