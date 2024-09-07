## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Status](#status)

## General info
This project is created to practice realtime notification, So when user create a new post, the admin will see realtime notification about the post created, and can view the post and take an action to (approve/reject).
## Technologies
* Laravel 11
* Inertia 2
* Vue js 
* Tailwind CSS
* Laravel Reverb websocket
* Laravel Echo with Pusher Js

## Status
The project is: in progress

## How to Install the Project Locally
* clone the project
* cd inside the project
* run cp .env.example .env
* run php artisan key:generate
* run composer install
* run npm install
* touch database/database.sqlite
* run php artisan storage:link
* run php artisan migrate fresh:--seed
* run php artisan serve
* run php artisan queue:work to start the queue
* run php artisan reverb:start to start the reverb websocket
* run npm run dev
