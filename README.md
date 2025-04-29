# Clothes E-commerce Website

A modern e-commerce website for selling clothes with user authentication and admin panel.

## Features

- User authentication (login/register)
- Product catalog with images
- Admin panel for managing products
- Responsive design
- Dark/Light theme toggle

## Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Swiper.js (for product carousel)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/Clothes-website-main.git
```

2. Set up the database:
   - Import the database schema from `database/schema.sql`
   - Configure database connection in `config/database.php`

3. Configure your web server:
   - Point your web server to the project directory
   - Ensure PHP and MySQL are installed and running

4. Access the website:
   - Main store: `http://localhost/Clothes-website-main`
   - Admin panel: `http://localhost/Clothes-website-main/admin`

## Project Structure

```
Clothes-website-main/
├── admin/              # Admin panel files
├── start/              # Authentication system
├── img/                # Product images
├── css/                # Stylesheets
├── js/                 # JavaScript files
├── database/           # Database schema and setup
└── config/             # Configuration files
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details. 