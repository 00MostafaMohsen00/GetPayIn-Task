# Laravel VueJS InertiaJS Project

## Overview

This project is a full-stack web application built using Laravel, VueJS, and InertiaJS. It leverages the power of Laravel for backend logic and VueJS with InertiaJS for a modern, single-page application (SPA) experience.

## Technologies Used

-   **Laravel**: Backend framework for RESTful APIs and server-side logic.
-   **VueJS**: Frontend framework for creating reactive UI components.
-   **InertiaJS**: Facilitates seamless server-driven navigation without full page reloads.
-   **Vite**: Lightning-fast development server and build tool.
-   **TailwindCSS**: Utility-first CSS framework for styling.
-   **Axios**: For making HTTP requests from the frontend.
-   **Multiselect**: Advanced dropdowns and multi-selection capabilities.

## Installation

### Clone the Repository

```bash
git clone https://github.com/your-repo/laravel-vue-inertia.git
cd laravel-vue-inertia
```

### Install Backend Dependencies

```bash
composer install
```

### Install Frontend Dependencies

```bash
npm install
```

### Copy Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Storage Link For images

```bash
php artisan storage:link
```

### Set Up Database

Update your `.env` file with your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Run Migrations

```bash
php artisan migrate --seed
```

### Set Up Frontend

```bash
npm run build
```

### Development Server

```bash
php artisan serve --host=0.0.0.0 --port=8000
npm run dev
```

## Running the Application

Access the application via:

```
http://localhost:8000
```

## Folder Structure

-   **app/**: Contains the backend logic and models.
-   **resources/js/**: Contains Vue components and frontend logic.
-   **routes/**: Defines API and web routes.
-   **database/**: Contains migrations and seeders.
-   **public/**: Public assets and compiled files.

## Frontend Configuration

### Adding Vue Components

Components are located in `resources/js/Components`. To add a new component:

1. Create a `.vue` file in the Components folder.
2. Register it in `app.js`.

### Using Multiselect

We use `vue-multiselect` for advanced dropdowns:

```bash
npm install vue-multiselect
```

Example usage:

```vue
<Multiselect
    v-model="selected"
    :options="options"
    :multiple="true"
    placeholder="Select an option"
/>
```

## Deployment

### Build for Production

```bash
npm run build
```

### Run Production Server

```bash
php artisan serve
```

## Troubleshooting

### CORS Issues

Configure your CORS settings in `config/cors.php` to allow your frontend to communicate with your backend.

### Common Errors

-   **Missing Packages**: Run `npm install` and `composer install` to ensure all dependencies are present.
-   **Database Errors**: Make sure your `.env` file is correctly configured and that your database is running.

## License

This project is licensed under the MIT License.
