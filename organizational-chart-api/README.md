# Adrian D. Del Rosario
# Backend Developer

# AAS Laravel Practice Exam

# Organizational Chart API
This is a Laravel-based API for managing an organizational chart. It allows you to Create, View, Update, and Delete positions, as well as define the reporting structure.

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL

## Installation

1.  **Clone the repository:**
    ```bash
    git clone <your-repo-url>
    cd organizational-chart-api
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Rename the `.env.example` file to `.env`:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure your `.env` file:**

    Update the `DB_*` variables in your `.env` file to match your local MySQL database credentials. You will need to create a database for this project.

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=organizational_chart
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Run the database migrations:**
    ```bash
    php artisan migrate
    ```

7.  **Start the development server:**
    ```bash
    php artisan serve
    ```

    The API will be available at `http://127.0.0.1:8000`.

## API Endpoints

The following endpoints are available:

| Method | URI | Action |
| --- | --- | --- |
| `GET` | `/api/positions` | Get all positions |
| `POST` | `/api/positions` | Create a new position |
| `GET` | `/api/positions/{id}` | Get a single position |
| `PATCH` | `/api/positions/{id}` | Update a position |
| `DELETE` | `/api/positions/{id}` | Delete a position |
| `GET` | `/api/positions/{id}/subordinates` | Get all positions that report to this position |

### Get All Positions (with Search and Sort)

-   **Endpoint:** `GET /api/positions`
-   **Query Parameters:**
    -   `search` (optional): Filter positions by name.
    -   `sort` (optional): Sort positions by name. Accepts `asc` or `desc`.

    **Example:** `GET /api/positions?search=Developer&sort=asc`

### Create a Position
**Curl**

    ```
    curl --location 'http://127.0.0.1:8000/api/positions' \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --data '{
        "name": "Ceo"
    }'
    ```

### Get a Single Position
**Curl** 
    ```
    curl --location 'http://127.0.0.1:8000/api/positions/1' \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --data ''
    ```

### Update a Position
**Curl**

    ```
    curl --location --request PATCH 'http://127.0.0.1:8000/api/positions/1' \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --data '{
        "name": "CeoUpdate"
    }'
    ```

### Delete a Position
**Curl**

    ```
    curl --location --request DELETE 'http://127.0.0.1:8000/api/positions/1' \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --data ''
    ```

### Get Subordinates of a Position
**Curl**

    ```
    curl --location 'http://127.0.0.1:8000/api/positions/1/subordinates' \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --data ''
    ```
