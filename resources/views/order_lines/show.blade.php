<h2 class="font-bold text-xl">Products in this Order</h2>
<ul>
  @foreach ($order->orderLines as $line)
    <li>
      {{ $line->product->designation }} — Quantity: {{ $line->quantity }}
    </li>
  @endforeach
</ul>
