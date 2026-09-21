# Student Management System — Fixed

## Setup on XAMPP

1. Copy this whole `sms` folder into `C:\xampp\htdocs\` (so you get `C:\xampp\htdocs\sms\...`).
2. Start **Apache** and **MySQL** in the XAMPP Control Panel.
3. Your `students` table already exists (visible in phpMyAdmin), so you don't need `schema.sql` —
   it's only there in case you ever need to recreate the table from scratch.
4. Visit `http://localhost/sms/index.php` in your browser.

## What was broken and what I fixed

1. **`update.php` was a completely empty file.** Editing a student did nothing — the form had
   nowhere to submit its data. Rewrote it to actually run the `UPDATE` query.
2. **SQL injection** in `insert.php`, `delete.php`, `edit.php`, and `view.php` — user input (`$_GET`,
   `$_POST`) was concatenated directly into SQL strings. Rewrote every query to use
   **prepared statements** (`mysqli_prepare` + `bind_param`).
3. **Stored/reflected XSS** — student data was echoed straight into HTML with no escaping.
   Wrapped all output in `htmlspecialchars()`.
4. **Broken file paths** — `dashboard.php` and `index.php` reference `css/dashboard.css`,
   `css/style.css`, and `js/app.js`, but the files were sitting flat in the project root. Moved
   them into `css/` and `js/` subfolders to match.
5. **Invalid CSS** — in `dashboard.css`, the `.chart-card` rule was accidentally nested inside
   `tr:hover { }`, which broke the stylesheet parsing from that point on. Fixed the brace.
6. **Infinite-loop bug** in the animated counters — if a count is `0`, the original code did
   `increment = Math.ceil(0 / 50) = 0`, so `current += 0` forever and the tab would hang.
   Guarded with `Math.max(1, ...)`.
7. **Missing "Add Student" form.** `insert.php` existed to receive a new student, and the
   dashboard sidebar linked "Add Student" to `index.php`, but `index.php` had no form at all.
   Added a proper form (name, registration, roll, session, email) to `index.php`, styled to
   match the existing glass/dark theme, and added basic server-side validation (required fields,
   valid email) in `insert.php` / `update.php`.
8. **Home page student counter was hardcoded to 0** — the JS line that ran it was commented out.
   `index.php` now queries the real count from the database and passes it to `app.js`, which
   animates to the real number.
9. Cast IDs to `(int)` everywhere they hit a query or URL, as defense in depth on top of the
   prepared statements.

## Notes
- `db.php` now turns on `mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT)`, so DB errors
  will throw instead of silently failing or leaking a blank page.
- Default XAMPP MySQL credentials (`root` / no password) are unchanged — update `db.php` if yours differ.
