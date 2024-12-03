<?php

namespace App\Http\Controllers;

use App\Http\Resources\SyncResource;
use App\Models\SyncLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Classes\ApiResponse;

class SyncController extends Controller
{
    public function saveEndpoint(Request $request)
    {
        $request->validate([
            'endpoint_url' => 'required|string',
            'api_key' => 'required|string',
        ]);

        $log = SyncLog::create([
            'endpoint_url' => $request->input('endpoint_url'),
            'api_key' => $request->input('api_key'),
            'status' => 'in_progress',
            'sync_time' => now(),
        ]);

        return ApiResponse::success(new SyncResource($log), 'Sync configuration saved successfully');
    }

    public function syncNow()
    {
        $logs = SyncLog::where('status', 'in_progress')->orderBy('sync_time', 'asc')->get();

        if ($logs->isEmpty()) {
            return ApiResponse::error('No pending sync configurations found', 400);
        }

        $results = [];

        foreach ($logs as $log) {
            try {
                $response = Http::get($log->endpoint_url);

                if ($response->successful()) {
                    $log->update([
                        'status' => 'success',
                        'message' => 'Data synced successfully',
                        'sync_time' => now(),
                    ]);
                } else {
                    $log->update([
                        'status' => 'failure',
                        'message' => 'Failed to sync data: ' . $response->body(),
                        'sync_time' => now(),
                    ]);
                }

                $results[] = new SyncResource($log);
            } catch (\Exception $e) {
                $log->update([
                    'status' => 'failure',
                    'message' => 'Error during sync: ' . $e->getMessage(),
                    'sync_time' => now(),
                ]);

                $results[] = new SyncResource($log);
            }
        }

        return ApiResponse::success($results, 'Sync process completed for all pending configurations');
    }


    public function getLogs()
    {
        try {
            $logs = SyncLog::orderBy('sync_time', 'desc')->paginate(10);

            return ApiResponse::success(
                [
                    'data' => SyncResource::collection($logs->items()),
                    'pagination' => [
                        'current_page' => $logs->currentPage(),
                        'last_page' => $logs->lastPage(),
                        'per_page' => $logs->perPage(),
                        'total' => $logs->total(),
                    ],
                ],
                'Logs retrieved successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Failed to retrieve logs',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }

}
