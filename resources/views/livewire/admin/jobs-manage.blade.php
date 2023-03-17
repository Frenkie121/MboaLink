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
                                                    class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i> </a>
                                                {{-- <a href="#" wire:click="deleteJob({{ $job->id }})"
                                                    class="btn btn-danger" data-toggle="modal" data-target="#deleteJob">
                                                    <i class="fa fa-trash"></i>
                                                </a> --}}
                                                <div class="dropdown d-inline">
                                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter"></i></button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item has-icon" href="#">@lang('Cancel')</a>
                                                      <a class="dropdown-item has-icon" href="#">@lang('Publish')</a>
                                                    </div>
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
    <!-- Modal Delete Tag -->
    <div wire:ignore.self class="modal fade" id="deleteJob" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJob">@lang('Delete job') <strong>{{ $title }}</strong></h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-weight-bold">@lang('Are you sure you want to delete this job?')</p>
                    <div class="modal-footer">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">@lang('Cancel')</button>
                        <button type="button" wire:click="destroyJob()" class="btn btn-danger">
                            @lang('Delete')</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal confirmation delete User --}}
    </div>
