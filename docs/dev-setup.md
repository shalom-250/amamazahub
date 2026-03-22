# Developer Setup Guide

## Prerequisites

Make sure you have installed:
- **PHP 8.2+**
- **Composer**
- **Node.js 18+** and **npm**
- **Git**

---

## Step 1 — Clone the Repository

```bash
git clone https://github.com/your-org/amamazahub.git
cd amamazahub
```

---

## Step 2 — Install Dependencies

```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

---

## Step 3 — Configure Environment

```bash
# Copy the example env file
cp .env.example .env

# Generate the app key
php artisan key:generate
```

Edit `.env` and set:
```env
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
```

---

## Step 4 — Set Up the Database

```bash
# Create the SQLite database file
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed with sample Rwandan data
php artisan db:seed --class=RwandanUserSeeder
php artisan db:seed --class=ExploreSeeder
```

---

## Step 5 — Link Storage

```bash
php artisan storage:link
```

---

## Step 6 — Start Development Servers

You need **two terminals** running simultaneously:

**Terminal 1 — Laravel Backend:**
```bash
php artisan serve
# Runs on http://localhost:8000
```

**Terminal 2 — Vite Frontend (Hot Reload):**
```bash
npm run dev
# Runs on http://localhost:5173 (proxied through Laravel)
```

Open your browser at **http://localhost:8000**

---

## Default Test Accounts

After running the seeders, you can log in with any of these:

| Username | Email | Password |
|---|---|---|
| funny_king | funny@example.com | Test1234@ |
| edutech_pro | edu@example.com | Test1234@ |
| gg_gamer | gamer@example.com | Test1234@ |
| music_vibes | music@example.com | Test1234@ |
| vlog_life | vlog@example.com | Test1234@ |

---

## Useful Artisan Commands

```bash
# Clear all caches
php artisan optimize:clear

# Re-run all migrations and seeders (fresh start)
php artisan migrate:fresh --seed

# Fix existing video URLs in DB (if needed)
php artisan tinker --execute="App\Models\Video::where('video_url', 'like', '%broken-url%')->update(['video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'])"

# List all routes
php artisan route:list
```

---

## Common Issues

### Videos not loading
- Ensure `APP_URL=http://localhost:8000` is set in `.env`
- Run `php artisan optimize:clear`

### Assets not found (404)
- Make sure **both** `php artisan serve` and `npm run dev` are running

### Database errors
- Try `php artisan migrate:fresh --seed` to reset the database

### Logo not showing
- Confirm `public/images/logo.png` exists
