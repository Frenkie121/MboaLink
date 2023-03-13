<div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger published -->
                        @if (!$job->is_published)
                            <form method="POST" action="{{ route('admin.job.publish', $job->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="float: right;" type="button"
                                    class="btn btn-lg btn btn-success">
                                    <i class="fa fa-upload btn-sm"></i> @lang('Published') </button>
                            </form>
                        @else
                            <a style="float: right;" wire:click="deleteJob({{ $job->id }})" type="button"
                                class="btn btn-lg btn btn-danger" data-toggle="modal" data-target="#deleteJob">
                                <i class="fas fa-times btn-sm"></i> @lang('Not Published') </a>
                        @endif

                        <br><br><br>
                        <div class="table-responsive  table-bordered">

                            <table class="table table-striped" id="table-1">

                                <tr>
                                    <td style="font-weight:bold;">@lang('Title')</td>
                                    <td>{{ $job->title }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Slug')</td>
                                    <td>{{ $job->slug }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Description')</td>
                                    <td>{{ $job->description }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Location')</td>
                                    <td>{{ $job->location }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;"> @lang('Salary')</td>
                                    <td>{{ $job->salary }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Dateline')</td>
                                    <td>{{ $job->dateline }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Company')</td>
                                    <td>{{ $job->company->location }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Sub-category')</td>
                                    <td>{{ $job->subCategory->name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Tag')</td>
                                    <td>
                                        @forelse ($job->tags as $item)
                                            {{ $item->name }},
                                        @empty
                                            ---
                                        @endforelse
                                    </td>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Type')</td>
                                    <td>{{ $job->type }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('File')</td>
                                    <td>
                                        @if ($job->file)
                                            {{ $job->file }}
                                        @else
                                            Any
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Created at')</td>
                                    <td>{{ $job->created_at }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;">@lang('Updated at')</td>
                                    <td>{{ $job->updated_at }}</td>
                                </tr>

                            </table>
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
                        <h5 class="modal-title" id="deleteJob">@lang('Delete job') <strong>{{ $title }}</strong>
                        </h5>
                        <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger font-weight-bold">@lang('Would you like to delete this job as well ? ?')</p>
                        <div class="modal-footer">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="notPublish()" class="btn btn-success"
                                data-dismiss="modal">@lang('Cancel')</button>
                            <button type="button" wire:click="destroyJob()" class="btn btn-danger">
                                @lang('Yes! delete')</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal confirmation delete User --}}
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
                    <p class="text-danger font-weight-bold">@lang('Would you like to delete this job as well ? ?')</p>
                    <div class="modal-footer">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="notPublish()" class="btn btn-success"
                            data-dismiss="modal">@lang('Cancel')</button>
                        <button type="button" wire:click="destroyJob()" class="btn btn-danger">
                            @lang('Yes! delete')</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal confirmation delete User --}}
    </div>
