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
                                        <th>@lang('Salary')</th>
                                        <th>@lang('Published')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr wire:key="{{ $loop->index }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->company->location }}</td>
                                            <td>{{ $job->salary }}</td>
                                            <td>
                                                @if ($job->published_at)
                                                    <span class="badge badge-pill badge-success">{{ $job->published_at }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-dark">@lang('No')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.job.show', $job) }}"
                                                    class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i> 
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
