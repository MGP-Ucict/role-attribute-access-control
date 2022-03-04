Package that implements access control model Hybrid Role Attribute Based Access Control with Connecting Attributes (HRABACCA)

It provides fine-grained access control.

1.Install package
composer require laravel-hrabac/access-control

2.Register package middleware in app/Http/Kernel.php
protected $routeMiddleware = [
					//...
					'can.access' => \LaravelHrabac\AccessControl\Middleware\CanAccess::class,
				];
3. Publish the interfaces of the package	
	
php artisan vendor:publish --provider="LaravelHrabac\AccessControl\AccessControlServiceProvider"


4. In the terminal:

php artisan migrate

5.In the terminal:

composer dump-autoload

6.In the terminal:

php artisan laravelroles:seeder

Class User from main laravel project extends LaravelHrabac\AccessControl\\Models\User

User.php:

use LaravelHrabac\AccessControl\Models\User as BaseUser;


class User extends BaseUser

{


}
Set localization in config/app.php - bg or en

Log in main program with example user test@test.bg and password test