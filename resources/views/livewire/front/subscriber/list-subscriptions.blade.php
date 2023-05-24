<div>
    <h3 class="text-center fw-bolder">@lang('My subscriptions list')</h3>
    <p class="mb-4 text-center fw-bold">
        @lang('Your subscriptions are listed in the table below.')
    </p>

    <div class="d-flex justify-content-end mb-2">
        <button class="btn btn-primary">@lang('Renew my subscription')</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th scope="col">#</th>
                    <th scope="col">@lang('Title')</th>
                    <th scope="col">@lang('Amount')</th>
                    <th scope="col">@lang('Submission date')</th>
                    <th scope="col">@lang('Start date')</th>
                    <th scope="col">@lang('End date')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr >
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-bold">{{ $subscription->name }}</td>
                        <td>{{ formatMoney($subscription->pivot->amount) }}</td>
                        <td>{{ formatedLocaleDate($subscription->pivot->created_at) }}</td>
                        <td>{{ formatedLocaleDate($subscription->pivot->starts_at) }}</td>
                        <td>{{ formatedLocaleDate($subscription->pivot->ends_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $subscriptions->links('vendor.livewire.bootstrap') }}
</div>
