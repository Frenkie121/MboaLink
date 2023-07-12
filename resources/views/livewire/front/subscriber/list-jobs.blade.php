@php
    $company = auth()->user()->role_id === 2;
@endphp

<div>
    <h3 class="text-center fw-bolder">
        @if ($company)
            @lang('Jobs list')
        @else
            @lang('My Applications')
        @endif
    </h3>
    <p class="mb-4 text-center fw-bold">
        @if ($company)
            @lang('Your created jobs are listed in the table below.')
        @else
            @lang('The jobs you have applied for are listed in the table below.')
        @endif
    </p>
    
    @if(is_null($jobs))
        <p class="text-center text-primary fw-bold">
            @if ($company)
                @lang('You have not submitted a job yet.')
            @else
                @lang('You have not applied for a job yet.')
            @endif
        </p>
    @else

    @if ($company)
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('front.jobs.create') }}" class="btn btn-primary">@lang('Post a job')</a>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th scope="col">#</th>
                    <th scope="col">@lang('Title')</th>
                    <th scope="col">@lang('Category')</th>
                    <th scope="col">@lang('Type')</th>
                    @if ($company)
                        <th scope="col">@lang('Submitted at')</th>
                        <th scope="col">@lang('Published at')</th>
                    @else
                        <th scope="col">@lang('Salary')</th>
                        <th scope="col">@lang('Applied on')</th>
                    @endif
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    @php
                        $hasTalent = $company ? $job->talents->isNotEmpty() : null;
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-bold" title="{{ $job->title }}">{{ $job->reduce_title }}</td>
                        <td title="{{ $job->subCategory->category->name }}">{{ $job->subCategory->category->short_name }}</td>
                        <td>{{ $job->type }}</td>
                        @if ($company)
                            <td>{{ $job->created_at }}</td>
                            <td>
                                @if ($job->published_at)
                                    {{ $job->published_at }}
                                @else
                                    <span class="badge bg-info">@lang('Pending')</span>
                                @endif
                            </td>
                        @else
                            <td>{{ $job->salary }} XAF</td>
                            <td>{{ formatedLocaleDate($job->pivot->created_at) }}</td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('front.jobs.show', $job->slug) }}" class="btn btn-secondary" title="@lang('Job Details')"><i class="fas fa-eye"></i></a>
                            @if ($company)
                                <a 
                                    href="@if($hasTalent){{ route('front.subscriber.job.applications', $job->slug) }} @else # @endif"
                                    class="btn btn-{{ $hasTalent ? 'primary' : 'dark' }}"
                                    title="@if($hasTalent)@lang('Applicants list')@else @lang('No applicant yet')@endif">
                                    <i class="fas fa-users"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $jobs->links('vendor.livewire.bootstrap') }}
    @endif
</div>
