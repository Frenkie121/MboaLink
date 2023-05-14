<h6>@lang('Cursus')</h6>
<br>
<span class="mr-2">@lang('University of ') :</span>
<b>{{ $user->userable->talentable->university }}</b> <br><br>
<span class="mr-2">@lang('Training school') :</span><b>
    {{ $user->userable->talentable->training_school }}</b> <br><br>
{{-- <span class="mr-2">@lang('Field ') :</span>
 @if ($user->userable->talentable->field)
   <b>  {{ $user->userable->talentable->field }}</b>
 @else
     @lang('Any')
 @endif <span class="mr-2 ml-4">@lang('Level') :</span>
 @if ($user->userable->talentable->level)
    <b> {{ $user->userable->talentable->level }}</b>
 @else
     @lang('Any')
 @endif
 <br><br> --}}
