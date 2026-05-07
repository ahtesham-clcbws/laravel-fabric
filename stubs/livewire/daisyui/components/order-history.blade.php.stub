<div class="card bg-base-100 shadow-xl border border-base-200">
    <div class="card-body">
        <h2 class="card-title mb-6">{{ __('Order History') }}</h2>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>{{ __('Order ID') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-bold">#{{ $order['id'] }}</td>
                            <td>{{ $order['date'] }}</td>
                            <td>
                                <div class="badge {{ $order['status_color'] }} badge-sm">{{ $order['status'] }}</div>
                            </td>
                            <td>{{ $order['total'] }}</td>
                            <td>
                                <button class="btn btn-ghost btn-xs text-primary">{{ __('Details') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
