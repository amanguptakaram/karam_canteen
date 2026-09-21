
# 🍽️ KARAM Canteen

> A Laravel-based Canteen Management & Food Ordering System developed for KARAM.

---

## 📌 Project Overview

**KARAM Canteen** is a web-based canteen management and food ordering application built using Laravel.

The main purpose of this project is to provide a simple and organized platform where employees/users can view the available canteen menu, add food items to their cart, place orders, and track their order history.

An **Admin Panel** is also provided for managing food items, users, and incoming orders.

---

## 🎯 Project Objective

The application is designed to simplify the canteen ordering process by providing:

- 🧑‍💻 Easy user registration and login
- 🍔 Digital food menu
- 🛒 Cart-based ordering
- 📦 Order management
- 👨‍💼 Admin management panel
- 📊 Admin dashboard
- 👥 User management
- 🍱 Food availability management

---

# ✨ Features

## 👤 User Module

Users can:

- Register their account
- Login securely
- View today's available menu
- View food name, category, price and description
- Add food items to cart
- Increase or decrease food quantity
- Remove food from cart
- Clear the complete cart
- Place an order
- View previous orders
- View ordered food items and quantities
- View total order amount
- Track order status
- Logout

---

## 🛠️ Admin Module

Admin can:

- Login through a separate admin login
- View dashboard
- View total users
- View total foods
- View available foods
- View total orders
- View pending orders
- View accepted orders
- View today's orders
- View recent orders
- Manage food items
- Add new food
- Edit food
- View food details
- Delete food
- Make food available/unavailable
- View user list
- View user details
- View order list
- View order details
- Accept pending orders
- Logout

---

# 🔄 Application Workflow

```text
                         ┌─────────────────────┐
                         │   KARAM CANTEEN     │
                         └──────────┬──────────┘
                                    │
                 ┌──────────────────┴──────────────────┐
                 │                                     │
                 ▼                                     ▼
          ┌───────────────┐                    ┌───────────────┐
          │     USER      │                    │     ADMIN     │
          └───────┬───────┘                    └───────┬───────┘
                  │                                    │
                  ▼                                    ▼
          Register / Login                       Admin Login
                  │                                    │
                  ▼                                    ▼
           Today's Menu                            Dashboard
                  │                                    │
                  ▼                         ┌──────────┼──────────┐
             Add to Cart                    │          │          │
                  │                         ▼          ▼          ▼
                  ▼                       Foods     Orders      Users
           Update Quantity
                  │
                  ▼
             Place Order
                  │
                  ▼
          Order Status:
             PENDING
                  │
                  │
                  ▼
              Admin
                  │
                  ▼
          Accept Order
                  │
                  ▼
          Order Status:
            ACCEPTED


# 🛒 Order Process
🍔 Select Food
      ↓
🛒 Add to Cart
      ↓
➕ / ➖ Update Quantity
      ↓
💰 Check Total
      ↓
📦 Place Order
      ↓
⏳ Order Status = Pending
      ↓
👨‍💼 Admin Reviews Order
      ↓
✅ Admin Accepts Order
      ↓
📦 Order Status = Accepted
