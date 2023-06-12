<div wire:ignore.self class="modal fade" id="subCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="subCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subCategoryModalLabel">
                    @if ($selectedSubCategory)
                        @lang('Edit sub-category') {{ $selectedSubCategory->name }}
                    @else
                        @lang('Add new sub-category')
                    @endif
                </h5>
                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="{{ $selectedSubCategory ? 'update()' : 'store()' }}">
                    <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">@lang('Category')</label>
                        <div class="col-sm-9">
                            <select class="custom-select" wire:model.defer="category">
                                <option @disabled($selectedSubCategory) @selected(!$selectedSubCategory)>@lang('Select a category')
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($selectedSubCategory && $category->id === $selectedSubCategory->category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">@lang('Name')</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.defer="name" class="form-control" id="name"
                                placeholder="@lang('Name')">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" wire:click="closeModal()" class="btn btn-secondary"
                            data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-primary">{{ $selectedSubCategory ? __('Edit') : __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
