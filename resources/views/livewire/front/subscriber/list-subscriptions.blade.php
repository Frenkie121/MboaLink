@php
    $status = $days_left < 1 ? 'danger' : 'primary';
    $can_renew = $current_subscription->isSameAs($last_subscription) && $days_left <= 7;
@endphp

<div>
    <div>
        <h3 class="text-center fw-bolder">@lang('My subscriptions list')</h3>
        <p class="mb-4 text-center fw-bold">
            @lang('Your subscriptions are listed in the table below.')
        </p>
    
        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-{{ $status }}" data-bs-toggle="modal" data-bs-target="#renewSubscriptionModal">@lang('Renew my subscription')</button>
        </div>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-warning">
                        <th scope="col">#</th>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col">@lang('Cost')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Start date')</th>
                        <th scope="col">@lang('End date')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                    @php
                        $starts_at = Carbon\Carbon::parse($subscription->pivot->starts_at);
                        $ends_at = Carbon\Carbon::parse($subscription->pivot->ends_at);
                    @endphp
                        <tr class="table-{{ $subscription->isSameAs($current_subscription) ? 'secondary' : '' }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="fw-bold">{{ $subscription->name }}</td>
                            <td>{{ formatMoney($subscription->pivot->amount) }}</td>
                            <td>
                                @if ($subscription->pivot->starts_at)
                                    <span class="badge bg-secondary">@lang('Validated')</span>
                                    @if ($starts_at->isFuture())
                                        <span class="badge bg-warning">@lang('Upcoming')</span>
                                    @elseif ($ends_at->isPast())
                                        <span class="badge bg-danger">@lang('Ended')</span>
                                    @else
                                        <span class="badge bg-success">@lang('On going')</span>
                                    @endif
                                @else
                                    <span class="badge bg-info">@lang('Pending')</span>
                                @endif    
                            </td>
                            <td @if(! $subscription->pivot->starts_at) class="table-dark" @endif>{{ formatedLocaleDate($subscription->pivot->starts_at) }}</td>
                            <td @if(! $subscription->pivot->ends_at) class="table-dark" @endif>{{ formatedLocaleDate($subscription->pivot->ends_at) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $subscriptions->links('vendor.livewire.bootstrap') }}
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="renewSubscriptionModal" tabindex="-1" aria-labelledby="renewSubscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renewSubscriptionModalLabel">@lang('Renew my subscription')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($days_left < 0.1)
                        <p class="text-danger fw-bolder mb-1">@lang('Dear subscriber, your subscription period is over.')
                    @else
                        <p class="mb-1">@lang('Dear subscriber, you have') <strong class="text-{{ $status }}">{{ intval($days_left) . ' ' . __(Str::plural('day', intval($days_left))) }}</strong> @lang('left on your current subscription.')</p>
                    @endif
                    <p class="mb-0">
                        @if ($can_renew)
                            @lang('You can request a renewal by clicking on the button below.')
                            <p class="fw-bold fs-6 mb-0 mt-2">(@lang('It will cost you') {{ $next_subscription['amount'] }} XAF @lang('and go from') {{ $next_subscription['starts_at'] }} @lang('to ') {{ $next_subscription['ends_at'] }}.)</p>
                        @elseif (! $current_subscription->isSameAs($last_subscription) && ! $last_subscription->starts_at)
                            <span class="fw-bold">@lang('Your last subscription request is awaiting validation.')</span>
                        @else
                            @lang('You can renew your subscription one week before the end of the current one.')
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    @if ($can_renew)
                        <button wire:loading.remove wire:click="sendRequest" type="button" class="btn btn-{{ $status }}">@lang('Send renewal request')</button>
                        <button wire:loading class="btn btn-{{ $status }}" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            @lang('Loading')...
                        </button>
                    @else
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('Close')</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>