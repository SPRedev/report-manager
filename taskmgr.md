# Task Management Application

A complete, production-ready web-based task management application for small companies built with **Laravel**, **Inertia.js**, and **Vue 3**. This application features user authentication, task assignment, real-time notifications, file attachments, and a modern responsive UI built with Tailwind CSS.

## Features

- **User Authentication** with role-based access control (Admin/User)
- **Task Management** with create, read, update, and delete operations
- **Task Assignment** to multiple users with real-time notifications
- **Status Tracking** with color-coded statuses (Pending, In Progress, Done, Overdue)
- **Priority Levels** (Low, Medium, High)
- **File Attachments** for tasks with secure storage
- **Real-time Notifications** using Laravel Echo and Pusher
- **Scheduled Commands** to automatically mark overdue tasks
- **Responsive Design** for mobile, tablet, and desktop
- **Department/Service Organization** for task categorization
- **Advanced Filtering** by status, priority, department, and search
- **Dashboard** with task statistics and recent activity

## Technology Stack

| Component | Technology |
|-----------|-----------|
| **Backend** | Laravel 11 (or latest) |
| **Frontend** | Vue 3 with Inertia.js |
| **Styling** | Tailwind CSS 4 |
| **Real-time** | Laravel Echo + Pusher (or Laravel WebSockets) |
| **Database** | MySQL/PostgreSQL |
| **File Storage** | Laravel Storage (local or S3) |
| **Authentication** | Laravel Breeze (Inertia version) |
| **Build Tool** | Vite |

## Project Structure

```
laravel-task-management/
├── app/
│   ├── Broadcasting/          # Broadcasting channels
│   ├── Console/Commands/      # Scheduled commands
│   ├── Events/                # Broadcastable events
│   ├── Http/
│   │   ├── Controllers/       # Request handlers
│   │   ├── Requests/          # Form validation
│   │   └── Middleware/        # HTTP middleware
│   ├── Listeners/             # Event listeners
│   └── Models/                # Eloquent models
├── database/
│   ├── migrations/            # Database schema
│   └── seeders/               # Sample data
├── resources/
│   ├── js/
│   │   ├── Pages/             # Vue page components
│   │   ├── Components/        # Reusable components
│   │   ├── app.js             # Application entry
│   │   └── echo.js            # Real-time setup
│   ├── css/                   # Stylesheets
│   └── views/
│       └── app.blade.php      # Main layout
├── routes/
│   ├── web.php                # Web routes
│   ├── channels.php           # Broadcasting channels
│   └── console.php            # Console commands
├── config/
│   ├── broadcasting.php       # Broadcasting config
│   ├── filesystems.php        # Storage config
│   └── ...                    # Other configs
├── .env.example               # Environment template
├── composer.json              # PHP dependencies
├── package.json               # Node dependencies
├── vite.config.js             # Vite configuration
├── tailwind.config.js         # Tailwind configuration
└── README.md                  # This file
```

## Installation & Setup

### Prerequisites

- **PHP** 8.2 or higher
- **Node.js** 18.0 or higher
- **Composer** (PHP dependency manager)
- **npm** or **yarn** (Node package manager)
- **MySQL** 8.0+ or **PostgreSQL** 12+
- **Git**

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-task-management.git
cd laravel-task-management
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Node Dependencies

```bash
npm install
# or
yarn install
```

### Step 4: Environment Configuration

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure:

```env
APP_NAME="Task Management App"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=

# Broadcasting (Pusher or Laravel WebSockets)
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=us2

# Frontend Pusher Configuration
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Step 5: Create Database

```bash
# Create a new database in MySQL
mysql -u root -p
CREATE DATABASE task_management;
EXIT;
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

### Step 7: Seed Demo Data

```bash
php artisan db:seed
```

This will create:
- 1 admin user (admin@example.com / password)
- 10 regular users
- 5 services/departments
- 10 sample tasks

### Step 8: Install Laravel Breeze (Authentication)

If not already installed:

```bash
composer require laravel/breeze --dev
php artisan breeze:install --inertia
npm install
```

### Step 9: Build Frontend Assets

```bash
npm run build
# or for development with hot reload:
npm run dev
```

### Step 10: Start Development Server

In one terminal, start the Laravel development server:

```bash
php artisan serve
```

In another terminal, start the Vite development server (if not using `npm run dev`):

```bash
npm run dev
```

The application will be available at `http://localhost:8000`

### Step 11: Configure Real-time Notifications (Optional)

#### Option A: Using Pusher

1. Create a free account at [Pusher.com](https://pusher.com)
2. Create a new app and copy your credentials
3. Add them to your `.env` file
4. Update `config/broadcasting.php` to use Pusher

#### Option B: Using Laravel WebSockets

```bash
composer require beyondcode/laravel-websockets
php artisan websockets:install
```

Update `.env`:

```env
BROADCAST_DRIVER=websockets
```

Start the WebSocket server:

```bash
php artisan websockets:serve
```

## Usage

### Login

1. Navigate to `http://localhost:8000`
2. Click "Login"
3. Use one of the demo credentials:
   - **Admin:** admin@example.com / password
   - **User:** john@example.com / password

### Create a Task (Admin Only)

1. Click "Create Task" in the sidebar
2. Fill in task details (title, description, due date, priority)
3. Select assignees from the user list
4. Optionally upload attachments
5. Click "Create Task"

### View Tasks

1. Click "My Tasks" to see all tasks assigned to you
2. Use filters to search by status, priority, or department
3. Click on a task to view details

### Update Task Status

1. Open a task detail page
2. Click "Edit"
3. Change the status and click "Update Task"
4. All assignees will receive a notification

### Manage Notifications

1. Click the bell icon in the navbar
2. View all notifications
3. Click "Mark as read" to mark individual notifications
4. Click "Mark all as read" to clear all notifications

## Scheduled Tasks

The application includes a scheduled command to automatically mark tasks as overdue. To enable this:

### Development Environment

Run the scheduler in a separate terminal:

```bash
php artisan schedule:work
```

### Production Environment

Add a cron job to your server:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

This will run the `tasks:mark-overdue` command every hour.

## Real-time Features

### Broadcasting Events

The application broadcasts the following events:

| Event | Channel | Purpose |
|-------|---------|---------|
| `TaskCreated` | `tasks` | Notify all users when a new task is created |
| `TaskUpdated` | `task.{id}` | Notify users when a task is updated |
| `TaskAssigned` | `user.{id}` | Notify specific users when assigned a task |
| `TaskMarkedOverdue` | `user.{id}` | Notify users when their task becomes overdue |

### Listening to Events (Frontend)

In Vue components, listen to real-time events:

```javascript
// Listen to task updates
window.Echo.channel('tasks')
    .listen('TaskCreated', (data) => {
        console.log('New task created:', data)
        // Update UI
    })

// Listen to personal notifications
window.Echo.private(`user.${userId}`)
    .listen('TaskAssigned', (data) => {
        console.log('Task assigned to you:', data)
        // Show notification
    })
```

## File Uploads

Files are stored in `storage/app/public/tasks/{task_id}/`. To make them accessible via the web:

```bash
php artisan storage:link
```

This creates a symlink from `public/storage` to `storage/app/public`.

## Authentication & Authorization

### Models

- **User** - Authenticated users with roles (admin/user)
- **Task** - Tasks created by admins, assigned to users
- **Service** - Departments/teams for task organization

### Policies

Task policies are defined in `app/Policies/TaskPolicy.php`:

- **view** - Any authenticated user can view tasks assigned to them
- **create** - Only admins can create tasks
- **update** - Only admins or task creator can update
- **delete** - Only admins or task creator can delete

## API Routes

The application uses Inertia.js, so there are no separate API endpoints. All data is passed through Inertia responses. However, you can add API routes if needed:

```php
// routes/api.php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    // ... more routes
});
```

## Testing

Run tests with PHPUnit:

```bash
php artisan test
```

Example test files are provided in `tests/Feature/` and `tests/Unit/`.

## Deployment

### Prepare for Production

1. **Update environment variables:**

```bash
cp .env.example .env.production
# Edit .env.production with production values
```

2. **Build frontend assets:**

```bash
npm run build
```

3. **Run migrations:**

```bash
php artisan migrate --force
```

4. **Seed production data (if needed):**

```bash
php artisan db:seed --force
```

### Deploy to Server

**Using Laravel Forge (Recommended):**

1. Create a new server on Laravel Forge
2. Connect your GitHub repository
3. Configure environment variables
4. Deploy

**Manual Deployment:**

1. Clone repository on server
2. Install dependencies: `composer install --no-dev`
3. Install Node dependencies: `npm install`
4. Build assets: `npm run build`
5. Set up environment variables
6. Run migrations: `php artisan migrate --force`
7. Configure web server (Nginx/Apache)
8. Set up SSL certificate (Let's Encrypt)
9. Configure cron job for scheduler
10. Set up WebSocket server (if using Pusher or Laravel WebSockets)

### Web Server Configuration (Nginx)

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/laravel-task-management/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Troubleshooting

### "SQLSTATE[HY000]: General error: 1030 Got error 28 from storage engine"

This usually means your database storage is full. Free up space or increase database storage.

### WebSocket Connection Fails

1. Ensure Pusher credentials are correct in `.env`
2. Check firewall rules allow WebSocket connections
3. Verify VITE_PUSHER_* variables are set correctly

### Tasks Not Broadcasting

1. Ensure `BROADCAST_DRIVER` is set to `pusher` or `websockets`
2. Check that events are being dispatched: `broadcast(new TaskCreated($task))`
3. Verify channels are properly registered in `routes/channels.php`

### File Uploads Not Working

1. Ensure `storage/app/public` directory is writable: `chmod -R 755 storage`
2. Run `php artisan storage:link` to create the symlink
3. Check file size limits in `php.ini` and `.env`

### Scheduled Tasks Not Running

1. Verify cron job is set up correctly
2. Check that `php artisan schedule:run` completes without errors
3. Review Laravel logs in `storage/logs/`

## Performance Optimization

### Caching

Enable query caching:

```php
// config/cache.php
'default' => env('CACHE_DRIVER', 'redis'),
```

### Database Optimization

Add indexes to frequently queried columns:

```php
// In migration
$table->index('status');
$table->index('due_date');
$table->index('created_by');
```

### Frontend Optimization

- Enable gzip compression
- Minify CSS and JavaScript
- Use lazy loading for images
- Implement pagination for large datasets

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-source software licensed under the MIT license.

## Support

For issues, questions, or suggestions, please open an issue on GitHub or contact the development team.

## Changelog

### Version 1.0.0 (Initial Release)

- Complete task management system
- User authentication with roles
- Real-time notifications
- File attachment support
- Responsive design
- Scheduled overdue task marking

## Future Enhancements

- [ ] Task templates
- [ ] Recurring tasks
- [ ] Task comments and collaboration
- [ ] Advanced reporting and analytics
- [ ] Mobile app (React Native)
- [ ] API documentation (OpenAPI/Swagger)
- [ ] Two-factor authentication
- [ ] Email notifications
- [ ] Task history and audit logs
- [ ] Custom fields and metadata

## Credits

Built with ❤️ using Laravel, Vue 3, and Tailwind CSS.

---

**Happy task managing!** 🚀
