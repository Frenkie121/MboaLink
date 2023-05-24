@extends('layouts.front')

@section('subtitle', __('Jobs') . ' | ' . $job->title)

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="$job->title"
        :middleLink="true"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"
    />
    <!-- Header End -->

    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                @if (url()->previous() === url('me/my-jobs'))
                    <a class="fw-bolder" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i>  @lang('Back to my dashboard')</a>
                @endif
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ $job->company->logo }}" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3">{{ $job->title }}</h3>
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->type }}</span>
                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{ $job->salary }} XAF</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">@lang('Job description')</h4>
                        <p>{{ $job->description }}</p>
                        <h4 class="mb-3">@lang('Responsabilities')</h4>
                        <ul class="list-unstyled">
                            @foreach ($job->requirements as $requirement)
                                <li><i class="fa fa-angle-right text-primary me-2"></i>{{ $requirement->content }}</li>
                            @endforeach
                        </ul>
                        <h4 class="mb-3">@lang('Qualifications')</h4>
                        <ul class="list-unstyled">
                            @foreach ($job->qualifications as $qualification)
                                <li><i class="fa fa-angle-right text-primary me-2"></i>{{ $qualification->content }}</li>
                            @endforeach
                        </ul>
                    </div>
    
                    <div class="" id="apply">
                        <h4 class="mb-4">@lang('Apply For The Job')</h4>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" placeholder="Portfolio Website">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="file" class="form-control bg-white">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" rows="5" placeholder="Coverletter"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">@lang('Apply Now')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
                <div class="col-lg-4">
                    <a href="#apply" class="btn btn-primary w-100 mb-2" type="submit">@lang('Apply Now')</a href="#apply">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">@lang('Other informations')</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>@lang('Published On'): {{ $job->published_at }}</p>
                        <p class=""><i class="fa fa-angle-right text-primary me-2"></i>@lang('Date Line'): {{ $job->dateline }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>@lang('Job Type'): {{ $job->type }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>@lang('Salary'): {{ $job->salary }} XAF</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>@lang('Location'): {{ $job->location }}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>@lang('Category'): {{ $job->subCategory->name }} (<a href="{{ route('front.category.jobs', $job->subCategory->category->slug) }}">{{ $job->subCategory->category->name}}</a>)</p>
                        <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Tags:
                            {{ implode(', ', $job->tags()->pluck('name')->toArray()) }}
                        </p>
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">@lang('Company Details')</h4>
                        <p><i class="fa fa-user text-primary me-2"></i> {{ $job->company->user->name }}</p>
                        <p><i class="fa fa-envelope text-primary me-2"></i> {{ $job->company->user->email }}</p>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i> {{ $job->company->location }}</p>
                        <p><i class="fa fa-at text-primary me-2"></i> {{ $job->company->url }}</p>
                        <p class="m-0">{{ $job->company->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->


@endsection