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
                                                {{ $subscriber->pivot->starts_at }}
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
                            <span class="text-job"> hour ago</span>
                            <span class="bullet"></span>


                        </div>
                        <p>Moved the task "<a href="#">Fix some features that are bugs in the master module</a>"
                            from Progress to Finish.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- {{ $subscriptions->links() }} --}}
</div>
