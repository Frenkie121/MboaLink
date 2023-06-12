<div>
    <x-admin.section-header :title="__('Tags list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Button trigger modal -->
                            <button wire:click="showCreateForm()" type="button" class="btn btn-primary float-right">@lang('Add Tag') </button>
                            <br><br>
                            <table cla class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Included in ... job(s)')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->jobs_count }}</td>
                                            <td>
                                                <button wire:click="showEditForm({{ $tag }})" class="btn btn-icon icon-left btn-primary"><i class="fas fa-pen"></i></button>
                                                <button class="btn btn-danger" wire:click="showDeleteForm({{ $tag }})"> <i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            {{ $tags->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal addTag + EditTag-->
    <div wire:ignore.self class="modal fade" id="AddTag" tabindex="-1" role="dialog" aria-labelledby="AddTagLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddTagLabel">
                        @if ($selectedTag)
                            @lang('Edit Tag')
                        @else
                            @lang('Add Tag')
                        @endif
                    </h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent={{ $selectedTag ? 'updateTag' : 'addTag' }}>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label"> @lang('Tag name') </label>
                            <input type="text" wire:model.defer="name" class="form-control"
                                placeholder=" {{ __('Name') }}" />
                            @error('name')
                                <span class="text-danger ">{{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" wire:click="closeModal()" class="btn btn-secondary"
                            data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary">
                            @if ($selectedTag)
                                @lang('Edit')
                            @else
                                @lang('Save')
                            @endif
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Delete Tag -->
    <div wire:ignore.self class="modal fade" id="deleteTag" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTag">@lang('Delete tag') <strong>{{ $name }}</strong></h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-weight-bold">@lang('Are you sure you want to delete this tag?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" wire:click="destroyTag()" class="btn btn-danger">@lang('Confirmer')</button>
                </div>
            </div>
        </div>
        {{-- end modal confirmation delete User --}}

    </div>
