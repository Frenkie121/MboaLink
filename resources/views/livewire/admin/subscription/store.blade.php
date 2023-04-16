<div>
    <form action="post" wire:submit.prevent="save()">
        <div class="card">
            <div class="card-body">
                <br>
                <div class="form-group">
                    <label> @lang('Name')</label>
                    <input value="{{ old('subs_name') }}" type="text"
                        class="form-control @error('duration') is-invaild  @enderror" wire:model.defer="subs_name">
                    @error('subs_name')
                        <span class="text-danger"> <small> {{ $message }}</small></span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>@lang('Duration in Week(s)') </label>
                            <input value="{{ old('duration') }}" type="number" wire:model.defer="duration"
                                class="form-control @error('duration') is-invaild  @enderror" min="0"
                                max="12" placeholder=" 4 ">
                            @error('duration')
                                <span class="text-danger"> <small> {{ $message }}</small></span>
                            @enderror
                        </div>
                        <div class="col-lg-6 ">
                            <label>@lang('Amount') (Fcfa)</label>
                            <input value="{{ old('amount') }}" wire:model.defer="amount" type="number"
                                class="form-control  @error('amount') is-invaild  @enderror" min="0"
                                placeholder=" 5000 ">
                            @error('amount')
                                <span class="text-danger"> <small> {{ $message }}</small></span>
                            @enderror
                        </div>

                    </div>
                </div>

                <br> <br>
                <div class="card-header">
                    <h5 class="card-title ">@lang('Offer')(s)</h5>
                    <hr>
                    {{-- <p style="mt-15" class="text-center">@lang('There is a proposition of each subscription')</p> --}}
                </div>

                <div class="container-fluid">
                    <div class="card-body">
                        <table class="table" id="table">
                            <tr>
                                <th scope="col" class="col-lg-10">@lang('Name')</th>
                                <th scope="col" class="col-lg-2"> </th>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <input value="{{ old('offer.0') }}" type="text" wire:model.defer="offer.0"
                                            class="form-control  @error('amount') is-invaild  @enderror"
                                            placeholder=" text... ">
                                        @error('offer.0')
                                            <span class="text-danger"> <small> {{ $message }}</small></span>
                                        @enderror
                                    </div>

                                </td>
                                <td>
                                    <div wire:click.prevent="add({{ $i }})" class="btn btn-primary btn-lg">
                                        <i class="fa fa-plus col-12"></i>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($offersInput as $key => $index)
                                <tr wire:key="{{ $key }}">
                                    <td>
                                        <div>
                                            <input placeholder="text..." type="text"
                                                class="form-control input-lg @error('offer.{{ $index }}') is-invalid @enderror"
                                                wire:model.defer="offer.{{ $index }}">
                                            @error('offer.{{ $index }}')
                                                <span class="text-danger"> <small> {{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div wire:click.prevent="remove({{ $key }})"
                                            class="btn btn-danger btn-lg"> <i class="fa fa-minus col-12"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
                <div class="text-right">
                    <hr style="background-color:rgb(61, 126, 217);">
                    <button class="btn btn-secondary btn-lg mr-3" type="reset">@lang('Reset')</button>
                    <button class="btn btn-primary btn-lg mt-7 mr-3" type="submit">@lang('Save')</button>
                </div>
            </div>

        </div>
    </form>
</div>
