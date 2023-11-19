<style>
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
    }
    .table-billing-history th, .table-billing-history td {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.375rem;
        padding-right: 1.375rem;
    }
    .table > :not(caption) > * > *, .dataTable-table > :not(caption) > * > * {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

</style>

<div class="container-xl px-4 mt-4">
    <div class="card mb-4">
        <div class="card-body p-0">
            <div class="table-responsive table-billing-history">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="border-gray-200" scope="col">Transaction ID</th>
                            <th class="border-gray-200" scope="col">Date</th>
                            <th class="border-gray-200" scope="col">Amount</th>
                            <th class="border-gray-200" scope="col">Status</th>
                            <th class="border-gray-200" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $item)
                        {{ $item }}
                        <tr>
                            <td>#{{$item['order_code']}}</td>
{{--                            <td>{{$item->order_date}}</td>--}}
{{--                            <td>{{$item->getTotalFormatAttribute() }}</td>--}}
{{--                            <td><span class="badge bg-light text-dark">Pending</span></td>--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('client.order.detail', $item->order_code) }}" class="btn btn-sm btn-secondary">Detail</a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{ $order }}
