<div wire:ignore.self class="modal fade" id="deleteSubCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSubCategoryModalLabel">
                    @lang('Delete sub-category') <strong>{{ $selectedSubCategory->name }}</strong>
                </h5>
                <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger font-weight-bold">
                    @if($selectedSubCategory->jobs->count() > 0) 
                        @lang('This sub-category contains') {{ $selectedSubCategory->jobs->count() }} @lang('job offer(s)'). @lang('You cannot delete it').
                        @if (! $selectedSubCategory->disabled_at)
                            @lang('You can, however, disable it, and it will no longer appear in the proposals made to users.')
                        @endif
                    @else
                        @lang('Are you sure you want to delete this subcategory?')
                        <br>
                        @if (! $selectedSubCategory->disabled_at)
                            @lang("You can disable it if you don't want to delete it permanently.")
                        @endif
                        {{-- <br> @lang('This will also delete all jobs related to this subcategory.')</p> --}}
                    @endif
                </p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" wire:click="closeModal()" class="btn btn-secondary">@lang('Cancel')</button>
                <div class="">
                    <button type="button" class="btn btn-{{ $selectedSubCategory->disabled_at ? 'success' : 'warning' }}" wire:click="updateStatus()">{{ $selectedSubCategory->disabled_at ? __('Enable') : __('Disable') }}</button>
                    @if ($selectedSubCategory->jobs->count() === 0)
                        <button type="button" wire:click="confirmDelete()" class="btn btn-danger">@lang('Confirm')</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
