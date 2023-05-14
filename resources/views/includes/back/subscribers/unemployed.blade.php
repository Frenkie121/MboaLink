<span class="mr-2">@lang('Diploma') :</span>
<b>{{ $user->userable->talentable->diploma }}</b> <br><br>
<span class="mr-2">@lang('Current Job') :</span><b>
    {{ $user->userable->talentable->current_job }}</b> <br><br>
<span class="mr-2">@lang('Aptitudes') :</span>
@if ($user->userable->talentable->aptitudes)
    {{ $user->userable->talentable->aptitudes }}
@else
    No-data
@endif

<br><br>
<span class="mr-2">@lang('Qualifications') :</span>
@if ($user->userable->talentable->qualifications)
    {{ $user->userable->talentable->qualifications }}
@else
    No-data
@endif
{{-- @endif --}}
