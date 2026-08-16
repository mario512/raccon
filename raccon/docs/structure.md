# Project Structure

Raccon keeps the application layout intentionally simple. Most parts are plain PHP files grouped by responsibility, so a beginner can follow the request from `index.php` to the final template without learning a large framework first.

## Request Flow

```text
Browser request
    -> index.php
    -> Components/StartUp.php
    -> Components/Router.php
    -> Controllers/*
    -> Models/* when data is needed
    -> Views/*
```

1. `index.php` defines the project root and starts the application.
2. `Components/StartUp.php` loads configuration, registers the autoloader, starts the session, and runs the router.
3. `Components/Router.php` reads `Config/Routes.php`, matches the current URL, and calls the needed controller action.
4. A controller prepares data for the page and loads a template.
5. Models are used when a controller needs database data.
6. Views render the final HTML.

## Main Directories

### `Components/`

Core framework classes live here.

Important files:

- `Router.php` maps URLs to controller actions.
- `Loader.php` loads classes and components.
- `Db.php` creates the PDO database connection.
- `Template.php` resolves and renders view files.
- `Session.php` starts and works with sessions.
- `Registry.php` stores shared application objects.
- `Image.php` and `Controllers/Tools/ImageTool.php` handle image resizing and cache generation.

### `Config/`

Project settings and routing live here.

Important files:

- `Config.php` defines application settings and reads values from environment variables.
- `Routes.php` maps public URLs to controller actions.
- `HeaderMenu.php` and `HeaderAdminMenu.php` describe menu items.
- `Language_ru.php` contains common Russian interface text.

### `Controllers/`

Controllers receive a request, collect data, and choose which view to render.

Structure:

```text
Controllers/Admin/    admin area controllers
Controllers/Catalog/  public site controllers
Controllers/Tools/    helper controllers and tools
```

Controller class names follow the file name. For example:

```text
Controllers/Catalog/StartController.php
class StartController
```

A route such as:

```php
'start.html' => 'start/index'
```

calls:

```php
StartController::actionIndex()
```

### `Models/`

Models contain application logic that works with stored data.

Structure:

```text
Models/Admin/    admin data models
Models/Catalog/  public site data models
```

Use models from controllers when a page needs records from the database.

### `Views/`

Views contain templates and front-end assets.

Structure:

```text
Views/Admin/    admin templates, language files, and assets
Views/Catalog/  public theme templates and language files
```

Catalog templates are resolved through:

```php
Template::get('template_name')
```

Template names use underscores as directory separators. For example:

```php
Template::get('common_headerIndex')
```

loads:

```text
Views/Catalog/<theme>/common/headerIndex.html
```

### `image/`

Source images committed to the project live here. Generated resized versions should not be committed.

### `cache/`

Runtime-generated files live here. The directory is kept in git with `.gitkeep`, but generated files are ignored.

### `.env`

Local private configuration lives in `.env`. It should be created from `.env.example` and must not be committed.

## Adding A Simple Page

1. Add a route in `Config/Routes.php`:

```php
'hello.html' => 'hello/index'
```

2. Create a controller:

```text
Controllers/Catalog/HelloController.php
```

```php
<?php

class HelloController extends Controller
{
    public function actionIndex()
    {
        $dataPage = [
            'title' => 'Hello page',
        ];

        require_once Template::get('site_hello');
        return true;
    }
}
```

3. Create a template:

```text
Views/Catalog/Default/site/hello.html
```

4. Open:

```text
/hello.html
```

This is the basic pattern for building pages in Raccon: route, controller, optional model, template.
