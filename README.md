# Realtime Notification Project

This project demonstrates the implementation of realtime notifications in a Laravel application. When a user creates a new post, the admin receives a realtime notification, can review the post, and approve or reject it. The user is then notified in realtime about the status of their post.

---

## Table of Contents
1. [General Information](#general-information)  
2. [Technologies Used](#technologies-used)  
3. [Project Status](#project-status)  
4. [Installation Guide](#installation-guide)

---

## General Information
The purpose of this project is to practice implementing realtime notifications and interactivity in a Laravel application. The primary functionality includes:  
- Users creating new posts.  
- Admins receiving realtime notifications about new posts.  
- Admins approving or rejecting posts.  
- Users being notified in realtime about the post's status.  

---

## Technologies Used
This project utilizes the following technologies:  
- **Laravel 11**  
- **Inertia 2**  
- **Vue.js**  
- **Tailwind CSS**  
- **Laravel Reverb Websocket**  
- **Laravel Echo with Pusher.js**

---

## Project Status
**Current Status:** In Progress  

---

## Installation Guide
Follow these steps to install and run the project locally:  

1. Clone the repository:  
   ```bash
   git clone <repository-url>
   ```

2. Navigate to the project directory:  
   ```bash
   cd <project-directory>
   ```

3. Copy the example environment file:  
   ```bash
   cp .env.example .env
   ```

4. Install PHP dependencies:  
   ```bash
   composer install
   ```

5. Generate the application key:  
   ```bash
   php artisan key:generate
   ```

6. Install JavaScript dependencies:  
   ```bash
   npm install
   ```

7. Set up the database:  
   ```bash
   touch database/database.sqlite
   ```

8. Link the storage directory:  
   ```bash
   php artisan storage:link
   ```

9. Run migrations and seed the database:  
   ```bash
   php artisan migrate:fresh --seed
   ```

10. Install Reverb Websocket:  
    ```bash
    php artisan reverb:install
    ```

11. Start the development server:  
    ```bash
    php artisan serve
    ```

12. Start the queue worker:  
    ```bash
    php artisan queue:work
    ```

13. Start the Reverb Websocket:  
    ```bash
    php artisan reverb:start
    ```

14. Compile frontend assets:  
    ```bash
    npm run dev
    ```

15. Access the application:  
    - **User Dashboard:**  
      Open [localhost/user](http://localhost/user)  
      - Email: `user@test.com`  
      - Password: `user`

    - **Admin Panel:**  
      Open [localhost/login](http://localhost/login)  
      - Email: `admin@test.com`  
      - Password: `admin`

16. Workflow:  
    - Log in as a user and create a new post.  
    - Open the admin panel in a separate browser to review the notification.  
    - Approve or reject the post, and the user will be notified about the action in realtime.
