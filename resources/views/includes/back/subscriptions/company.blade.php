
<hr>
<div class="profile-widget-description">

    <h6>@lang('Other informations')</h6>
    <br>
    <span class="mr-2">@lang('Research Area') :</span>
    @if ($user->userable->category->name)
        <b> {{ $user->userable->category->name }}</b>
    @else
        <b> @lang('Any')</b>
    @endif
    <br><br>
    <span class="mr-2">@lang('Location') :</span>
    <b>{{ $user->userable->location }}</b>
    <span class="mr-2 ml-4">@lang('Website') :
    </span><a href="{{ $user->userable->url }}" target="_blank"> {{ $user->userable->url }}</a>
    <br><br>

    <p>@lang('Description') : <strong>
            @if ($user->userable->description)
                {{ $user->userable->description }}
            @else
                @lang('Any')
            @endif
        </strong></p>

    <br><br>
</div>
