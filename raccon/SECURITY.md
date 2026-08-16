# Security Policy

Raccon is an educational framework and demo project. Please do not use the included demo logic as a production-ready financial or user-data system without a separate security review.

Report vulnerabilities privately to the repository owner. Avoid opening public issues with exploit details until the problem is fixed.

Before production use, review at least:

- authentication and session handling
- authorization checks for admin actions
- CSRF protection
- input validation and output escaping
- file upload handling
- database credentials and backups
- web server document root and access rules
