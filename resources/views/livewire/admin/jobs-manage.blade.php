<div>
    <x-admin.section-header :title="__('Jobs list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table cla class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Title')</th>
                                        <th>@lang('Company')</th>
                                        <th>@lang('Submitted at')</th>
                                        <th>@lang('Status')</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        @php
                                            $hasTalent = $job->talents->isNotEmpty();
                                        @endphp
                                        <tr wire:key="{{ $loop->index }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->company->user->name }}</td>
                                            <td>{{ $job->created_at }}</td>
                                            <td>
                                                @if ($job->published_at)
                                                    <span class="badge badge-pill badge-success"><small>@lang('Published on') {{ $job->published_at }}</small></span>
                                                @else
                                                    <span class="badge badge-pill badge-dark">@lang('Pending')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.job.show', $job) }}"
                                                    class="btn btn-icon icon-left btn-primary" title="@lang('Details')"><i class="fas fa-eye"></i> 
                                                </a>
                                                <a
                                                    href="{{ route('admin.job.applicants', $job) }}"
                                                    class="btn btn-icon icon-left btn-{{ $hasTalent ? 'info' : 'secondary' }}"
                                                    title="@if($hasTalent)@lang('Applicants list')@else @lang('No applicant yet')@endif">
                                                    <i class="fas fa-users"></i>@if($hasTalent)<sup>{{ $job->talents->count() }}</sup> @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            {{ $jobs->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
