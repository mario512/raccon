# Publishing Checklist

Use this checklist before making the repository public.

## Repository

- Rename the repository to `raccon-php-framework` or another neutral project name.
- Use this GitHub description:

```text
A lightweight educational PHP MVC framework for learning and rapid project prototyping.
```

- Keep the repository public only after checking that no local data, credentials, logs, archives, or dumps are committed.

## Local Check

```bash
git status
php -l index.php
find . -type f -name '*.php' -print0 | xargs -0 -n1 php -l
rg -i "password|secret|token|api_key|private|mysql|telegram|contact|credential|dump|backup" .
```

Review every search result manually. Configuration keys in `.env.example` are acceptable, but real values are not.

## GitHub Settings

1. Open repository settings.
2. Rename the repository if needed.
3. Set the repository description.
4. Change repository visibility to public.
5. Add topics such as `php`, `mvc`, `framework`, `learning`, `education`.

## Portfolio Positioning

Present Raccon as a small educational framework that demonstrates:

- MVC structure without heavy dependencies
- routing and controller flow
- simple database access through PDO
- templates and layouts
- localization
- admin and public application areas
- security-aware publication cleanup
