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
                                        <th>@lang('Location')</th>
                                        <th>@lang('Salary')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($jobs as $job)
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->location }}</td>
                                            <td>{{ $job->salary }}</td>
                                            <td>
                                                <a href="#" wire:click="showJob({{ $job->id }})"
                                                    data-toggle="modal" data-target="#showJobModal"
                                                    class="btn btn-icon icon-left btn-primary"><i
                                                        class="fas fa-eye"></i> </a>
                                                <a href="#" wire:click="deleteJob({{ $job->id }})"
                                                    class="btn btn-danger" data-toggle="modal" data-target="#deleteJob">
                                                    <i class="fa fa-trash"></i>
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
                            @lang('Yes! delete')</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal confirmation delete User --}}






        {{-- Start show modal --}}
        <div wire:ignore.self class="modal fade" id="ShowJobModalLabel" tabindex="-1" role="dialog"
            aria-labelledby="ShowJobModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ShowJobModalLabel">
                            @lang('Show job') {{ $title }}
                        </h5>
                        <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            {{-- <div class="form-group row">
                                <label for="category" class="col-sm-3 col-form-label">@lang('Category')</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" wire:model.defer="location">
                                        <option @disabled($selectedSubCategory) @selected(!$selectedSubCategory)>
                                            @lang('Select a category')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($selectedSubCategory && $category->id === $selectedSubCategory->category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">@lang('Title')</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly wire:model.defer="title" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">@lang('Location')</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly wire:model.defer="location" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">@lang('Description')</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly wire:model.defer="description" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" wire:click="closeModal()" class="btn btn-secondary"
                                    data-dismiss="modal">@lang('Cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>
