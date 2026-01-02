# Packer-Mover Project Report

## Executive Summary
**TrueWay Packers & Movers Pvt. Ltd.** is a comprehensive web-based management system designed to streamline the logistics of packing and moving services. This application provides a dual-interface platform: a user-friendly frontend for customers to browse services and book shipments, and a robust backend for administrators to manage operations, staff, and shipments efficiently.

## Technical Architecture

### Tech Stack
*   **Frontend**: HTML5, CSS3 (Tailwind CSS), JavaScript (Vanilla).
*   **Backend**: PHP (Core).
*   **Database**: Oracle Database (XE Edition 11g/18c/21c).
*   **Server**: Apache (via XAMPP).

### Project Structure
The project is organized into two primary modules:
1.  **Frontend (`/fronted`)**: 
    -   Contains client-facing views including Home, About Us, Services, and Contact pages.
    -   Implements responsive design using Tailwind CSS.
    -   Features dynamic elements like marquee partners display and service quote forms.
2.  **Backend (`/server`)**: 
    -   Handles business logic, database connectivity, and administrative functions.
    -   **Admin Dashboard**: Central hub for managing services, bookings, and staff.
    -   **Authentication**: Login/Registration systems for users and admins.
    -   **Database Config**: Oracle connection handling via `oci_connect`.

## Key Features

### 1. Customer Module
*   **Service Browsing**: Detailed pages for Household Shifting, Car Transport, warehousing, and more.
*   **Instant Quotes**: Interactive forms allowing users to submit moving details (Date, Origin, Destination, Items) to get cost estimates.
*   **Shipment Tracking**: Users can track the status of their booked shipments.
*   **Responsive UI**: Optimized for mobile and desktop devices using Tailwind CSS.

### 2. Admin & Staff Module
*   **Dashboard**: Overview of business metrics, total bookings, and active shipments.
*   **Service Management**: Add, update, or remove service offerings dynamically.
*   **Staff Management**: Tools to manage employee records (`staff.php`, `edit_staff.php`).
*   **Booking Management**: View and process customer booking requests (`new_booking.php`).

## Setup & Installation

### Prerequisites
*   **XAMPP/WAMP Server**: For Apache and PHP execution.
*   **Oracle Database**: Installed and running (Service: `XE`).
*   **PHP OCI8 Extension**: Enabled in `php.ini` to allow PHP to communicate with Oracle.

### Installation Steps
1.  **Clone/Copy Project**: Place the project folder in `htdocs` (e.g., `C:\xampp\htdocs\packer-mover js`).
2.  **Database Configuration**:
    -   Ensure Oracle Database is running.
    -   Update connection credentials in `server/config/db.php` if necessary:
        ```php
        $conn = oci_connect('username', 'password', "//localhost:1521/XE");
        ```
3.  **Run Application**:
    -   Start Apache in XAMPP control panel.
    -   Access the user interface: `http://localhost:81/packer-mover%20js/fronted/index.html`
    -   Access the admin panel: `http://localhost:81/packer-mover%20js/fronted/admin.html`

## Conclusion
This project demonstrates a full-stack implementation of a logistics management system, showcasing proficiency in backend PHP development, Oracle database integration, and modern frontend design principles. It solves real-world problems regarding shipment tracking and service booking automation.
