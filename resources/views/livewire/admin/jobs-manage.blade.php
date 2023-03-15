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
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->company->location }}</td>
                                            <td>{{ $job->salary }}</td>
                                            <td>
                                                @if ($job->published_at)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.job.show', $job) }}"
                                                    class="btn btn-icon icon-left btn-primary"><i
                                                        class="fas fa-eye"></i> </a>
                                                <div style="display: inline-block">
                                                    <button wire:loading.remove
                                                        wire:click="publish({{ $job }})"
                                                        class="btn btn-success">
                                                        <i class="fa fa-upload"></i>
                                                    </button>
                                                    <button wire:loading  wire:target="publish" class="btn btn-success" disabled>
                                                        <span class="spinner-border spinner-border-xs" role="status"
                                                            aria-hidden="true"></span>
                                                        @lang('Loading')...
                                                    </button>
                                                </div>
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
