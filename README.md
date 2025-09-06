<p align="center"><img src="{{ Vite::asset('resources/images/fondo.png') }}" width="400" alt="Recipes Logo">Recipes</p>

## Recipe Management

Recipe Manager is a Laravel application styled with Tailwind CSS. It allows users to create, edit, and delete recipes and ingredients, while also browsing recipes shared by others for cooking inspiration. The app includes filtering options by diet type (vegan, vegetarian, omnivore) and by ingredient category, making it easy to discover meals that fit your preferences.

## Architecture

This application follows a clean, multi-layered architecture to ensure a strong separation of concerns, making the codebase scalable, maintainable, and easy to test.

-   **Controllers (`app/Http/Controllers`):** Act as the entry point for HTTP requests. Their sole responsibility is to orchestrate the flow of data, calling the appropriate services and returning an HTTP response. They contain no business logic.
-   **Service Layer (`app/Services`):** This is the core of the application's business logic. 
-   **Form Requests (`app/Http/Requests`):** Handle all validation and authorization logic for incoming requests. This keeps the controllers clean and focused, as the request is already validated and authorized before it even reaches the controller's method.
-   **Policies (`app/Policies`):** Define the authorization rules for specific models. This provides a granular and centralized way to manage user permissions.
-   **Eloquent Models (`app/Models`):** Represent the data layer, managing the interaction with the database.

This structure ensures that each part of the application has a single, well-defined responsibility.

## Technologies Used

-Backend: [Laravel 11, PHP 8.2]
-Frontend: [Tailwind CSS, Alpine.js]
-Database: [MySQL]
-Development Tools: [Vite, Composer, NPM]

## Installation and Setup

Follow these steps to get the project up and running on your local machine.

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- A database server

### 1. Clone the Repository

```bash
git clone https://github.com/Antonia90/4.1-Laravel
cd 4.1-Laravel
```

### 2. Install Dependencies

Install both PHP and JavaScript dependencies.

```bash
composer install
npm install
```

### 3. Environment Configuration

Create your local environment file and generate the application key.

```bash
cp .env.example .env
php artisan key:generate
```

Next, open the `.env` file and configure your database connection details (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

### 4. Database Migration and Seeding

Run the database migrations to create the tables and the seeders to populate the database with demo data (admin user, regular user).

```bash
php artisan migrate:fresh --seed
```

### 5. Storage Link

Create the symbolic link to make uploaded images publicly accessible.

```bash
php artisan storage:link
```

### 6. Build Assets and Run the Server

Finally, build the frontend assets and start the local development server.

```bash
npm run build
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`.

---

## License

The Recipe Management is open-sourced software licensed under the [MIT license].
