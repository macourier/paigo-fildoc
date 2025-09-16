<?php

namespace App\Http\Controllers;

use App\Models\Bulletin;
use App\Models\Salarie;
use App\Models\IASuggestion;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getPayslipStats(Request $request)
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        $month = now()->format('Y-m');

        $totalThisMonth = Bulletin::whereHas('salarie', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->whereYear('periode', now()->year)->whereMonth('periode', now()->month)->count();

        $totalAllTime = Bulletin::whereHas('salarie', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->count();

        return response()->json([
            'month' => $month,
            'total_this_month' => $totalThisMonth,
            'total_all_time' => $totalAllTime,
        ], 200);
    }

    public function getEmployeeStats(Request $request)
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        $activeThisMonth = Salarie::where('company_id', $companyId)
            ->whereHas('bulletins', function ($query) {
                $query->whereYear('periode', now()->year)->whereMonth('periode', now()->month);
            })
            ->count();

        $totalEmployees = Salarie::where('company_id', $companyId)->count();

        return response()->json([
            'active_this_month' => $activeThisMonth,
            'total_employees' => $totalEmployees,
        ], 200);
    }

    public function getSuggestions(Request $request)
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        $suggestions = IASuggestion::where('company_id', $companyId)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get(['label', 'action', 'payload']);

        return response()->json($suggestions, 200);
    }

    public function getSubscription(Request $request)
    {
        $user = Auth::user();
        $subscription = Subscription::where('company_id', $user->company_id)->first();

        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found'], 404);
        }

        $bulletinsUsed = Bulletin::whereHas('salarie', function ($query) use ($user) {
            $query->where('company_id', $user->company_id);
        })->whereYear('periode', now()->year)->whereMonth('periode', now()->month)->count();

        return response()->json([
            'plan' => $subscription->plan_name,
            'bulletins_included' => $subscription->bulletins_quota,
            'bulletins_used' => $bulletinsUsed,
            'next_billing_date' => $subscription->next_billing_date,
            'price' => $subscription->price,
            'currency' => $subscription->currency,
        ], 200);
    }
}
