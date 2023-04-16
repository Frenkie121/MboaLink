<div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Edit subscription')" :previousTitle="__('Subscription list')" :previousRouteName="route('admin.subscription.index')" />
    <div class="container mt-4 col-10">
        <div class="offset-md-0">
            <div>
                <div>
                    <form method="post" action="{{ route('admin.subscription.update', $subscription->id) }}">
                        @csrf
                        @method('patch')
                        <div class="card">

                            <div class="card-body">
                                <br>

                                <div class="form-group">
                                    <label> @lang('Name')</label>
                                    <input value="{{ old('subs_name') }}" type="text"
                                        class="form-control @error('duration') is-invaild  @enderror"
                                        wire:model.defer="subs_name" name="subs_name">
                                    @error('subs_name')
                                        <span class="text-danger"> <small> {{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>@lang('Duration in Week(s)') </label>
                                            <input value="{{ old('duration') }}" type="number"
                                                wire:model.defer="duration" name="duration"
                                                class="form-control @error('duration') is-invaild  @enderror"
                                                min="0" max="12" placeholder=" 4 ">
                                            @error('duration')
                                                <span class="text-danger"> <small> {{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label>@lang('Amount') (Fcfa)</label>
                                            <input value="{{ old('amount') }}" wire:model.defer="amount" name="amount"
                                                type="number"
                                                class="form-control  @error('amount') is-invaild  @enderror"
                                                min="0" placeholder=" 5000 ">
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

                                            @foreach ($offersInput as $key => $value)
                                                <tr wire:key="{{ $index }}">
                                                    <td>
                                                        <div>
                                                            <input placeholder="text..." type="text"
                                                                class="form-control " name="offer[]"
                                                                value="{{ $value->content }}">
                                                            @error('offer[]')
                                                                <span class="text-danger"> <small>
                                                                        {{ $message }}</small></span>
                                                            @enderror
                                                        </div>
                                                    </td>
                                                    @if ($key === 0)
                                                        <td>
                                                            <div wire:click.prevent="add({{ $i }})"
                                                                class="btn btn-primary btn-lg">
                                                                <i class="fa fa-plus col-12"></i>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <div wire:click.prevent="remove({{ $key }})"
                                                                class="btn btn-danger btn-lg"> <i
                                                                    class="fa fa-minus col-12"></i>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            @foreach ($offersInputAdd as $key => $value)
                                                <tr wire:key="{{ $index }}">
                                                    <td>
                                                        <div>
                                                            <input placeholder="text..." type="text"
                                                                class="form-control " name="offer_add[]">
                                                            @error('offer_add[]')
                                                                <span class="text-danger"> <small>
                                                                        {{ $message }}</small></span>
                                                            @enderror
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div wire:click.prevent="remove({{ $key }})"
                                                            class="btn btn-danger btn-lg"> <i
                                                                class="fa fa-minus col-12"></i>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                </div>
                                <div class="text-right">
                                    <hr style="background-color:rgb(61, 126, 217);">
                                    <button class="btn btn-secondary btn-lg mr-3"
                                        type="reset">@lang('Reset')</button>
                                    <button class="btn btn-primary btn-lg mt-7 mr-3"
                                        type="submit">@lang('Updated at')</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
        <div class=" offset-lg-2 offset-md-0"></div>
        {{-- </div> --}}
        {{-- </div> --}}
    </div>
</div>
