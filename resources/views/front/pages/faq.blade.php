@extends('layouts.front')

@section('subtitle', __('FAQ'))

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('FAQ')" />
    <!-- Header End -->

    <!-- FAQ Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Frequently Asked Questions')</h1>
            <div class="row g-4">
                <ol type="I">
                    <li>
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">@lang('About')</h4>
                        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="accordion" id="accordionFirst">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFirstOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFirstOne" aria-expanded="true" aria-controls="collapseFirstOne">@lang('Who is') {{ config('app.name') }}?</button>
                                    </h2>
                                    <div id="collapseFirstOne" class="accordion-collapse collapse show" aria-labelledby="headingFirstOne" data-bs-parent="#accordionFirst">
                                        <div class="accordion-body">
                                            <strong>{{ config('app.name') }}</strong> @lang('is a start-up agency for employment born from a firm will to facilitate the professional insertion of any Cameroonian. It is in this optics that was set up this platform in order to bring closer to the companies, the job seekers and of professional training course, in this way they will be on the lookout for the least advertisement or request of those.') <a href="{{ route('front.about') }}">@lang('More detais here') <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecond">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecondTwo" aria-expanded="false" aria-controls="collapseSecondTwo">
                                        @lang('Where are you located?')</button>
                                    </h2>
                                    <div id="collapseSecondTwo" class="accordion-collapse collapse" aria-labelledby="headingSecond" data-bs-parent="#accordionFirst">
                                        <div class="accordion-body">
                                            <strong>{{ config('app.name') }}</strong> @lang('is currently located in Douala. Details to follow.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThird">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdThree" aria-expanded="false" aria-controls="collapseThirdThree">
                                        @lang('How to get in touch?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdThree" class="accordion-collapse collapse" aria-labelledby="headingThird" data-bs-parent="#accordionFirst">
                                        <div class="accordion-body">
                                            @lang('You can reach us using the information')  <a href="{{ route('front.contact') }}">@lang('on this page')</a> @lang('(Phone call, Email) or from the contact form for a better follow-up.')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">@lang('Website access')</h4>
                        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="accordion" id="accordionSecond">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecondOne" aria-expanded="true" aria-controls="collapseSecondOne">@lang('How can I register on the site?')</button>
                                    </h2>
                                    <div id="collapseSecondOne" class="accordion-collapse collapse" aria-labelledby="headingSecondOne" data-bs-parent="#accordionSecond">
                                        <div class="accordion-body">
                                            @lang('You can register') <a href="{{ route('front.subscriptions.index') }}">@lang('from this page')</a>, @lang('by subscribing to one of our subscription plans. You can start with a free plan. This will give you a first experience of the platform without paying.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecondTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecondTwo" aria-expanded="true" aria-controls="collapseSecondTwo">@lang('Do I have to pay to access the website?')</button>
                                    </h2>
                                    <div id="collapseSecondTwo" class="accordion-collapse collapse" aria-labelledby="headingSecondTwo" data-bs-parent="#accordionSecond">
                                        <div class="accordion-body">
                                            @lang("No! You can access the platform without paying. With a free subscription you don't have to pay.")
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">@lang('Subscriptions')</h4>
                        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="accordion" id="accordionThird">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdOne" aria-expanded="true" aria-controls="collapseThirdOne">@lang('Do I have to take out a subscription plan?')</button>
                                    </h2>
                                    <div id="collapseThirdOne" class="accordion-collapse collapse" aria-labelledby="headingThirdOne" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang("Without a subscription, you can browse the site and its general information (About, Contact, FAQ, ...). But you won't be able to submit a job offer (company) or consult job offers. We advise you to start with") <a href="{{ route('front.subscriptions.index') }}">@lang('a free subscription').</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdSecond">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdTwo" aria-expanded="false" aria-controls="collapseThirdTwo">
                                        @lang('Is a free subscription right for me?')</button>
                                    </h2>
                                    <div id="collapseThirdTwo" class="accordion-collapse collapse" aria-labelledby="headingThirdSecond" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('A free subscription is a good place to start. You can always choose the one that suits your profile. So when you choose a free subscription, you select the type (Business, Student, High School Student, Unemployed) that best represents you.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdThree" aria-expanded="false" aria-controls="collapseThirdThree">
                                        @lang('Can I take out a free subscription more than once?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdThree" class="accordion-collapse collapse" aria-labelledby="headingThirdThree" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('No, it is not possible to subscribe to this plan more than once. You should upgrade at the end of the plan.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdFour" aria-expanded="false" aria-controls="collapseThirdFour">
                                        @lang('How do I pay for a paid subscription?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdFour" class="accordion-collapse collapse" aria-labelledby="headingThirdFour" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('For the moment, the platform does not include an online payment option. Payment is managed after discussion with the site administrator, who will provide you with the channel through which the action will be carried out.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdFive" aria-expanded="false" aria-controls="collapseThirdFive">
                                        @lang('How do I know that my payment has been processed?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdFive" class="accordion-collapse collapse" aria-labelledby="headingThirdFive" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('Following your payment, the administrator will validate your subscription/renewal. This marks the effectiveness of your payment.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdSix" aria-expanded="false" aria-controls="collapseThirdSix">
                                        @lang('What should I do if my subscription is not validated after payment?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdSix" class="accordion-collapse collapse" aria-labelledby="headingThirdSix" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('You can contact the administrator from') <a href="{{ route('front.contact') }}">@lang('these contacts').</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThirdSeven">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirdSeven" aria-expanded="false" aria-controls="collapseThirdSeven">
                                        @lang('How can I renew my subscription plan?')
                                        </button>
                                    </h2>
                                    <div id="collapseThirdSeven" class="accordion-collapse collapse" aria-labelledby="headingThirdSeven" data-bs-parent="#accordionThird">
                                        <div class="accordion-body">
                                            @lang('Please note that you can request renewal 7 days before the end of your current subscription.')
                                            <ul>
                                                <li>@lang("If you have a free subscription, a link is provided for you to do so. After logging in, you'll see it in the drop-down menu at the top right of the page.")</li>
                                                <li>@lang('If you have a paid subscription, you can access it from your') <i class="text-secondary">@lang('dashboard')</i>. @lang('Click on the link') <i class="text-secondary">@lang('My Subscriptions'),</i> @lang('to access the renewal link.')</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">@lang('Personal data')</h4>
                        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="accordion" id="accordionFourth">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFourthOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourthOne" aria-expanded="true" aria-controls="collapseFourthOne">@lang('How can I access my personal data?')</button>
                                    </h2>
                                    <div id="collapseFourthOne" class="accordion-collapse collapse" aria-labelledby="headingFourthOne" data-bs-parent="#accordionFourth">
                                        <div class="accordion-body">
                                            @lang('Personal information, filled in at the time of subscription, can be accessed from the dashboard.') <i class="text-secondary">@lang('This is only possible for paying subscribers.')</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFourthTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourthTwo" aria-expanded="true" aria-controls="collapseFourthTwo">@lang('Can I change my personal information?')</button>
                                    </h2>
                                    <div id="collapseFourthTwo" class="accordion-collapse collapse" aria-labelledby="headingFourthTwo" data-bs-parent="#accordionFourth">
                                        <div class="accordion-body">
                                            @lang('Yes, if you have a paid subscription. You can do this from your dashboard, on the') <i class="text-secondary">@lang('profile page').</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFourthThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourthThree" aria-expanded="true" aria-controls="collapseFourthThree">@lang('How are my personal data used?')</button>
                                    </h2>
                                    <div id="collapseFourthThree" class="accordion-collapse collapse" aria-labelledby="headingFourthThree" data-bs-parent="#accordionFourth">
                                        <div class="accordion-body">
                                            @lang('Your personal information allows us to contact you (e-mail notifications, telephone calls, etc.) and personalize your user experience.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFourthFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourthFour" aria-expanded="true" aria-controls="collapseFourthFour">@lang('Who has access to my personal data?')</button>
                                    </h2>
                                    <div id="collapseFourthFour" class="accordion-collapse collapse" aria-labelledby="headingFourthFour" data-bs-parent="#accordionFourth">
                                        <div class="accordion-body">
                                            @lang('Your information is accessible to the site administrator and other users with whom you interact.')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFourthFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourthFive" aria-expanded="true" aria-controls="collapseFourthFive">@lang('Can I disable my account?')</button>
                                    </h2>
                                    <div id="collapseFourthFive" class="accordion-collapse collapse" aria-labelledby="headingFourthFive" data-bs-parent="#accordionFourth">
                                        <div class="accordion-body">
                                            <p>
                                                @lang("Yes, you can deactivate your account") <i class="text-secondary">@lang('(if you have a paid subscription)')</i>. @lang("You can do this from your dashboard via the link") <i class="text-secondary">@lang('Account status')</i>. @lang("You'll be able to reactivate it whenever you like.")
                                            </p>
                                            <p>
                                                @lang("Note that the administrator can also deactivate your account if certain irregularities are detected. In this case, please contact the administrator for further details.")
                                            </p>
                                            <i class="text-secondary">@lang('You will no longer receive notifications if your account is disabled.')</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h4 class="wow fadeInUp" data-wow-delay="0.1s">@lang('Jobs')</h4>
                        <div class="col-12 mb-5 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="accordion" id="accordionFive">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFiveOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiveOne" aria-expanded="true" aria-controls="collapseFiveOne">@lang('How can I view the various job offers?')</button>
                                    </h2>
                                    <div id="collapseFiveOne" class="accordion-collapse collapse" aria-labelledby="headingFiveOne" data-bs-parent="#accordionFive">
                                        <div class="accordion-body">
                                            @lang('You can do this when you are logged in. The different pages are:') <i><a href="{{ route('front.jobs.index') }}">@lang('Jobs')</a></i> @lang('and') <i><a href="{{ route('front.categories') }}">@lang('Categories')</a></i> @lang('(to see the list of offers for a specific category).')
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFiveTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiveTwo" aria-expanded="true" aria-controls="collapseFiveTwo">@lang('How can I apply for a job?')</button>
                                    </h2>
                                    <div id="collapseFiveTwo" class="accordion-collapse collapse" aria-labelledby="headingFiveTwo" data-bs-parent="#accordionFive">
                                        <div class="accordion-body">
                                            <p>
                                                <i class="text-secondary">@lang('Accessible only to Job Seeker users (Student, High School Student, Unemployed).')</i>
                                            </p>
                                            <p>
                                                @lang('Go to the page') <a href="{{ route('front.jobs.index') }}">@lang('Job offers')</a> @lang('and select the one that interests you. On the job details page, click on the button') <i class="text-secondary">@lang('Apply now')</i>.
                                            </p>
                                            <i class="text-secondary">@lang('This is done after logging in.')</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFiveThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiveThree" aria-expanded="true" aria-controls="collapseFiveThree">@lang("Can I see the job offers I've applied for?")</button>
                                    </h2>
                                    <div id="collapseFiveThree" class="accordion-collapse collapse" aria-labelledby="headingFiveThree" data-bs-parent="#accordionFive">
                                        <div class="accordion-body">
                                            @lang("Yes, it's possible to consult them if you have a paid subscription. You can access them from your dashboard.")
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFiveFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiveFour" aria-expanded="true" aria-controls="collapseFiveFour">@lang('Can I create a job offer?')</button>
                                    </h2>
                                    <div id="collapseFiveFour" class="accordion-collapse collapse" aria-labelledby="headingFiveFour" data-bs-parent="#accordionFive">
                                        <div class="accordion-body">
                                            @lang('Users with a company profile can submit a job offer') <a href="{{ route('front.jobs.create') }}">@lang('from this page')</a> @lang('(after logging in)').
                                            @lang('The administrator will decide whether or not to validate your offer. You will be informed by e-mail of the status of your offer.')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
                
            </div>
        </div>
    </div>
    <!-- FAQ End -->

@endsection

@push('css')
    <style>
        .page-header {
            background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url({{ asset('assets/front/img/faq.png') }}) center center no-repeat;
        }
    </style>
@endpush