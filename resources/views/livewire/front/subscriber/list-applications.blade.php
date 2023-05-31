<div>
    <h3 class="text-center fw-bolder">@lang('Applicants list')</h3>
    <p class="mb-4 text-center fw-bold">
        @lang('The different applications for job') <span class="text-secondary">{{ $job->title }}</span> @lang('are listed in the table below').
    </p>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="table-warning">
                    <th scope="col">#</th>
                    <th scope="col">@lang('Type')</th>
                    <th scope="col">@lang('Name')</th>
                    <th scope="col">@lang('Email')</th>
                    <th scope="col">@lang('Phone Number')</th>
                    <th scope="col">@lang('Applied on')</th>
                    <th scope="col" class="text-center">@lang('Details')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($talents as $talent)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ __($talent->user->getFreeSubscriptionType()->name) }}</td>
                        <td>{{ $talent->user->name }}</td>
                        <td>{{ $talent->user->email }}</td>
                        <td>{{ $talent->user->phone_number }}</td>
                        <td>{{ formatedLocaleDate($talent->pivot->created_at) }}</td>
                        <td>
                            <a wire:click="showTalentModal({{ $talent->id }})" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $talents->links('vendor.livewire.bootstrap') }}

    @include('front.subscribers.applicants-modal')    
</div>
