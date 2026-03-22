# System Overview

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | Laravel 11 (PHP) |
| **Frontend** | React 18 + Inertia.js |
| **Styling** | Tailwind CSS |
| **Build Tool** | Vite |
| **Database** | SQLite (dev) / MySQL (production) |
| **Auth** | Laravel Sanctum |
| **Animations** | Framer Motion |

---

## Architecture

AmazamaHub uses a **Monolith + SPA hybrid** architecture via **Inertia.js**:

```
Browser (React SPA)
    ↕ Inertia.js (no full page reloads)
Laravel Backend (PHP / Controllers)
    ↕ Eloquent ORM
SQLite / MySQL Database
```

- **No separate API** — Inertia renders server-side responses as React component props.
- **Shared data** (auth user, suggested accounts, unread messages) is injected globally via `HandleInertiaRequests.php`.
- **Assets** are managed via **Vite** (JS/CSS bundling) and served during dev via Vite's dev server.

---

## Key Directories

```
amamazahub/
├── app/
│   ├── Http/
│   │   ├── Controllers/     All feature controllers
│   │   └── Middleware/      HandleInertiaRequests (global shared data)
│   └── Models/              Eloquent models
├── database/
│   ├── migrations/          Database schema
│   └── seeders/             Sample data (Rwandan users, explore content)
├── resources/
│   └── js/
│       ├── Components/      Reusable React components
│       └── Pages/           Inertia page components
├── routes/
│   └── web.php              All HTTP routes
├── public/
│   └── images/              Static assets (logo, thumbnails)
└── docs/                    ← You are here
```

---

## Request Flow

1. User visits a URL (e.g. `/`)
2. Laravel routes the request to a Controller
3. Controller fetches data from the database via Eloquent models
4. Controller calls `Inertia::render('PageName', $data)`
5. React component receives data as **props** and renders the UI
6. Subsequent navigation uses **Inertia's client-side routing** (no full reloads)
