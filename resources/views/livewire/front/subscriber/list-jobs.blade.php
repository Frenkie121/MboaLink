<div>
    <h3 class="text-center fw-bolder">@lang('Jobs list')</h3>
    <p class="mb-4 text-center fw-bold">
        @if (auth()->user()->role_id === 2)
            @lang('Your created jobs are listed in the table below.')
        @else
            @lang('The jobs you have applied for are listed in the table below.')
        @endif
    </p>
    
    @empty($jobs)
        <p class="text-center text-info">
            @if (auth()->user()->role_id === 2)
                @lang('You have not submitted a job yet.')
            @else
                @lang('You have not applied for a job yet.')
            @endif
        </p>
    @else
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th scope="col">#</th>
                    <th scope="col">@lang('Title')</th>
                    <th scope="col">@lang('Category')</th>
                    <th scope="col">@lang('Type')</th>
                    <th scope="col">@lang('Submitted at')</th>
                    <th scope="col">@lang('Published at')</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-bold" title="{{ $job->title }}">{{ $job->reduce_title }}</td>
                        <td title="{{ $job->subCategory->category->name }}">{{ $job->subCategory->category->short_name }}</td>
                        <td>{{ $job->type }}</td>
                        <td>{{ $job->created_at }}</td>
                        <td>
                            @if ($job->published_at)
                                {{ $job->published_at }}
                            @else
                                <span class="badge bg-info">@lang('Pending')</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('front.jobs.show', $job->slug) }}" class="btn btn-secondary" title="@lang('Job Details')"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('front.jobs.show', $job->slug) }}" class="btn btn-primary" title="@lang('Applicants list')"><i class="fas fa-folder"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
        {{ $jobs->links('vendor.pagination.bootstrap-5') }}

    @endempty
</div>
