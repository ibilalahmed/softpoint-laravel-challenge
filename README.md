# SoftPoint API (Laravel) Developer Challenge Submission

This repository contains the complete solution for the API (Laravel) Developer Challenge from SoftPoint. The project is a robust, well-tested, and professionally structured RESTful API for managing Real Estate properties.

---

## Technical Overview & Evaluation Highlights

This API was built with modern Laravel best practices at its core, focusing on code quality, testability, and adherence to the project specifications.

*   **RESTful Architecture:** The API follows REST principles with a versioned endpoint (`/api/v1/`). It utilizes standard HTTP methods (`GET`, `POST`, `PUT`, `DELETE`) for all CRUD operations via a resourceful route (`Route::apiResource`).

*   **Validation:** All incoming data is rigorously validated using dedicated **Form Request** classes (`StoreRealEstateRequest`, `UpdateRealEstateRequest`). This keeps the controller logic clean and focused, while handling complex conditional rules (e.g., `rooms` must be zero for `land` types, `internal_number` is required for `department` types).

*   **Database Design & Management:**
    *   **Migrations:** The database schema is fully defined and version-controlled through Laravel Migrations. The blueprint is the single source of truth for the database structure.
    *   **Factories & Seeders:** The database is populated with realistic sample data using a Model Factory and the main Database Seeder, making the API immediately testable upon setup.

*   **API Resources (Transformation Layer):** JSON responses are precisely shaped using `RealEstateResource` and `RealEstateCollectionResource`. This ensures the API adheres to the specified output formats: a summary view for lists (`index`) and a detailed view for single records (`show`, `store`, `update`, `destroy`).

*   **Soft Deletes:** The `DELETE` endpoint utilizes Laravel's Soft Deletes feature. Records are not permanently removed from the database, preserving data integrity while fulfilling the "recently removed record" requirement.

*   **Automated Testing:** The entire API is covered by a comprehensive **Feature Test** suite (`RealEstateApiTest`).
    *   Tests are written for all five controller operations (`index`, `store`, `show`, `update`, `destroy`).
    *   The test environment is configured to use an **in-memory SQLite database** for maximum speed and isolation, ensuring that tests do not interfere with the development database and can be run reliably in any environment.

---

## Prerequisites

To run this project, you will need the following installed on your system:
- PHP >= 8.2 (with `mysql` and `sqlite` extensions)
- Composer
- MySQL
- Git

---

## Setup and Installation Guide

Please follow these steps to get the project running locally.

**1. Clone the repository:**
```bash
git clone https://github.com/ibilalahmed/softpoint-laravel-challenge.git
cd softpoint-laravel-challenge
```

**2. Install PHP Dependencies:**
```bash
composer install
```

**3. Configure Environment:**
Create your personal environment file by copying the example.
```bash
cp .env.example .env
```

**4. Generate Application Key:**
```bash
php artisan key:generate
```

**5. Set Up Your Database:**
You will need to create a new, empty MySQL database for the application. Once created, open the `.env` file and update the `DB_` variables with your credentials.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=softpoint_challenge # The name of the empty database you created
DB_USERNAME=your_db_user      # Your MySQL username
DB_PASSWORD=your_db_password  # Your MySQL password
```

**6. Migrate and Seed the Database:**
This single command will build the entire database schema and populate it with 25 sample records.
```bash
php artisan migrate --seed
```

**7. Start the Local Server:**
```bash
php artisan serve
```
The API is now running and available at `http://127.0.0.1:8000`.

---

## Running the Automated Tests

To verify the integrity and correctness of the API, run the full feature test suite. This will use a separate, in-memory SQLite database and will not affect your MySQL data.

```bash
php artisan test
```
All tests should pass, confirming that every endpoint and its logic is functioning as expected.

---

## API Endpoints

**Base URL:** `http://127.0.0.1:8000/api/v1`

| Method   | URI                      | Action    | Description                                   |
|----------|--------------------------|-----------|-----------------------------------------------|
| `GET`    | `/real-estates`          | `index`   | List all real estate properties (paginated).  |
| `GET`    | `/real-estates/{id}`     | `show`    | Get a single real estate property by ID.      |
| `POST`   | `/real-estates`          | `store`   | Create a new real estate property.            |
| `PUT`    | `/real-estates/{id}`     | `update`  | Update an existing real estate property.      |
| `DELETE` | `/real-estates/{id}`     | `destroy` | Soft-delete a real estate property.           |

**Example `POST` Request Body:**
```json
{
    "name": "My New Apartment",
    "real_state_type": "department",
    "street": "Coding Avenue",
    "external_number": "404",
    "internal_number": "Apt 101",
    "neighborhood": "Tech Park",
    "city": "Laravel City",
    "country": "MX",
    "rooms": 2,
    "bathrooms": 1,
    "comments": "Great view!"
}
```

---

Thank you for the opportunity to complete this challenge.
