<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
use App\Models\Ticket;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function getStatistics()
  {
    try{
      $currentMonth = Carbon::now()->startOfMonth();
      $endOfMonth = $currentMonth->copy()->endOfMonth();

      $totalTickets = Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])->count();
      $activeTickets =  Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                                ->where('status', 'resolved')->count();

      $resolvedTickets = Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                                ->where('status', 'resolved')->count();
      $avgResolutionTime = Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                                ->where('status', 'resolved')
                                ->whereNotNull('completed_at')
                                ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, completed_at)) as avg_time'))
                                ->value('avg_time') ?? 0;
      $statusDistribution = [
        'open' => Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                        ->where('status', 'open')->count(),
        'onprogress' => Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                              ->where('status', 'onprogress')->count(),
        'resolved' => Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                            ->where('status', 'resolved')->count(),
        'rejected' => Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth])
                            ->where('status', 'rejected')->count(),
      ];

      $dashboardData = [
        'totalTickets' => $totalTickets,
        'activeTickets' => $activeTickets,
        'resolvedTickets' => $resolvedTickets,
        'avgResolutionTime' => $avgResolutionTime,
        'statusDistribution' => $statusDistribution
      ];

      return response()->json([
        'message' => 'selamat datang admin.',
        'data' => new DashboardResource($dashboardData)
      ]);
    } catch (Exception $e){
      return response([
        'message' => 'terjadi kesalahan.',
        'error' => $e->getMessage(),
      ], 404);
    }
  }
}
