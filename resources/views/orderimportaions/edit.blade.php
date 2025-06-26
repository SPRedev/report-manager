<x-app-layout>
  <x-slot name="header">✏️ Edit Order</x-slot>

  <form method="POST" action="{{ route('orders.update',$order) }}" class="mt-4 space-y-4">
    @csrf @method('PUT')

    <div>
      <x-input-label for="client_id" value="Client" />
      <select name="client_id" id="client_id" class="w-full border rounded px-2 py-1">
        @foreach($clients as $c)
          <option value="{{ $c->id }}" {{ $c->id === $order->client_id ? 'selected' : '' }}>
            {{ $c->client_name }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <x-input-label for="commercial_id" value="Commercial (optional)" />
      <select name="commercial_id" class="w-full border rounded px-2 py-1">
        <option value="">— none —</option>
        @foreach($commercials as $u)
          <option value="{{ $u->id }}" {{ $u->id === $order->commercial_id ? 'selected' : '' }}>
            {{ $u->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <x-input-label for="order_date" value="Order Date" />
      <x-text-input name="order_date" type="date" value="{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}" />
    </div>

    <div>
      <x-input-label for="status" value="Status" />
      <select name="status" class="w-full border rounded px-2 py-1">
        <option value="in_preparation" {{ $order->status==='in_preparation'?'selected':'' }}>In Preparation</option>
        <option value="ready"             {{ $order->status==='ready'?'selected':'' }}>Ready</option>
        <option value="delivered"         {{ $order->status==='delivered'?'selected':'' }}>Delivered</option>
      </select>
    </div>

    <x-primary-button>Update Order</x-primary-button>
  </form>
</x-app-layout>
