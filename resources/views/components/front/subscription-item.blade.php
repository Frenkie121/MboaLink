@props(['subscription'])

<div class="col mt-5 wow fadeInUp" data-wow-delay="0.{{ array_rand([1, 3, 5, 7]) }}s">
    <div class="card mb-4 rounded-3 shadow-sm border-{{ $subscription->id === 1 ? 'primary' : 'secondary' }} h-100">
        <div class="card-header py-3 bg-{{ $subscription->id === 1 ? 'primary' : 'secondary' }} border-{{ $subscription->id === 1 ? 'primary' : 'secondary' }}">
            <h4 class="my-0 fw-normal">{{ $subscription->name }}</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <small>XAF </small>
                <h3 class="card-title pricing-card-title">{{ formatMoney($subscription->amount) }}<small class="text-muted fw-light">/mo</small></h3>
            </div>
            <ul class="mt-3 mb-4">
                @foreach ($subscription->offers as $offer)
                    <li class="fs-6 mb-1" style="text-align: justify;"><small>{{ $offer->content }}</small></li>
                @endforeach
            </ul>
            <div class="position-absolute top-100 start-50 translate-middle mb-2 w-75">
                <a href="{{ route('front.subscriptions.subscribe', $subscription->slug) }}" type="button" class="w-100 btn btn-lg btn-{{ $subscription->id === 1 ? 'primary' : 'secondary' }}">@lang('Subscribe Now')</a>
            </div>
        </div>
    </div>
</div>