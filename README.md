Simple Laravel package that create model, migrations and database columns 

Installation
------------
Copy the following into your composer.json file
```bash
  "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Sagni-prog/ModelModelGenerator.git"
        }
    ],
```

After copying your composer.json will be something like this
```bash

{
    "name": "laravel/laravel",
    "type": "project",
    "description": "The Laravel Framework.",
    "keywords": ["framework", "laravel"],
    "license": "MIT",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Sagni-prog/ModelModelGenerator.git"
        }
    ],
    "require": {
        "php": "^8.0",
        "fruitcake/laravel-cors": "^2.0.5",
        "guzzlehttp/guzzle": "^7.2",
        "laravel/framework": "^9.0",
        "laravel/sanctum": "^2.14",
        "laravel/tinker": "^2.7",
        ...
    },
```
    
    then run the following command
    
```bash
composer require sagni/model
```

Usage
----------------
```bash
php artisan make:schema Post --fields=[post_title=string,post_description=text]
```
After runnig the command the following files will be created in your project 
```php
   <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
	        $table->text('post_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    // ...
}

```
