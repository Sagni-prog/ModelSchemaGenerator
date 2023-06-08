Simple Laravel package that create model, migrations and database columns 

Installation
------------
```bash
composer require --dev samasend/laravel-make-scope
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