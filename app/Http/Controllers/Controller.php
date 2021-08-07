<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function activity(JsonRpcClient $client, Request $request)
    {
        $activity = $client->activityGet();
        return view('welcome', ['paginator' => new LengthAwarePaginator(
            $activity,
            count($activity),
            $request->query('per_page', 10),
            $request->query('page', 1))
        ]);
//        $client->activityGet();
    }
}
