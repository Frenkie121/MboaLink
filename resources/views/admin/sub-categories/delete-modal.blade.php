<div wire:ignore.self class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">
                    @lang('Delete sub-category') <strong>{{ $selectedSubCategory->name }}</strong>
                </h5>
                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger font-weight-bold">@lang('Are you sure you want to delete this subcategory? This will also delete all jobs related to this subcategory.')</p>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal()" class="btn btn-primary" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" wire:click="confirmDelete()" class="btn btn-danger">@lang('Confirm')</button>
                </div>
            </div>
        </div>
    </div>
</div>