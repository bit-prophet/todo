<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Pusher\PusherException;

class PusherAuthController extends Controller
{
    /**
     * @throws PusherException
     */
    public function authenticate(Request $request): Application|Response|JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $auth = $pusher->authorizeChannel($channelName, $socketId);

        return response($auth);
    }
}
