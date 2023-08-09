<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Job;
use App\Models\User;
use App\Models\Pupil;
use App\Models\Company;
use App\Models\Student;
use Carbon\Traits\Date;
use App\Charts\PublishJob;
use App\Charts\Userglobal;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Charts\PublicationJob;
use App\Charts\activatedAccount;
use App\Charts\ActivationChart;
use App\Charts\SubscribersChart;
use App\Charts\SubscriptionsChart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Unemployed;

class StatisticsDataController extends Controller
{
    // function create()
    // {
    //     return view('admin.dashboard');
    // }
    function graph(Request $request)
    {
        // $request->validate([
        //     'startDate' => 'nullable|before:endDate|date',
        //     'endDate' => 'nullable|before_or_equal:now|date',
        // ]);

        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"
        ];



        // whereBetween('reservation_date',[$start, $end])
        // Number comparaison between
        $chart3 = new SubscriptionsChart;
        $chart3->loaderColor('#0133ff');
        $chart3->displaylegend(false);

        $chart3->title(trans('Subscribers'), 30, "rgb(255, 99, 132)", true, 'Helvetica Neue');
        $nameRole = [];
        $pupil = Pupil::count();
        $student = Student::count();
        $unemploymet = Unemployed::count();
        $company = Company::count();
        $chart3->labels([trans('Company'), trans('Student'), trans('Pupil'), trans('Unemployed')]);
        $chart3->dataset(' ', 'bar',  [$company, $student, $pupil, $unemploymet])->fill(true)->backgroundcolor('rgba(10,10,200,0.3)');


        // users by month
        $chart2 = new Userglobal;
        $dataSet = [];
        $nameMonth = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'july', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $startDate = new DateTime('2023-01-01');
        $endDate = now();
        for ($month = 1; $month < 13; $month++) {
            $subscribersGraph = User::query()
                ->whereMonth('created_at', $month . "")
                // ->whereBetween($startDate, $endDate)
                ->count();
            array_push($dataSet, $subscribersGraph);
        }
        $chart2->labels($nameMonth);
        $chart2->dataset(trans('Subscribers by month'), 'line',  $dataSet)->backgroundcolor(['cyan']);


        // differents subscriptions by month

        // activate and not subscriptions
        $activatedAccount = new activatedAccount;
        $dataSetActivated = [];
        $dataSetInactivated = [];
        $activatedAccount->loaderColor('#0133ff');
        $activatedAccount->title(trans('Subscriptions'), 30, "rgb(255, 99, 132)", true, 'Helvetica Neue');
        // $activatedAccount->displaylegend(false);
        $nameRole = [];
        foreach (Subscription::all() as $subscription) {
            array_push($nameRole, $subscription->name);
        }
        $activatedAccount->title(trans('Subscriptions'), 30, "rgb(255, 99, 132)", true, 'Helvetica Neue');
        for ($cpt = 1; $cpt < 6; $cpt++) {
            $SubscriptionsByRole = DB::table('subscription_user')
                                        ->where('subscription_id', $cpt)
                                        ->count();
            $activateSubscriptionsyRole = DB::table('subscription_user')
                                                ->whereNotNull('starts_at')
                                                ->where('subscription_id', $cpt)
                                                ->count();
            array_push($dataSetActivated, $activateSubscriptionsyRole);
            array_push($dataSetInactivated, $SubscriptionsByRole - $activateSubscriptionsyRole);
        }
        $activatedAccount->labels($nameRole);
        $activatedAccount->dataset(trans('Validated'), 'bar',  $dataSetActivated)->backgroundcolor('rgba(10,190,10,0.5)');
        $activatedAccount->dataset(trans('Not Validated yet'), 'line',  $dataSetInactivated)->backgroundcolor('rgba(190,10,10,0.5)')->fill(true);

        // job published and not
        $job = new PublicationJob();
        $job->title(trans('Jobs'), 30, "rgb(255, 99, 132)", true, 'Helvetica Neue');
        $allJob = Job::count();
        $activatedJob = Job::query()
                            ->whereNotNull('published_at')
                            ->count();
        $job->labels([trans('Not published yet'), trans('Published')]);
        $job->displayAxes(false)->dataset(trans('Jobs'), 'pie',  [$allJob - $activatedJob, $activatedJob])->backgroundcolor($fillColors);

        // chartJob with pie type (activated and not)
        $jobPie = new ActivationChart();
        $jobPie->title(trans('Subscription'), 30, "rgb(255, 99, 132)", true, 'Helvetica Neue');
        $suscribers = DB::table('subscription_user')
                          ->count();
        $activatedSuscribers = DB::table('subscription_user')
                                   ->whereNotNull('starts_at')
                                   ->count();
        $jobPie->labels([trans('Not activated yet'), trans('activated')]);
        $jobPie->displayAxes(false)->dataset(trans('activated'), 'doughnut',  [$suscribers - $activatedSuscribers, $activatedSuscribers])->backgroundcolor($borderColors);

        // calculate money
        $subscriptions = Subscription::all();
        $money = 0;
        foreach ($subscriptions as $subscription) {
            $subscribers = DB::table('subscription_user')
                                // ->whereNotNull('starts_at')
                                ->where('subscription_id', $subscription->id)
                                ->count();
            $money += $subscribers * $subscription->amount;
        }
        return view('admin.dashboard', [
            'subscriptionsAccount' => $activatedAccount,
            'ChartUserData' => $chart3,
            'usersChart' => $chart2,
            'Jobs' => $job,
            'subscriptions' => DB::table('subscription_user')->count(),
            'users' => User::count(),
            'CountJob' => Job::count(),
            'money' => $money,
            'JobPie' => $jobPie
        ]);
    }
}
