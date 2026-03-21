# AmazamaHub - TikTok Clone (Laravel + React + Inertia) 🇷🇼

## How to Run the Project
Follow these steps to get the project running on your local machine with all the data (videos, users, etc.) perfectly synchronized.

---

### 1. Prerequisites
Ensure you have the following installed:
- **PHP** (8.1+)
- **Composer** (PHP Dependency Manager)
- **Node.js & NPM** (JS Runtime)

---

### 2. Quick Installation
Open your terminal in the project directory (`d:\amamazahub`) and run the following commands in order:

```powershell
# Install PHP dependencies


# Install JS dependencies
npm install

# Create environment file
cat .env.example > .env

# Generate application key
php artisan key:generate
```

---

### 3. Database Setup (Full Data Sync)
To see the **same videos, users, and social interactions** as the production environment, run:

```powershell
# Run migrations and seed the database with real discovery data
php artisan migrate:fresh --seed
```

This command builds your local database and populates it with our **deterministic Rwandan Creator Suite**.

💡 **Sync Exactly What I See**: I have updated the seeders to be **100% Deterministic**. This means that anyone who runs this command will see the **exact same** users, videos, comments, and follower interactions. No random data is used—it follows a fixed high-fidelity blueprint.

---

### 4. Start the Engines
You need to run **two** separate terminal windows to keep the app alive:

**Terminal Window 1 (Laravel Server):**
```powershell
php artisan serve
```

**Terminal Window 2 (React/Vite Compiler):**
```powershell
npm run dev
```

---

### Access the App
Once both servers are running, open your browser and go to:
[**http://127.0.0.1:8000**](http://127.0.0.1:8000)

**Your high-fidelity TikTok Clone is now live!**
