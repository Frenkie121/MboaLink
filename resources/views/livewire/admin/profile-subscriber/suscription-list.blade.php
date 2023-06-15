<div class="row">
    <div class="col-12">
        <div class="activities">
            @foreach ($subscriptions as $subscription)
                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-calendar fa-lg fa-beat"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold mr-3 pr-3 py-2 border-right"> {{ $subscription->name }}</span>
                            <span class="text-job text-primary">
                                <span class="mb-3">{{ formatedLocaleDate($subscription->pivot->created_at) }}</span>
                                <br>
                                <span>{{ $subscription->pivot->amount }} XAF</span>
                                <br>
                                <span class="bullet text-{{ $subscription->pivot->starts_at ? 'success' : 'danger' }} ml-0">
                                    @if ($subscription->pivot->starts_at)
                                        {{ formatedLocaleDate($subscription->pivot->starts_at) }}-{{ formatedLocaleDate($subscription->pivot->ends_at) }}
                                    @else
                                        @lang('Inactive')
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $subscriptions->links('vendor.livewire.bootstrap') }}
    </div>
</div>

