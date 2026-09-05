# Toko Utama — E-Commerce & Store Management System

A production-deployed e-commerce and store management system built end-to-end for **Toko Utama**, a local wholesale grocery & tobacco business in Karanganyar, Indonesia. Designed to give resellers and new customers online visibility into product catalog and availability.

🔗 **Live site:** [toko-utama-production.up.railway.app](https://toko-utama-production.up.railway.app)

## Overview

This is a real freelance client project, not a course assignment. It was built from scratch through a full development lifecycle: requirement gathering with the client, database design, feature development, and production deployment.

The client's core need was **online visibility for reseller customers** — not a full POS/inventory system — so the product scope was intentionally kept focused: a public product catalog + an admin panel to manage it.

## Features

- Public-facing product catalog (categories, availability status)
- Admin panel with authentication (Laravel Breeze)
- **Role-Based Access Control (RBAC)** for admin roles, separating access based on operational needs
- Product & category CRUD, image management
- Store settings management
- WhatsApp integration for customer inquiries
- Responsive UI for both desktop and mobile

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 13 |
| Frontend | Blade, Tailwind CSS |
| Database | SQLite |
| Auth | Laravel Breeze |
| Deployment | Docker, Nginx, PHP-FPM (via Supervisor), Railway |

## Architecture Notes

- Single Laravel application (Blade-rendered, no separate SPA) — chosen for simplicity and fast delivery given the client's actual needs.
- SQLite was chosen over MySQL/Postgres to keep infrastructure lightweight for a small-scale UMKM use case.
- Deployed to production using a custom Docker setup (Nginx + PHP-FPM via Supervisor), connected to Railway via GitHub webhook for continuous deployment.

## Database Design (ERD Summary)

- `categories` — product categories
- `products` — includes an `is_available` flag to reflect "Habis" (out of stock) state; intentionally has no price/stock columns, since inventory tracking wasn't part of the client's requirement
- `store_settings` — store-level configuration
- `users` — admin accounts with role-based permissions

## Local Setup

\`\`\`bash
git clone https://github.com/hans106/toko-utama.git
cd toko-utama
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve
\`\`\`

## Author

**Hans Vere Liem** — Informatics student, Full Stack Development, Universitas Ciputra Surabaya
[LinkedIn](https://www.linkedin.com/in/hans-vere-liem-013810323) · [GitHub](https://github.com/hans106)

---

*This project was built as a real freelance engagement for a family-owned business, and is showcased here as part of my development portfolio.*
