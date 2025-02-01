# FastAttend - A Smart Attendance System for Islamic Study Sessions “Pengajian”

## Overview
FastAttend is an advanced digital attendance system designed specifically for Islamic study sessions. It streamlines attendance tracking by allowing admins to register attendees manually or via QR code scanning. This application has been successfully used to track attendance for over 120 users in a single session.

## Key Features
- **Event Management**: Create and manage religious study events efficiently.
- **Attendance Tracking**:
    - **Manual Entry**: Admins can manually mark attendance by selecting a user from the list.
    - **QR Code Scanning**: Users with a registered QR code can simply scan and mark their presence.
    - **New User Registration**: If a user is not registered, the admin can add them on the spot and mark attendance.
- **Admin Control Over Attendance Status**:
    - Admins can modify attendance records, changing statuses from "Present" to "Excused" or "Sick" as needed.
    - If a user is mistakenly marked, their status can be corrected.
- **Responsive Design**: Optimized for both desktop and mobile use.

## Web Preview
![Web Preview](link-to-web-preview-image)

## Mobile Preview
![Mobile Preview](link-to-mobile-preview-image)

## Tech Stack
### Backend
- **Laravel (PHP Framework)**: Handles authentication, database interactions, and event logic.
- **MySQL**: Relational database to store user, event, and attendance data.

### Frontend
- **Blade Templates**: Laravel’s templating engine for dynamic HTML rendering.
- **HTML5, CSS3, JavaScript**: For styling and interactivity.
- **QR Code Scanner (html5-qrcode)**: Enables real-time QR scanning.
