## About SIMADA

SIMADA adalah Aplikasi Sistem Management Dokumen yang menyimpan serta mengelola dokumen Pada Fase SPTT tiap Projek

**Framework**: Laravel 12.26.4
**PHP Version**: >= 8.2
**Database**: SQLite (default), MySQL/MariaDB/PostgreSQL supported
**Last Updated**: September 2025

## Recent Updates

### Laravel Upgrade (2025)
- ✅ Upgraded from Laravel 5.3 to Laravel 12.26.4
- ✅ Updated PHP requirement to >= 8.2
- ✅ Migrated models to `app/Models/` namespace
- ✅ Updated authentication system
- ✅ Fixed Blade template syntax issues
- ✅ Database migrations and seeders updated

## Installation

### Prerequisites
- PHP >= 8.2
- Composer
- SQLite (default) or MySQL/MariaDB/PostgreSQL

### Local Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/teguh2910/simada.git
   cd simada
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up database:
   ```bash
   # For SQLite (default):
   touch database/database.sqlite

   # Or configure MySQL in .env file
   ```

5. Run migrations and seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Set proper permissions:
   ```bash
   chown -R www-data:www-data storage bootstrap/cache
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

## Features

- 📄 **Document Management**: Store and manage documents for SPTT phase projects
- 👥 **User Authentication**: Multi-user system with role-based access
- 📊 **Dashboard**: Overview of project status and documents
- 📁 **File Upload**: Secure document upload and storage
- 💬 **Feedback System**: Collaborative feedback on documents
- 📅 **Deadline Tracking**: Monitor project deadlines and overdue items
- 🏢 **Department Management**: Support for multiple departments (MIM, NPL, QA, OMD, ENG)

## Project Structure

```
simada/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/Controllers/ # Controllers
│   └── Exceptions/      # Exception handlers
├── database/
│   ├── migrations/      # Database migrations
│   └── seeds/          # Database seeders
├── resources/
│   └── views/          # Blade templates
├── routes/             # Route definitions
├── storage/            # File storage
└── public/             # Public assets
```

## Contributing

Thank you for considering contributing to the SIMADA Project!

### Development Setup
1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Make your changes and test thoroughly
4. Commit your changes: `git commit -am 'Add some feature'`
5. Push to the branch: `git push origin feature/your-feature-name`
6. Submit a pull request

### Code Style
- Follow PSR-12 coding standards
- Use meaningful commit messages
- Add tests for new features
- Update documentation as needed

## Security Vulnerabilities

If you discover a security vulnerability within SIMADA, please send an e-mail to Teguh Yuhono at teguh.yuhono@student.unsia.ac.id. All security vulnerabilities will be promptly addressed.

### Security Best Practices
- Keep dependencies updated
- Use HTTPS in production
- Implement proper authentication and authorization
- Regularly backup database
- Monitor logs for suspicious activities

## License

The SIMADA is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Support

For support and questions:
- 📧 Email: teguh.yuhono@student.unsia.ac.id
- 🐛 Issues: [GitHub Issues](https://github.com/teguh2910/simada/issues)
- 📖 Documentation: This README and inline code comments
