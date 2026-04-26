**Inventory Management System**

A web-based inventory management application built with Laravel for managing products, stock movement, suppliers, categories, users, and reports.

Member Name : 1. Moun Sovongdy 
	           2. So Kakrona
	           3. Chou Vinly

## Project Overview

This project helps a business track inventory in a simple and structured way:

- Admin/users sign in to access the dashboard.
- Products are grouped by category and linked to suppliers.
- Stock In transactions increase product quantity.
- Stock Out transactions decrease product quantity (with validation to prevent negative stock).
- Reports show product and stock movement summaries.

## Main Features

- Authentication (login/logout)
- Dashboard summary (total products, categories, suppliers, and current stock)
- Category management (CRUD)
- Supplier management (CRUD)
- Product management (CRUD + auto product code generation)
- Stock In records
- Stock Out records with stock availability check
- User management (admin-only)
- Reports:
  - Product report
  - Stock In report
  - Stock Out report

## How The System Works (Flow)

1. User logs in at `/login`.
2. Dashboard shows high-level inventory statistics.
3. Master data is prepared:
   - Create categories
   - Create suppliers
   - Create products
4. Daily stock operations:
   - **Stock In**: add incoming quantities
   - **Stock Out**: remove outgoing quantities (blocked if stock is insufficient)
5. Reports are used for monitoring and evaluation.

## Default Login Account

Use this seeded admin account:

- **Email:** `admin@gmail.com`
- **Password:** `admin123`
- **Role:** `admin`

## Author Notes

This project demonstrates:

- MVC implementation using Laravel
- Relational data design for inventory use cases
- Input validation and business rules (especially stock control)
- Authentication and role-based restriction for user management
- Practical reporting from transaction data