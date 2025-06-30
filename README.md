
## 🧾 Laravel Credit Reward System

A scalable Laravel 12.19.3 application for a **credit-reward system**, running on `http://localhost:8000` with PHP 8.3 (Apache) and MySQL 8.0.  
This project is containerized using **Docker** and works across platforms: Linux, Windows, and macOS.

✅ **Version**: 1.0  
🚀 **Live URL**: [http://localhost:8000](http://localhost:8000)

---

## 📦 Tech Stack

| Component         | Version/Tool              |
|------------------|---------------------------|
| Framework         | Laravel 12.19.3           |
| PHP               | 8.3                       |
| Web Server        | Apache                    |
| Database          | MySQL 8.0                 |
| Containerization  | Docker + Docker Compose   |

---

## 📁 Project Setup

### 1. Clone the Repository
```bash
git clone <repo-url> laravel-credit-reward-system
cd laravel-credit-reward-system
```

### 2. Copy Environment File
```bash
cp .env.example .env
```

Ensure `.env` has these default DB settings:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel_user
DB_PASSWORD=secret
```

For Docker-specific settings:
```bash
source .env.docker
```

### 3. Start Containers

#### Modern Docker CLI (v2+):
```bash
source .env.docker && docker compose down -v && docker compose up -d --build
```

#### Older versions:
```bash
source .env.docker && docker-compose down -v && docker-compose up -d --build
```

> 💡 Remove or comment `version: '3.8'` in `docker-compose.yml` if you're using Docker v20.10+.

### 4. Install Dependencies
```bash
docker exec -it laravel-credit-reward-system-app-1 composer install
```

### 5. Publish Sanctum Configuration
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 6. Generate Application Key
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan key:generate
```

### 7. Create `.htaccess` File (if missing)
```bash
cp public/.htaccess.example public/.htaccess
```

---

## 📊 Database Setup

### 1. Run Migrations
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan migrate
```

Check logs if errors occur:
```bash
docker compose logs app
docker compose logs db
```

### 2. Seed the Database
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan migrate --seed
```

### 3. Verify or Access Database

#### Terminal Access:
```bash
docker exec -it laravel-credit-reward-system-db-1 mysql -u laravel_user -psecret laravel
SHOW TABLES;
```

#### GUI Tools:
Use tools like MySQL Workbench or TablePlus:

| Field      | Value                      |
|------------|----------------------------|
| Host       | localhost                  |
| Port       | 3306                       |
| Database   | laravel                    |
| Username   | laravel_user               |
| Password   | secret                     |

### 4. Set Permissions (Linux Only)
```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

Inside container (all OS):
```bash
docker exec -it laravel-credit-reward-system-app-1 bash
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
exit
```

---

## 🚀 Optimize Laravel Project

```bash
docker compose exec app php artisan route:clear
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
docker compose exec app composer dump-autoload
```

---

## 🔍 Access the Application

Open in browser:  
👉 [http://localhost:8000](http://localhost:8000)

If issues occur:
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan cache:clear
docker exec -it laravel-credit-reward-system-app-1 php artisan view:clear
```

---

## 🧪 Common Docker Commands

| Task                          | Command                                                                 |
|-------------------------------|-------------------------------------------------------------------------|
| Start containers              | `docker compose up -d`                                                |
| Stop containers               | `docker compose down`                                                 |
| Check status                  | `docker compose ps`                                                   |
| View logs                   | `docker compose logs app`                                             |
| Enter container               | `docker exec -it laravel-credit-reward-system-app-1 bash`             |
| Clear Laravel cache           | `php artisan cache:clear`, `view:clear`, etc., inside container       |
| Rebuild & Restart            | See Step 3 above                                                      |

---

## 💡 Cross-Platform Notes

- ✅ Supported OS: Linux, Windows (with Docker Desktop), macOS (with Docker Desktop)
- 📍 Place project anywhere — volumes ensure portability
- 📁 File sharing: Share folder in Docker Desktop > Settings > Resources > File Sharing
- ⚠️ Line endings: Add `.gitattributes`:
  ```bash
  echo "* text=auto eol=lf" > .gitattributes
  git add .gitattributes
  git commit -m "Add .gitattributes for LF line endings"
  ```
- ✔️ Git config (Windows only):
  ```bash
  git config --global core.autocrlf true
  ```

## 📌 Final Notes

- Use modern Docker CLI (`docker compose` instead of `docker-compose`)
- Commit `.gitattributes` for line ending consistency
- Fully portable — runs on any machine with Docker
- Report issues on GitHub if needed

---

## 🎯 Features
 ✅Admin Features    Manage Credit Packages  Manage Products  Mark products as redeemable
- ✅ User Authentication: Register, Login, Logout (via Sanctum)  
- 🧾 Credit Packages & Purchases: Buy credits, earn reward points
- 🎁 Points Redemption: Redeem products via API
- 🔍 Product Search: Keyword-based search with pagination
- 🤖 AI Recommendation: Recommend product based on available points

---

## 📚 API Documentation

### 🔐 Authentication

#### `POST /api/user/register`
**Description:** Register a new user.

**Request Body:**
```json
{
    "name": "string",
    "email": "string",
    "password": "string"
}
```

**Response (201):**
```json
{
    "message": "User registered",
    "user": {
        "id": 1,
        "name": "Ahmed Mohamed",
        "email": "ahmed.mohamed@email.com",
        "credits": 0,
        "reward_points": 0
    },
    "token": "1|sometoken..."
}
```

**Auth:** None

---

#### `POST /api/user/login`
**Description:** Log in and get token.

**Request Body:**
```json
{
    "email": "string",
    "password": "string"
}
```

**Response (200):**
```json
{
    "message": "Login successful",
    "token": "1|sometoken..."
}
```

**Auth:** None

---

#### `POST /api/user/logout`
**Description:** Log out current user.

**Headers:**
```
Authorization: Bearer <token>
```

**Response (200):**
```json
{
    "message": "Logout successful"
}
```

**Auth:** Required

---

### 💳 Credit Packages & Purchases

#### `GET /api/user/credit-packages`
**Description:** List available credit packages.

**Headers:**
```
Authorization: Bearer <token>
```

**Response (200):**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Basic Pack",
            "price_egp": 50.00,
            "credits": 50,
            "reward_points": 10
        }
    ]
}
```

**Auth:** Required

---

#### `POST /api/user/purchase`
**Description:** Purchase a credit package.

**Headers:**
```
Authorization: Bearer <token>
```

**Request Body:**
```json
{
    "credit_package_id": 1
}
```

**Response (201):**
```json
{
    "message": "Purchase successful",
    "purchase": {
        "id": 1,
        "credit_package_name": "Basic Pack",
        "credits_earned": 50,
        "reward_points_earned": 10,
        "amount_paid_egp": "50.00",
        "created_at": "2025-06-30T22:00:00Z"
    },
    "user": {
        "total_credits": 50,
        "total_reward_points": 10
    }
}
```

**Auth:** Required

---

### 🎁 Points Redemption

#### `GET /api/user/redeemable-products`
**Description:** List redeemable products.

**Headers:**
```
Authorization: Bearer <token>
```

**Response (200):**
```json
{
    "data": [
        {
            "id": 1,
            "category": "Electronics",
            "name": "Wireless Headphones",
            "description": "...",
            "image_url": "https://...",
            "points_required": 50
        }
    ]
}
```

**Auth:** Required

---

#### `POST /api/user/redeem-product`
**Description:** Redeem a product with points.

**Headers:**
```
Authorization: Bearer <token>
```

**Request Body:**
```json
{
    "product_id": 1
}
```

**Response (201):**
```json
{
    "message": "Redemption successful",
    "redemption": {
        "points_used": 50
    },
    "user": {
        "total_reward_points": 0
    }
}
```

**Auth:** Required

---

### 🔍 Product Search

#### `GET /api/products/search`
**Description:** Search products by name, category, or description with pagination.

**Query Params:**
- `query` – Optional keyword
- `per_page` – Items per page (default: 10)
- `page` – Page number (default: 1)

**Example:**
```
/api/products/search?query=wireless&per_page=5&page=1
```

**Response (200):**
```json
{
    "data": [...],
    "total": 1,
    "per_page": 5,
    "current_page": 1
}
```

**Auth:** None

---

### 🤖 AI Recommendation

#### `POST /api/products/ai/recommendation`
**Description:** Recommend a product based on user’s reward points.

**Headers:**
```
Authorization: Bearer <token>
```

**Response (200):**
```json
{
    "recommended_product": {
        "id": 1,
        "name": "Wireless Headphones",
        "points_required": 50
    }
}
```

**Response (404):**
```json
{
    "message": "No suitable recommendation found"
}
```

**Auth:** Required

---

## 📁 Sample Test Data

| Type               | Examples                                                  |
|--------------------|-----------------------------------------------------------|
| Users              | Ahmed Mohamed, Fatima Ali                                  |
| Products           | Wireless Headphones (50 pts), Smart Watch (100 pts), T-Shirt (non-redeemable) |
| Credit Packages    | Basic Pack (50 EGP = 50 credits + 10 points), Premium Pack (100 EGP = 100 credits + 25 points) |
| Purses             | Seeded via `PurchaseSeeder`                               |
| Redemptions        | Seeded via `RedemptionSeeder`                            |

Run:
```bash
docker exec -it laravel-credit-reward-system-app-1 php artisan migrate --seed
```

---

## 💡 Key Decisions

- **Tech Stack:** Laravel, MySQL, Docker
- **Search:** Used `LIKE` queries with pagination; Elasticsearch can be added later
- **Recommendation:** Simple filtering logic (can be extended to real AI/ML)
- **Security:** Sanctum auth, input validation
- **Docker:** Uses `.env.docker` for environment management

---

## 🎥 Video Walkthrough

The video will cover:
- Feature overview
- Code structure
- Docker setup with `.env.docker`
- API testing using Postman

---

