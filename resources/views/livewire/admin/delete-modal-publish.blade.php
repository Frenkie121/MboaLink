<div>
    <!-- Button trigger published -->
    @if (! $job->published_at)
        <button class="btn btn-lg btn-primary float-right" wire:click="deleteJob({{ $job->id }})" type="button" data-toggle="modal" data-target="#deleteJob">@lang('Actions')</button>
    @else
        <span class="badge badge-success float-right">@lang('Published')</span>
    @endif

    <!-- Modal Delete Tag -->
    <div wire:ignore.self class="modal fade" id="deleteJob" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJob">@lang('Actions for job') <strong>{{ $title }}</strong></h5>
                </div>
                <div class="modal-body">
                    <p class="text-primary font-weight-bold mb-0 h6">@lang('Do you confirm the publication of this job?')</p>
                    <span class="font-weight-bold">@lang('Target jobseekers with a valid subscription will receive notification for this job.')</span>
                    <p class="text-danger font-weight-bold mt-2 h6 mb-0">@lang('Alternatively, you can also delete it.')</p>
                    <span class="font-weight-bold">@lang('The company will receive notification for the deletion of its job.')</span>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button wire:loading.remove wire:click="destroyJob()" class="btn btn-danger"></i> @lang('Delete')</button>
                    <button wire:loading wire:target="destroyJob" class="btn btn-danger" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        @lang('Loading')...
                    </button>
                    <div>
                        <button type="button" wire:click="closeModal()" class="btn btn-secondary" data-dismiss="modal">@lang('Cancel')</button>

                        <button wire:loading.remove wire:click="publish({{ $job }})" class="btn btn-primary"> @lang('Publish')</button>
                        <button wire:loading wire:target="publish" class="btn btn-primary" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            @lang('Loading')...
                        </button>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal confirmation delete User --}}


</div>
