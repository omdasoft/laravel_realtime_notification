<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Events\NewPostCreatedEvent;
use App\Notifications\NewPostCreated;
use Illuminate\Database\Eloquent\Collection;

class NotificationService {
    public function notifyAdminOfNewPost(Post $post)
    {
        $admin = User::admin()->first();
        if ($admin) {
            $admin->notify(new NewPostCreated($post));
            $notification = $admin->unreadNotifications()->latest()->first();

            if ($notification) {
                $unreadNotification = $this->formatNotification($notification);
                NewPostCreatedEvent::dispatch($unreadNotification);
            }
        }
    }

    public function getUnreadNotificationsForAdmin(): array|null
    {
        $adminUser = User::admin()->with('unreadNotifications')->first();

        if (!$adminUser) {
            return null;
        }

        return $this->transformNotifications($adminUser->unreadNotifications);
    }

    private function transformNotifications(Collection $notifications): array
    {
        return $notifications->map(function ($notification) {
            return $this->formatNotification($notification);
        })->toArray();
    }

    private function formatNotification($notification): array
    {
        return [
            'id' => $notification->id,
            'title' => $notification->data['post_title'],
            'post_id' => $notification->data['post_id'],
            'date' => $notification->created_at->diffForHumans(),
            'user' => $notification->data['user_name'],
        ];
    }
}