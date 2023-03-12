<div>

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
                        <button type="button" wire:click="notPublish()" class="btn btn-success" data-dismiss="modal">@lang('Cancel')</button>
                        <button type="button" wire:click="destroyJob()" class="btn btn-danger">
                            @lang('Yes! delete')</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal confirmation delete User --}}
    </div>
