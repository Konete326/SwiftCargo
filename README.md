# SwiftCargo — Courier Management System

## Setup (3 steps)

**1. Import Database**
- Open phpMyAdmin → Import → select `database/swiftcargo.sql` → Go

**2. Check .env**
```
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=swiftcargo
```

**3. Open Browser**
```
http://localhost/SwiftCargo/public/login
```

---

## Login Credentials

| Role  | Email                                  | Password |
|-------|----------------------------------------|----------|
| Admin | admin@gmail.com                        | admin123 |
| Agent | agent.karachi@swiftcargo.com           | agent123 |
| Agent | agent.lahore@swiftcargo.com            | agent123 |
| Agent | agent.islamabad@swiftcargo.com         | agent123 |
| User  | ali@gmail.com                          | user123  |

---

## Sample Tracking Numbers
`SC001KHI2024` · `SC002LHR2024` · `SC003ISB2024` · `SC004MUL2024` · `SC005PEW2024`
## Key Features
- **Branding & Logo**: Integrated custom branding logo replacing placeholder emojis.
- **Role-Based Panels**: Dashboards for Admin, Branch Agent, and Registered Customer.
- **Branch Reports**: Agent portal allows downloading date-wise CSV reports for branch shipments.
- **SMS Simulation**: Appends simulated booking and delivery SMS notifications to success alerts.
- **Print Optimization**: Print-friendly CSS styles optimized for paper invoice outputs.

---

## Tech Stack
- PHP 8.x (no framework) — MVC pattern
- MySQL + PDO (prepared statements)
- Vanilla CSS (dark theme)
- Apache + mod_rewrite
