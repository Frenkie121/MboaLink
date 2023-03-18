<div>
    <!-- Button trigger published -->
    <div>
    
        <div style="display: inline-block">
            <button wire:loading.remove wire:click="publish({{ $job }})" class="btn btn-success">
                <i class="fa fa-upload btn-sm"></i> @lang('Publish')
            </button>
            <button wire:loading wire:target="publish" class="btn btn-success" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                @lang('Loading')...
            </button>
        </div>

        <button style="float: right;" wire:click="deleteJob({{ $job->id }})" type="button"
            class="btn btn-lg btn-danger" data-toggle="modal" data-target="#deleteJob">
            <i class="fas fa-times btn-sm"></i> @lang('Do not publish')
        </button>
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
                    <p class="text-danger font-weight-bold">@lang('Would you like to delete this job as well ?')</p>
                    <div class="modal-footer">
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal()" class="btn btn-primary"
                            data-dismiss="modal">@lang('Cancel')</button>

                        <div style="display: inline-block">
                            <button wire:loading.remove wire:click="destroyJob()" class="btn btn-danger">
                                </i> @lang('Confirm')
                            </button>
                            <button wire:loading wire:target="destroyJob" class="btn btn-danger" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                ...
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal confirmation delete User --}}


</div>
