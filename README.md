# Event Management System

This project is a web-based Event Management System built using PHP. It allows users to manage events efficiently, providing functionality for user authentication, event creation, and event registration. The system is designed to be responsive, ensuring it works well on different devices.

## Features

### User Authentication
- **Login and Registration**: Users can create an account and log in using their credentials.
- **Password Management**: Users can reset their password via the password recovery system.
  
### Event Management
- **Event Creation (Admin)**: Admin users can create, update, and delete events.
- **Event Listing**: All users can view a list of available events, which are dynamically fetched from the database.
  
### Event Registration
- **User Registration for Events**: Logged-in users can register for events.
- **View Registered Events**: Users can view the events they have registered for and get details about the venue, date, and time.

### Responsive Design
- **Custom CSS**: The frontend uses CSS to ensure a clean and responsive design for desktop and mobile devices.

## Project Structure

Below is a breakdown of the key files and directories in the project:

- `index.php`: The main page where users can view available events or log in.
- `base/`: Contains reusable layout files:
  - `header.php`: The common header included on each page.
  - `footer.php`: The common footer included on each page.
- `log/`: Contains user authentication scripts:
  - `login.php`: Handles user login.
  - `register.php`: Handles user registration.
  - `logout.php`: Logs the user out.
  - `password.php`: Manages password recovery and reset.
- `pages/`: Contains individual pages for events and the homepage:
  - `home.php`: The homepage that displays events.
  - `event_0.php`, `event_1.php`, etc.: Pages for specific events.
- `config/`: Configuration files:
  - `config.php`: Database connection settings.
- `css/`: Stylesheets for the frontend:
  - `style.css`: Main stylesheet for the site.
  - `style_log.css`: Stylesheet for login and registration pages.
- `sql/`: SQL scripts for database setup:
  - `sql_user.txt`: SQL commands to set up user-related tables.
  - `sql_testevent.txt`: SQL commands to set up event-related tables.

## Prerequisites

To run this project, you need:

- A web server like Apache (XAMPP, WAMP, MAMP, or any LAMP stack).
- PHP 7.4 or higher.
- MySQL or MariaDB database.
- A modern web browser for testing the interface.

## Installation

### Step 1: Clone the Repository
Clone the project from the repository to your local machine:
```bash
git clone <repository-url>
```

### Step 2: Database Setup
1. Launch MySQL on your server (e.g., through phpMyAdmin or MySQL CLI).
2. Create a new database for the Event Management System.
3. Import the SQL files located in the `sql/` folder:
   - `sql_user.txt`: Creates the necessary tables for user management.
   - `sql_testevent.txt`: Creates tables related to event management.

You can import these files using a tool like phpMyAdmin or via the command line:

```bash
mysql -u username -p database_name < sql/sql_user.txt
mysql -u username -p database_name < sql/sql_testevent.txt
```

### Step 3: Configure Database Connection
Update the database credentials in the `config/config.php` file to match your server setup:

```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_database_username');
define('DB_PASSWORD', 'your_database_password');
define('DB_DATABASE', 'event_management_db');
```

### Step 4: Run the Application
1. Place the project files in your web server's root directory (e.g., `htdocs` for XAMPP or `www` for WAMP).
2. Start your Apache server.
3. Access the application via your web browser at `http://localhost/event-management` (or wherever you hosted it).

## Usage

### User Workflow

1. **Registration**: New users can sign up via the registration page.
2. **Login**: Registered users can log in using their credentials.
3. **Browse Events**: After logging in, users can view available events on the homepage.
4. **Event Registration**: Users can click on an event to view details and register for it.
5. **View Registered Events**: Users can view the events they have registered for by visiting their profile or the relevant page.

### Admin Workflow

1. **Login as Admin**: Admin users have elevated permissions.
2. **Create or Edit Events**: Admins can access the event management panel to create, update, or delete events.
3. **Manage Users**: Admins can view and manage registered users (optional feature, depending on future implementation).

## Database Schema

The database consists of two main parts:

1. **User Table**: Manages user details such as username, password, email, etc.
2. **Event Tables**: Stores information about the events, including:
   - Event name, date, and description.
   - User registrations for each event.

The SQL scripts in the `sql/` folder automatically create these tables for you.

## Styling and Frontend

The project uses custom CSS to provide a clean and responsive user interface. The main stylesheets are:
- `style.css`: Handles general styles for the website.
- `style_log.css`: Styles specific to the login and registration forms.

You can modify these CSS files to customize the look and feel of the site.

## Contributing

Contributions to the Event Management System are welcome! If you would like to contribute:
1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Submit a pull request with detailed descriptions of your changes.

Make sure to follow best practices for PHP development and ensure your code is well-documented.

## License

This project is licensed under the MIT License. For more information, see the [LICENSE](LICENSE) file.
