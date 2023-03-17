<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Subject')</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($contacts as $contact)
                        <tr wire:key="{{ $loop->index }}">
                            <td class="p-0 text-center">{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                <button wire:click="showModalForm({{ $contact->id }})" class="btn btn-primary"><i
                                        class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                {{ $contacts->links() }}
            </nav>
        </div>
    </div>

    <!-- Modal showMessage -->
    <div wire:ignore.self class="modal fade" id="MessageModal" tabindex="-1" role="dialog"
        aria-labelledby="EditCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCategoryLabel">@lang('Details Message')</h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Name')</label>
                            <div style="float:right;">{{ $contact->name }}</div>
                            <br>
                            <hr>
                            <div><label for="control-label" style="font-weight:bold;float:left;">From</label>
                                <a style="float:right;" href="">{{ $contact->email }}</a>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Subject')</label>
                            <div style="float:right;">{{ $contact->subject }}"</div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Message')</label>
                            <br>
                            <div style="text-align:justify;" class="">{{ $contact->message }}"</div>
                        </div>
                        <form wire:submit.prevent="replyMessage({{ $contact }})" id="InputRepyForm"
                            style="display:none;">
                            <hr style="background-color:blue;">
                            <div class="form-group">
                                <label class="control-label"> @lang('Response') </label>
                                <textarea cols="30" rows="10" type="text" wire:model.defer="reply" class="form-control"
                                    placeholder=" {{ __('Reply to this message here...') }}"></textarea>
                                @error('reply')
                                    <span class="text-danger ">{{ $message }} </span>
                                @enderror
                                <br>
                                <button type="submit" style="float: right;" class="btn btn-primary">@lang('Send')
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" wire:click="closeModal()"
                            data-dismiss="modal">@lang('Cancel')</button>
                        @if (!$contact->response)
                            <button type="button" wire:click="showReplyInput()"
                                class="btn btn-primary">@lang('Reply') </button>
                        @endif
                        {{-- @if ($showForm)
                            <button type="reset" style="float: right;" class="btn btn-secondary"
                                wire:click="closeReply()" data-dismiss="modal">@lang('Not reply')</button>
                        @endif --}}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
