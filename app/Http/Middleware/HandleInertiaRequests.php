<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Notifications\NewPostCreated;
use Illuminate\Database\Eloquent\Collection;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'notifications' => $this->notifications()
        ];
    }

    private function notifications()
    {
        $notifications = auth()->user()?->notifications;
        
        if (!$notifications) {
            return null;
        }

        return $this->transformNotifications($notifications);
    }

    private function transformNotifications(Collection $notifications): array
    {
        $notificationsArr = [];

        if (!$notifications->isEmpty()) {
            foreach ($notifications as $notification) {
                if ($notification->type === NewPostCreated::class) {
                    $data['id'] = $notification->id;
                    $data['title'] = $notification->data['post_title'];
                    $data['date'] = Carbon::parse($notification->created_at)->diffForHumans();
                    $data['user'] = $notification->data['user_name'];
                    $notificationsArr[] = $data;
                }
            }
        }

        return $notificationsArr;
    }
}
