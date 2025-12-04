# BCB Cricket Management System

A comprehensive web-based management system for the Bangladesh Cricket Board (BCB) built with PHP and MySQL. This application provides a centralized platform for managing cricket players, coaches, administrators, and match statistics across multiple formats.

## 🏏 Features

### Multi-Role Access System
- **Admin Dashboard**: Full system control including user verification, player/coach management, and statistics updates
- **Coach Portal**: Training management, player selection, statistics viewing, and point allocation
- **Head Coach Portal**: Enhanced privileges with additional squad management capabilities
- **Player Portal**: Personal profile viewing, statistics tracking, training schedules, and squad information

### Statistics Management
Track and manage player performance across three cricket formats:
- **Test Cricket**: Long-format match statistics
- **ODI (One Day International)**: Limited-overs match data
- **T20**: Twenty20 format statistics

Each format tracks:
- Series information
- Runs scored
- Wickets taken
- Player performance metrics

### User Management
- New user registration system
- Admin approval workflow for new accounts
- Role-based access control
- Email-based session management

### Additional Features
- Training schedule management
- Squad selection and management
- Help and complaint system with email notifications
- Player point allocation system

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or XAMPP/WAMP/MAMP

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mohammedayman03/bcb-cricket-management.git
   cd bcb-cricket-management
   ```

2. **Set up the database**
   - Create a MySQL database named `BCB`
   - Import the database schema (tables will be created based on the application structure)
   - Update database credentials in `Connection.php` if needed:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "BCB";
     ```

3. **Configure the web server**
   
   **Option A: Using PHP Built-in Server**
   ```bash
   php -S localhost:8000
   ```
   
   **Option B: Using XAMPP/WAMP**
   - Copy the project folder to your `htdocs` or `www` directory
   - Access via: `http://localhost/bcb-cricket-management/login.php`

4. **Access the application**
   - Navigate to `http://localhost:8000/login.php` (or appropriate URL)
   - Use admin credentials to access the system

## 📁 Project Structure

```
BCB PROJECT FILE/
├── login.php              # Main entry point and authentication
├── Connection.php         # Database configuration
├── admin_home.php         # Admin dashboard
├── coach_home.php         # Coach dashboard
├── Hcoach_home.php        # Head coach dashboard
├── player_home.php        # Player dashboard
├── test.php               # Test cricket statistics selection
├── odi.php                # ODI statistics selection
├── twenty_twenty.php      # T20 statistics selection
├── test_update.php        # Test statistics update handler
├── odi_update.php         # ODI statistics update handler
├── twenty_twenty_update.php # T20 statistics update handler
├── help.php               # Help and complaint system
├── coach_css.css          # Shared styling
├── login_css.css          # Login page styling
└── Cricket Stadium.jpg    # Background image
```

## 🗄️ Database Schema

### Main Tables
- `admin`: Administrator accounts and credentials
- `coach`: Coach profiles and authentication
- `player`: Player information and credentials
- `newuser`: Pending user registrations awaiting approval
- `squad`: Active team members
- `test`: Test cricket match statistics
- `odi`: ODI match statistics
- `twenty_twenty`: T20 match statistics

## 🔐 Security Features

- SQL injection prevention using `mysqli_real_escape_string()`
- Role-based access control with separate user tables
- Session management via email parameters
- Admin approval required for new user registrations

## 💻 Usage

### For Administrators
1. Log in with admin credentials
2. Verify new user registrations
3. Manage player and coach profiles
4. Update match statistics across all formats
5. Monitor system activities

### For Coaches
1. Access training management tools
2. Select players for squads
3. View and analyze player statistics
4. Allocate points to players
5. Head coaches have additional squad management options

### For Players
1. View personal profile and statistics
2. Check training schedules
3. View squad information
4. Track performance across formats

## 🛠️ Development

### Adding a New Cricket Format
1. Create a new database table following the existing format pattern
2. Add selection page (e.g., `format.php`)
3. Add update handler (e.g., `format_update.php`)
4. Add statistics view (e.g., `format_stat.php`)
5. Update navigation in relevant dashboard files

### File Naming Conventions
- Role-specific files: `[role]_[function].php`
- Statistics files: `[format]_[action].php`
- Update handlers: `[format]_update.php`

## 🧪 Testing

When testing the application:
- Test all three user roles (admin, coach, player)
- Verify statistics updates for all three cricket formats
- Test user registration and admin approval workflow
- Check head coach vs regular coach access differences
- Ensure proper email parameter passing across navigation

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 License

This project is available for educational and development purposes.

## 📧 Contact

For questions or support, please use the in-app help system or contact the development team.

---

**Note**: This is a cricket management system designed for the Bangladesh Cricket Board. Ensure all security measures are properly configured before deploying to a production environment.
