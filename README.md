# Todo App

## Requirements

- PHP version 8.1 or higher
- MySQL version 7 or higher

## Installation

### First Steps

1. Clone the repository:

    ```bash
    git clone https://github.com/bit-prophet/todo
    ```

2. Navigate to the project directory:

    ```bash
    cd todo
    ```

3. Install Composer dependencies:

    ```bash
    composer install
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration in the `.env` file with your MySQL credentials. Also fill `Pusher` configs to use broadcasting.

6. Run database migrations and seed the database with sample data:

    ```bash
    php artisan migrate:fresh --seed
    ```

## Usage

1. Start the development server:

    ```bash
    php artisan serve
    ```

2. Open your web browser and navigate to `http://localhost:8000` to access the Todo app.

## Additional Notes


- This application uses Laravel framework. Familiarity with Laravel and its concepts is recommended for development and customization.
- Ensure that Composer, PHP, and MySQL are installed on your system before proceeding with the installation steps.
- Customize the `.env` file with your specific environment configurations, such as database connection settings and application keys.
