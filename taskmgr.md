# Task Management Application

A modern, simple, and professional task management web application designed for small companies (20+ users). Built with React, Express, tRPC, and MySQL, this application provides an intuitive interface for managing tasks, assigning them to team members, and tracking progress.

## Quick Start

```bash
# Install dependencies
pnpm install

# Set up database
pnpm db:push

# Seed sample data (optional)
node scripts/seed.mjs

# Start development server
pnpm dev
```

Visit `http://localhost:3000` to access the application.

## Key Features

✅ **User Authentication** - Secure login with Manus OAuth
✅ **Task Management** - Full CRUD operations for tasks (admin only)
✅ **Task Assignment** - Assign tasks to multiple team members
✅ **Smart Filtering** - Filter by status and service area
✅ **Color-Coded Statuses** - Visual task status indicators
✅ **Dashboard** - Overview of assigned tasks with statistics
✅ **Responsive Design** - Works on desktop, tablet, and mobile
✅ **Role-Based Access** - Admin and regular user permissions
✅ **Type-Safe API** - tRPC for end-to-end type safety

## Technology Stack

| Layer | Technology |
|-------|-----------|
| Frontend | React 19 + Tailwind CSS 4 |
| Backend | Express 4 + tRPC 11 |
| Database | MySQL + Drizzle ORM |
| Authentication | Manus OAuth |
| Testing | Vitest |
| Build Tool | Vite |

## Project Structure

```
├── client/                    # React frontend
│   ├── src/pages/            # Page components
│   ├── src/components/       # Reusable components
│   └── src/lib/trpc.ts       # tRPC client
├── server/                    # Express backend
│   ├── routers/              # tRPC procedure definitions
│   └── db.ts                 # Database helpers
├── drizzle/                   # Database schema
│   ├── schema.ts             # Table definitions
│   └── migrations/           # Migration files
├── scripts/                   # Utility scripts
│   └── seed.mjs              # Database seeding
└── SETUP.md                   # Detailed setup guide
```

## Database Schema

The application uses four main tables:

**Users** - User accounts with OAuth integration
- id, openId, name, email, role, serviceId, timestamps

**Services** - Department/team groupings
- id, name, description, timestamps

**Tasks** - Individual tasks with metadata
- id, title, description, priority, status, dueDate, serviceId, createdById, timestamps

**Task_Users** - Many-to-many relationship for task assignments
- id, taskId, userId, assignedAt

## Task Statuses

- **Pending** (Yellow) - Waiting to be started
- **In Progress** (Blue) - Currently being worked on
- **Done** (Green) - Completed
- **Overdue** (Red) - Past due date

## Task Priorities

- **Low** - Can be done when time permits
- **Medium** - Should be done soon
- **High** - Urgent, needs immediate attention

## User Roles

### Admin
- Create and manage tasks
- Assign tasks to users
- Edit and delete tasks
- View all users

### Regular User
- View assigned tasks
- Filter and search tasks
- View task details
- Cannot create/edit/delete tasks

## API Procedures

All backend operations are exposed through tRPC procedures:

```typescript
// Task operations
tasks.list(filters?)           // Get user's tasks
tasks.getById(id)              // Get task details
tasks.create(data)             // Create task (admin)
tasks.update(id, data)         // Update task (admin)
tasks.delete(id)               // Delete task (admin)

// Metadata
tasks.getServices()            // Get all services
tasks.getUsers()               // Get all users (admin)

// Authentication
auth.me()                      // Get current user
auth.logout()                  // Log out
```

## Sample Data

The seeding script creates:
- 4 services (Engineering, Marketing, Sales, Operations)
- 8 tasks with various statuses and priorities
- Random user assignments

Run `node scripts/seed.mjs` after database setup to populate sample data.

## Development

### Running Tests
```bash
pnpm test
```

### Building for Production
```bash
pnpm build
pnpm start
```

### Code Quality
```bash
pnpm check      # TypeScript check
pnpm format     # Format code with Prettier
```

## Environment Variables

Required variables in `.env.local`:

```
DATABASE_URL=mysql://user:password@localhost:3306/database
JWT_SECRET=your-secret-key
VITE_APP_ID=your-app-id
OAUTH_SERVER_URL=https://api.manus.im
VITE_OAUTH_PORTAL_URL=https://login.manus.im
```

See `SETUP.md` for complete environment variable documentation.

## Browser Support

- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- Optimistic UI updates for better responsiveness
- Efficient database queries with proper indexing
- Frontend caching via tRPC
- Responsive images and lazy loading
- Minimal bundle size with tree-shaking

## Security

- OAuth 2.0 authentication
- Role-based access control
- Input validation and sanitization
- SQL injection prevention via ORM
- HTTPS in production
- Secure session management

## Troubleshooting

**Database connection failed?**
- Verify MySQL is running
- Check DATABASE_URL format
- Ensure database exists

**Port 3000 already in use?**
- Use `PORT=3001 pnpm dev` to change port
- Or kill existing process: `lsof -ti:3000 | xargs kill -9`

**Tests failing?**
- Ensure database is running
- Run `pnpm db:push` to create tables
- Check environment variables

See `SETUP.md` for more troubleshooting tips.

## Future Roadmap

- Task comments and activity timeline
- File attachments
- Email notifications
- Advanced search and filtering
- Task templates
- Recurring tasks
- Team collaboration features
- Mobile app
- Dark mode theme

## Contributing

This is a proprietary project. For internal contributions, please follow the existing code style and add tests for new features.

## Support

For issues or questions, contact the development team.

## License

Proprietary - All rights reserved

---

**Built with ❤️ for efficient task management**
