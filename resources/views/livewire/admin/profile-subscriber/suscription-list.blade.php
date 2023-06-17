<div class="row">
    <div class="col-12">
        <div class="activities">
            @foreach ($subscriptions as $subscription)
                @php
                    $starts_at = Carbon\Carbon::parse($subscription->pivot->starts_at);
                    $ends_at = Carbon\Carbon::parse($subscription->pivot->ends_at);
                @endphp
                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-calendar fa-lg fa-beat"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold mr-3 pr-3 py-2 border-right"> {{ $subscription->name }}</span>
                            <span class="text-job text-primary" style="min-width: 165px;">
                                <span class="mb-3">{{ formatedLocaleDate($subscription->pivot->created_at) }}</span>
                                <br>
                                <span>{{ $subscription->pivot->amount }} XAF</span>
                                <br>
                                @if ($subscription->pivot->starts_at)
                                    @if ($starts_at->isFuture())
                                        <span class="bullet text-warning ml-0">@lang('Upcoming') </span>
                                    @elseif ($ends_at->isPast())
                                        <span class="bullet text-danger ml-0">@lang('Ended') </span>
                                    @else
                                        <span class="bullet text-success ml-0">
                                            {{ formatedLocaleDate($subscription->pivot->starts_at) }}-{{ formatedLocaleDate($subscription->pivot->ends_at) }}
                                            <br>
                                            @lang('On going')
                                        </span>
                                    @endif
                                @else
                                    <span class="bullet text-info ml-0">@lang('Pending') </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $subscriptions->links('vendor.livewire.bootstrap') }}
    </div>
</div>

