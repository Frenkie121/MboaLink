<div>



    <div class="row">
        <div class="col-12">
            <div class="activities">
                @foreach ($user->subscriptions as $subscription)
                    <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <div class="activity-detail">
                            <div class="mb-2">
                                <span class="text-job text-primary">
                                    @foreach ($subscription->users()->with(['role', 'subscriptions'])->get() as $subscriber)
                                        @if ($user->id === $subscriber->id)
                                            @if ($subscriber->pivot->starts_at)
                                                {{ formatedLocaleDate($subscriber->pivot->starts_at) }}
                                            @else
                                                @lang('No')
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                                <span class="bullet"></span>
                            </div>
                            <p> {{ $subscription->name }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-arrows-alt"></i>
                    </div>
                    <div class="activity-detail">
                        <div class="mb-2">
                            <span class="text-job"> ----</span>
                            <span class="bullet"> </span>
                        </div>
                        <p>@lang("All of the above represent subscriptions to which this subscriber has subscribed")</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- {{ $subscriptions->links() }} --}}
</div>
