<div wire:ignore.self class="modal fade" id="applicantDetailsModal" tabindex="-1" aria-labelledby="applicantDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if ($selectedTalent)
                @php
                    $type = $user->getFreeSubscriptionType();
                    $talentable = $selectedTalent->talentable;
                @endphp
                <div class="modal-header">
                    @if ($selectedTalent )
                        <h5 class="modal-title" id="applicantDetailsModalLabel">@lang('Details of applicant:') <span class="text-secondary">{{ $selectedTalent->user->name }} </span>({{ __($type->name) }})</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <h5 class="text-decoration-underline">@lang('Personal Informations')</h5>
                            <p>@lang('Name') : <span class="fw-bold">{{ $user->name }}</span></p>
                            <p>@lang('Email') : <span class="fw-bold">{{ $user->email }}</span></p>
                            <p>@lang('Birth Date') : <span class="fw-bold">{{ formatedLocaleDate($selectedTalent->birth_date) }}</span></p>
                            <p>@lang('Phone Number') : <span class="fw-bold">{{ $user->phone_number }}</span></p>
                            <p>@lang('Language') : <span class="fw-bold">{{ $selectedTalent->language }}</span></p>
                            <p>@lang('Location') : <span class="fw-bold">{{ $selectedTalent->location }}</span></p>
                            <p>@lang('Aspiration') : <span class="fw-bold fs-custom">{{ $selectedTalent->aspiration }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-decoration-underline">@lang('Other informations')</h5>
                            @if ($type->id === 3)
                                <p>@lang('University') : <span class="fw-bold">{{ $talentable->university }}</span></p>
                                <p>@lang('Training School') : <span class="fw-bold">{{ $talentable->training_school }}</span></p>
                                <p>@lang('Level') : <span class="fw-bold">{{ $talentable->level ?? '/' }}</span></p>
                                <p>@lang('Field') : <span class="fw-bold">{{ $talentable->field ?? '/' }}</span></p>
                            @elseif ($type->id === 4)
                                <p>@lang('School') : <span class="fw-bold">{{ $talentable->school }}</span></p>
                                <p>@lang('Section') : <span class="fw-bold">{{ $talentable->section }}</span></p>
                                <p>@lang('Cycle') : <span class="fw-bold">{{ $talentable->cycle }}</span></p>
                                <p>@lang('Class') : <span class="fw-bold">{{ $talentable->class }}</span></p>
                                <p>@lang('Serie') : <span class="fw-bold">{{ $talentable->serie }}</span></p>
                            @elseif ($type->id === 5)
                                <p>@lang('Diploma') : <span class="fw-bold">{{ $talentable->diploma ?? '/' }}</span></p>
                                <p>@lang('Current job') : <span class="fw-bold">{{ $talentable->current_job ?? '/' }}</span></p>
                                <p>@lang('Aptitudes') : <span class="fw-bold fs-custom">{{ $talentable->aptitudes ?? '/' }}</span></p>
                                <p>@lang('Qualifications') : <span class="fw-bold fs-custom">{{ $talentable->qualifications ?? '/' }}</span></p>
                            @endif
                            <p>@lang('CV') : 
                                <span class="fw-bold">
                                    @if($selectedTalent->cv)
                                        <a href="#">@lang('Open')</a>
                                    @else
                                        /
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>