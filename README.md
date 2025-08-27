# Supermarket API

## 📌 Description

This project is a RESTful API for managing supermarket aisles and products, built with **Laravel**. Each aisle contains multiple products with stock management and real-time quantity updates.
The API supports authentication via **Laravel Sanctum** and provides endpoints for both clients and administrators.

---

## 🚀 Features

### 🔹 User Authentication

* Users can **authenticate** using Laravel Sanctum.

### 🔹 Client Features

* View available products in a specific aisle.
* Search for products by **name** or **category**.
* Browse **popular** or **promotional** products within an aisle.

### 🔹 Administrator Features

* Add, update, or delete **aisles**.
* Add, update, or delete **products** within an aisle.
* View **stock statistics** (most sold products, low stock levels).
* Receive alerts for products that reach low stock thresholds.
* Automatically update stock levels after sales using **Laravel Queues and Jobs**.

### 🔹 Developer Features

* Detailed **API documentation** using tools like Postman or Swagger.
* **Unit tests** with PHPUnit or Pest.
* Optional containerization with **Laravel Sail** for easier deployment.

### 🔹 Bonus Features

* Email notifications for **critical stock levels**.
* Use of **slugs** to generate readable URLs for aisles and products.

---

## 🛠️ Tech Stack

* **Backend**: Laravel
* **Authentication**: Laravel Sanctum
* **Queue Management**: Laravel Jobs & Queues
* **Testing**: Pest
* **Containerization**: Laravel Sail (optional)
* **API Documentation**: Postman

---

## ⚙️ Installation & Setup

1. **Clone the project**

   ```bash
   git clone https://github.com/ahmedbenkrarayc/smartshelf.git
   cd smartshelf
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Configure environment**
   Copy `.env.example` to `.env` and configure database and mail settings:

   ```bash
   php artisan key:generate
   ```

4. **Run migrations and seed database**

   ```bash
   php artisan migrate --seed
   ```

5. **Start the server**

   ```bash
   php artisan serve
   ```

---

## 🧪 Tests

Run tests with:

```bash
php artisan test
```

or

```bash
./vendor/bin/pest
```

---

## 📖 API Documentation

The API documentation is generated using **Postman** and details all available endpoints for clients and administrators.

---

## 📌 Key Points

* ✅ Laravel REST API with aisles and product management
* ✅ Real-time stock updates using Queues and Jobs
* ✅ Authentication with Laravel Sanctum
* ✅ Unit tests and API documentation
* ✅ Optional containerization with Laravel Sail
* ✅ Notifications for low stock and readable slugs for URLs
