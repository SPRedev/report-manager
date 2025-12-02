# Task Manager Application

This is a complete web-based task management application built with a **Flutter Web** frontend and a **Laravel API** backend, as requested.

## Project Structure

The project is split into two main directories:

| Directory | Technology | Description |
| :--- | :--- | :--- |
| `backend/` | Laravel (PHP) | The RESTful API backend, handling authentication, data persistence, and business logic. |
| `frontend/task_manager_frontend/` | Flutter (Dart) | The single-page application (SPA) frontend, targeting modern web browsers. |

## 1. Backend Setup (Laravel API)

The backend uses Laravel with **Sanctum** for API token authentication and **SQLite** for simple local development (easily swappable for MySQL/PostgreSQL).

### Prerequisites

*   PHP (>= 8.1)
*   Composer
*   SQLite (or MySQL/PostgreSQL if preferred, update `.env` accordingly)

### Installation

1.  **Navigate to the backend directory:**
    ```bash
    cd backend
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Configure Environment:**
    *   Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    *   **Note:** The `.env` file has been pre-configured to use SQLite for convenience.
    *   Generate the application key:
        ```bash
        php artisan key:generate
        ```

4.  **Database Setup:**
    *   Ensure the SQLite database file exists (it should have been created during setup):
        ```bash
        touch database/database.sqlite
        ```
    *   Run migrations and seed the database with initial data (Services, Admin User, Regular User):
        ```bash
        php artisan migrate:fresh --seed
        ```
    *   **Default Users:**
        | Role | Email | Password |
        | :--- | :--- | :--- |
        | Admin | `admin@task.com` | `password` |
        | User | `user@task.com` | `password` |

5.  **Start the API Server:**
    ```bash
    php artisan serve --port=8000
    ```
    The API will be running at `http://localhost:8000`.

### API Endpoints

| Method | Endpoint | Description | Authentication |
| :--- | :--- | :--- | :--- |
| `POST` | `/api/register` | Register a new user. | None |
| `POST` | `/api/login` | Authenticate and receive a JWT-like Sanctum token. | None |
| `POST` | `/api/logout` | Invalidate the current token. | Sanctum Token |
| `GET` | `/api/tasks` | List tasks (filterable by user/service/status). | Sanctum Token |
| `POST` | `/api/tasks` | Create a new task (Admin only). | Sanctum Token |
| `GET` | `/api/tasks/{id}` | Get task details. | Sanctum Token |
| `PUT` | `/api/tasks/{id}` | Update a task (Admin only). | Sanctum Token |
| `DELETE` | `/api/tasks/{id}` | Delete a task (Admin only). | Sanctum Token |
| `PATCH` | `/api/tasks/{id}/status` | Update task status (Assigned User/Admin). | Sanctum Token |
| `POST` | `/api/notifications` | Store the FCM token for the authenticated user. | Sanctum Token |

## 2. Frontend Setup (Flutter Web)

The frontend is a Flutter Web application designed to be responsive and use a modern UI (though a minimal UI is implemented for this example).

### Prerequisites

*   Flutter SDK (latest stable version)
*   Chrome or another modern web browser

### Installation

1.  **Navigate to the frontend project directory:**
    ```bash
    cd ../frontend/task_manager_frontend
    ```

2.  **Install Dart/Flutter dependencies:**
    ```bash
    flutter pub get
    ```

3.  **Firebase Cloud Messaging (FCM) Setup**

    For web push notifications to work, you must set up a Firebase project and replace the placeholders in the following files:

    *   `lib/firebase_options.dart`
    *   `web/firebase-messaging-sw.js`
    *   `lib/services/notification_service.dart` (for the `vapidKey`)

    **Steps:**
    1.  Create a new project in the [Firebase Console](https://console.firebase.google.com/).
    2.  Add a **Web App** to your project.
    3.  Copy the configuration object and update `lib/firebase_options.dart` and `web/firebase-messaging-sw.js`.
    4.  In Firebase **Project Settings** -> **Cloud Messaging** tab, generate a **VAPID key pair** and copy the public key.
    5.  Update the `vapidKey` placeholder in `lib/services/notification_service.dart`.

### Running the Web App

1.  **Ensure the Laravel API is running** (`php artisan serve --port=8000`).
2.  **Run the Flutter web app:**
    ```bash
    flutter run -d chrome
    ```
    This will build and launch the application in a Chrome browser window.

## 3. Key Implementation Details

### Flutter API Integration

The `lib/services/api_service.dart` file demonstrates how to handle JWT-like authentication with the Laravel backend using `shared_preferences` for token storage and `http` for requests.

```dart
// Example of JWT-like token handling in ApiService
Future<Map<String, dynamic>> get(String endpoint) async {
    final token = await _getToken();
    // ...
    final headers = {
      // ...
      'Authorization': 'Bearer $token', // Token is sent in the Authorization header
    };
    // ...
}
```

### Laravel Models and Migrations

The database structure is implemented as requested:

*   **Users**: Includes `service_id` and `role` (`admin`/`user`).
*   **Services**: Simple lookup table for departments.
*   **Tasks**: Stores task details, linked to the `created_by` user.
*   **Task_User** (Pivot Table): Handles the many-to-many relationship for task assignment to multiple users.

### Web Push Notifications (FCM)

The `lib/services/notification_service.dart` file handles:
1.  Firebase initialization for the web platform.
2.  Requesting notification permissions.
3.  Retrieving the FCM token.
4.  Sending the token to the Laravel backend via the `/api/notifications` endpoint.

The `web/firebase-messaging-sw.js` file is the service worker required by FCM to handle background notifications.

## 4. Deployment Instructions

### Backend Deployment

1.  Deploy the contents of the `backend/` directory to your PHP hosting environment (e.g., a VPS or a Laravel-specific host).
2.  Update the `.env` file with your production database credentials (MySQL/PostgreSQL) and set `APP_ENV=production` and `APP_URL` to your domain.
3.  Run `php artisan migrate --force` to set up the production database.
4.  Ensure your web server (e.g., Nginx or Apache) is configured to point to the `public` directory.

### Frontend Deployment

1.  **Build the Flutter Web app:**
    ```bash
    cd frontend/task_manager_frontend
    flutter build web
    ```
2.  The static files will be generated in the `build/web` directory.
3.  Deploy the contents of the `build/web` directory to any static file hosting service (e.g., Firebase Hosting, Netlify, Vercel, or a simple web server).
4.  **Important:** Ensure your hosting service is configured to serve the `index.html` file for all routes (a common requirement for SPAs).

---
*Author: Manus AI*
*Date: Dec 01, 2025*
