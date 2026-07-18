# BOA Futsal Arena ⚽

BOA Futsal is a modern, responsive web application for managing futsal arena bookings. Built with **Laravel 12** and **Tailwind CSS**, it features a beautiful glassmorphism-inspired dark mode UI, smooth scrolling animations, and an intuitive Admin Panel for managing users, bookings, and messages.

## ✨ Features

- **Modern UI/UX**: Dark mode theme with glassmorphism effects, powered by Tailwind CSS.
- **Smooth Animations**: Animate On Scroll (AOS) for buttery-smooth page loading and interactions.
- **Responsive Design**: Fully optimized for desktop, tablet, and mobile viewing.
- **Landing Page**: Information about facilities, fields, location (integrated with Google Maps), and contact.
- **Admin Dashboard**: Manage users, monitor bookings, and read incoming messages/collaboration requests from users.
- **Dynamic Content**: Data is driven by a MySQL database using Laravel's robust ORM (Eloquent).

## 🚀 Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templating, Tailwind CSS, Vanilla JS
- **Animations**: AOS (Animate On Scroll)
- **Database**: MySQL / SQLite (configurable)
- **Local Dev Environment**: Laragon (recommended)

## 🛠️ Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/Jonnint/Boa-Futsal.git
   cd Boa-Futsal/boafutsalv1
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   Copy the `.env.example` to `.env` and generate the app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database credentials in the `.env` file.*

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Servers**
   Run the following commands in separate terminal windows:
   ```bash
   php artisan serve
   npm run dev
   ```
   The application will be accessible at `http://localhost:8000`.

## 📱 User Roles

- **Guest**: Can view the landing page, facilities, fields, and send contact/collaboration messages.
- **Authenticated Users**: Can book futsal fields.
- **Admin**: Has access to `/admin/dashboard` to manage the platform's data.

## 🎨 UI/UX Highlights

- **Premium Footer**: Glowing aesthetics with comprehensive navigation and CTA.
- **Floating WhatsApp Button**: Positioned neatly on the bottom right for direct admin contact, optimized for mobile screens.
- **Smooth Scrolling**: Implemented on all anchor links and page scroll (AOS).

## 📜 License

This project is proprietary for BOA Futsal Arena.
