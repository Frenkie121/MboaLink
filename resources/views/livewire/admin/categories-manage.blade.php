<div>
    <x-admin.section-header :title="__('Categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Button trigger modal -->
                            <button wire:click="showCreateForm()" type="button" class="btn btn-primary float-right">@lang('Add category')</button>
                            <br><br>
                            <table  class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Number of job offers')</th>
                                        <th>@lang('Status')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->jobs_count }}</td>
                                            <td class="text-light">
                                                @if ($category->disabled_at)
                                                    <span class="badge bg-danger">@lang('Disabled at') {{ formatedLocaleDate($category->disabled_at) }}</span>
                                                @else
                                                    <span class="badge bg-primary">@lang('Active')</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="showEditForm({{ $category }})" class="btn btn-icon icon-left btn-primary"><i class="fas fa-pen"></i> </button>
                                                <button class="btn btn-danger" wire:click="showDeleteForm({{ $category }})"> <i class="fa fa-trash"></i></button>
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
            @if ($selectedCategory)
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategory">@lang('Delete category') <strong>
                                {{ $nameDelete }}</strong></h5>
                        <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger font-weight-bold">
                            @if ($selectedCategory->subCategories->count() > 0)
                                @lang('This category contains') {{ $selectedCategory->subCategories->count() }} @lang('sub-categorie(s)').
                            @endif
                            @if($selectedCategory->jobs->count() > 0) 
                                @lang('It also contains') {{ $selectedCategory->jobs->count() }} @lang('job offer(s)'). @lang('You cannot delete it'). @lang('You can, however, disable it, and it will no longer appear in the proposals made to users.')
                            @endif
                            @if ($selectedCategory->jobs->count() === 0)
                                <br>
                                @lang('Are you sure you want to delete this category?')
                                <br>
                                @lang("You can disable it if you don't want to delete it permanently.")
                                {{-- @lang('This will also remove all subcategories and jobs linked to that category.') --}}
                            @endif
                        </p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary">@lang('Cancel')</button>
                        <div class="">
                            <button type="button" class="btn btn-{{ $selectedCategory->disabled_at ? 'success' : 'warning' }}" wire:click="updateStatus()">{{ $selectedCategory->disabled_at ? __('Enable') : __('Disable') }}</button>
                            @if ($selectedCategory->jobs->count() === 0)
                                <button type="button" wire:click="destroyCategory()" class="btn btn-danger">@lang('Confirm')</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- end modal confirmation delete User --}}

</div>
