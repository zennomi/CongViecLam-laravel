<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Models\Earning;
use App\Models\Setting;
use App\Models\Candidate;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Location\Entities\Country;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }


    public function dashboard()
    {
        session(['layout_mode' => 'left_nav']);
        $jobs = Job::all();

        $data['all_jobs'] = $jobs->count();
        $data['active_jobs'] = $jobs->where('status', 1)->count();
        $data['expire_jobs'] = $jobs->where('status', 0)->count();
        $data['pending_jobs'] = $jobs->where('status', 2)->count();

        $data['verified_users'] = User::whereNotNull('email_verified_at')->count();
        $data['candidates'] = Candidate::all()->count();
        $data['companies'] = Company::all()->count();
        $data['earnings'] = currencyConversion(Earning::sum('usd_amount'), 'USD', config('jobpilot.currency'));
        $data['email_verification'] = setting('email_verification');

        $months = Earning::select(
            \DB::raw('MIN(created_at) AS created_at'),
            \DB::raw('sum(usd_amount) as `amount`'),
            \DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->startOfYear())
            ->orderBy('created_at')
            ->groupBy('month')
            ->get();


        $earnings = $this->formatEarnings($months);
        $latest_jobs = Job::with(['company', 'job_type', 'experience'])->latest()->get()->take(10);

        $popular_countries = DB::table('jobs')
            ->select('country', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('country')
            ->limit(10)
            ->get();

            $popular_countries;

        $latest_earnings = Earning::with('plan', 'manualPayment:id,name')->latest()->take(10)->get();

        $users = User::select(['id', 'name', 'email', 'role', 'status', 'email_verified_at', 'created_at', 'image', 'username'])->latest()->take(10)->get();

        return view('admin.index', compact('data', 'earnings', 'popular_countries', 'latest_jobs', 'latest_earnings', 'users'));
    }

    public function notificationRead()
    {

        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(true);
    }

    public function allNotifications()
    {

        $notifications = auth()->user()->notifications()->paginate(20);

        return view('admin.notifications', compact('notifications'));
    }

    private function formatEarnings(object $data)
    {
        $amountArray = [];
        $monthArray = [];

        foreach ($data as $value) {
            array_push($amountArray, $value->amount);
            array_push($monthArray, $value->month);
        }

        return ['amount' => $amountArray, 'months' => $monthArray];
    }

    public function downloadTransactionInvoice(Earning $transaction)
    {
        $data['transaction'] = $transaction->load('plan', 'company.user.contactInfo');

        $data['logo'] = Setting::first()->dark_logo_url;

        $pdf = PDF::loadView('website.pages.company.invoice', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download("invoice_" . $transaction->order_id . ".pdf");
    }
}
