<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\NewPostCreated;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }

    // public function notifications()
    // {
    //     $notifications = auth()->user()->notifications;
    //     $transformedNotifications = $this->transformNotifications($notifications);

    //     Inertia::share('notifications', $transformedNotifications);
    // }

    // private function transformNotifications(Collection $notifications): array
    // {
    //     $notificationsArr = [];

    //     if (!$notifications->isEmpty()) {
    //         foreach ($notifications as $notification) {
    //             if ($notification->type === NewPostCreated::class) {
    //                 $data['id'] = $notification->id;
    //                 $data['title'] = $notification->data['post_title'];
    //                 $data['date'] = Carbon::parse($notification->created_at)->diffForHumans();
    //                 $data['user'] = $notification->data['user_name'];
    //                 $notificationsArr[] = $data;
    //             }
    //         }
    //     }

    //     return $notificationsArr;
    // }
}
