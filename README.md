# SwiftCargo - Courier Management System

## How to Setup (3 Steps)

**Step 1: Import Database**
- Open phpMyAdmin
- Click Import
- Select the file: `database/swiftcargo.sql`
- Click Go

**Step 2: Check .env File**
```
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=swiftcargo
```

**Step 3: Open in Browser**
```
http://localhost/SwiftCargo/login
```

---

## Login Details

| Role  | Email                          | Password |
|-------|--------------------------------|----------|
| Admin | admin@gmail.com                | admin123 |
| Agent | agent.karachi@swiftcargo.com   | agent123 |
| Agent | agent.lahore@swiftcargo.com    | agent123 |
| Agent | agent.islamabad@swiftcargo.com | agent123 |
| User  | ali@gmail.com                  | user123  |

---

## Tracking Numbers (for testing)

`SC001KHI2024` · `SC002LHR2024` · `SC003ISB2024` · `SC004MUL2024` · `SC005PEW2024`

---

## What This System Can Do

- **3 User Types**: Admin, Agent, and Customer — each has their own dashboard
- **Track Shipments**: Customer can search and track any package by tracking number
- **Manage Agents**: Admin can add and manage branch agents by city
- **Download Reports**: Agent can download shipment reports in CSV format
- **SMS Alerts**: System shows SMS notifications when a shipment is booked or delivered
- **Print Invoice**: Users can print shipment details on paper

---

## Technologies Used

- PHP 8.x — MVC pattern (no framework)
- MySQL with PDO (safe queries)
- Vanilla CSS (dark theme)
- Apache with mod_rewrite
