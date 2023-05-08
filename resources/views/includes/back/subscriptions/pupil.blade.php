<h6>@lang('Cursus')</h6>
<br>
<span class="mr-2">@lang('Section') :</span>
<b>
    @if ($user->userable->talentable->section === 'fr')
        @lang('French')
    @elseif($user->userable->talentable->section === 'en')
        @lang('English')
    @endif
</b>
<span class="mr-2 ml-4">@lang('Série') :</span>
@if ($user->userable->talentable->serie)
    <b>{{ $user->userable->talentable->serie }}</b>
@else
    No-data
@endif

<span class="mr-2 ml-4">@lang('Class') :</span>
@if ($user->userable->talentable->class)
    <b>{{ $user->userable->talentable->class }}</b>
@else
    No-data
@endif
<br><br>

<span class="mr-2 ">@lang('School') :</span>
@if ($user->userable->talentable->school)
    <b>{{ $user->userable->talentable->school }}</b>
@else
    No-data
@endif
<br><br>
