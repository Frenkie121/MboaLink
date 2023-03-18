<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Subject')</th>
                        <th>@lang('Received_at')</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="p-0 text-center">{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>
                                <button wire:click="showModalForm({{ $contact }})" class="btn btn-primary"><i class="fas fa-eye"></i></button>
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
                    <h5 class="modal-title" id="MessageModalLabel">@lang('Message Details')</h5>
                    <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Name')</label>
                            <div style="float:right;">{{ $name }}</div>
                            <br>
                            <hr>
                            <div><label for="control-label" style="font-weight:bold;float:left;">Email</label>
                                <a style="float:right;" href="">{{ $email }}</a>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Subject')</label>
                            <div style="float:right;">{{ $subject }}</div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-group">
                            <label style="font-weight:bold;float:left;" class="control-label">@lang('Message')</label>
                            <br>
                            <div style="text-align:justify;">{{ $message }}</div>
                        </div>
                        <form wire:submit.prevent="replyMessage({{ $displayContact }})" id="InputRepyForm"
                            style="display:none;">
                            <hr style="background-color:blue;">
                            <div class="form-group">
                                <label class="control-label"> @lang('Response') </label>
                                <textarea cols="30" rows="10" type="text" wire:model.defer="reply" class="form-control"
                                    placeholder=" {{ __('Reply to the message here') }}..."></textarea>
                                @error('reply')
                                    <span class="text-danger ">{{ $message }} </span>
                                @enderror
                                <br>
                                <div>
                                    <button wire:loading.remove type="submit" style="float: right;"
                                        class="btn btn-success">
                                        <i class="fa fa-paper-plane"></i>
                                        @lang('Send')
                                    </button>
                                    <button wire:loading wire:target="replyMessage" style="float: right;"
                                        class="btn btn-success" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        ...
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" wire:click="closeModal()"
                            data-dismiss="modal">@lang('Cancel') </button>
                        <div>
                            @if (!isset($displayContact->response))
                                <button style="display: block;" type="button" id="buttonReply"
                                    wire:click="{{ $showForm ? 'closeReply()' : 'showReplyInput()' }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-reply"></i>
                                    @if ($showForm)
                                        @lang('Do not reply')
                                    @else
                                        @lang('Reply')
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
