<div>
    <x-admin.section-header :title="__('Categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Button trigger modal -->
                            <button style="float: right;" type="button" class="btn btn-md btn btn-primary"
                                data-toggle="modal" data-target="#AddCategory">
                                <i class="fa fa-plus btn-md"></i> @lang('Add category') </button>
                            <br><br>
                            <table cla class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a href="#" wire:click="editCategory({{ $category->id }})"
                                                    data-toggle="modal" data-target="#EditCategory"
                                                    class="btn btn-icon icon-left btn-primary"><i
                                                        class="fas fa-pen"></i> </a>
                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteCategory"
                                                    wire:click="deleteCategory({{ $category->id }})"> <i
                                                        class="fa fa-trash"></i>
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
                            {{ $categories->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal addCategory -->
    <div wire:ignore.self class="modal fade" id="AddCategory" tabindex="-1" role="dialog"
        aria-labelledby="AddCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCategoryLabel"> @lang('Add category') </h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="addCategory">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label"> @lang('Category name') </label>
                            <input type="text" wire:model.defer="name" class="form-control"
                                placeholder="{{ __('Category Name here') }}" />
                            @error('name')
                                <span class="text-danger ">{{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" wire:click="closeModal()"
                            data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary"> @lang('Save') </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal EditCategory -->
    <div wire:ignore.self class="modal fade" id="EditCategory" tabindex="-1" role="dialog"
        aria-labelledby="EditCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCategoryLabel">@lang('Edit Category')</h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateCategory">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">@lang('Name')</label>
                            <input type="text" wire:model.defer="nameEdit" class="form-control"
                                placeholder="Category Name here" />
                            @error('nameEdit')
                                <span class="text-danger ">{{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" wire:click="closeModal()"
                            data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary">@lang('Edit') </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Delete Category -->
    <div wire:ignore.self class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategory">@lang('Delete category') <strong>
                            {{ $nameDelete }}</strong></h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-weight-bold">@lang('Are you sure you want to delete this category? This will also delete all jobs related to this category.')</p>
                    </span>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-success" wire:click="closeModal()"
                        data-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" wire:click="destroyCategory()" class="btn btn-danger">
                        @lang('Yes! delete')</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal confirmation delete User --}}

</div>
