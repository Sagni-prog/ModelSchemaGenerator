<?php

namespace Sagni\Model;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class MakeModelCommand extends Command
{
   
   /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:schema {name}
                                    {--fields=[] }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      
      $name = $this->argument('name');
      $path = base_path();
      
      if (file_exists($this->getMigrationPath($name,$path))) {
        $this->error("Migration ".Str::snake($name)."s" ." already exists.");

        return;
    }
      
     
      $this->createMigration($name,$path);
     
        $path = app_path('Models' . DIRECTORY_SEPARATOR . $name . '.php');

        if (file_exists($path)) {
            $this->error("The model '$name' already exists.");

            return;
        }

        $this->createModelFile($name);

        $this->info("Model '$name' created successfully.");
       
    }

    /**
     * Create the model file.
     *
     * @param string $name
     * @return void
     */
    protected function createModelFile($name)
    {
        $stub = file_get_contents(__DIR__ . '/stubs/model.stub');

        $class = Str::studly($name);

        $content = str_replace('{{ class }}', $class, $stub);

        file_put_contents($this->getPath($name), $content);
    }
    
    protected function createMigration($name, $path){
    

        $table = "'".Str::snake($name)."s"."'";
        $stub = file_get_contents(__DIR__.'./stubs/migration.stub');
        $content = str_replace('{{ table }}',$table,$stub); 
        $pairs = explode(",",trim($this->input->getOption('fields'), "[]"));
          
          $contents = '';
          foreach ($pairs as $pair) {
                 
              list($key, $value) = explode("=", $pair, 2);
              $key = trim($key);
              
              $value = trim($value);
              $contents .= "$"."table->".$value."('".$key."');"."\n\t\t\t"; 
          }
          
          $migration_path = $this->getMigrationPath($name,$path);
          $content = str_replace('{{ columns }}',$contents,$content);
          file_put_contents($migration_path, $content);
          $migration_name = basename($migration_path);
          $this->info("Migration '$migration_name' created successfully.");

    }

    /**
     * Get the path to the model file.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        return app_path('Models' . DIRECTORY_SEPARATOR . $name . '.php');
    }
    
    protected function getMigrationPath($name, $path){
        $path = $path.'/database/migrations';
        return $path.'/'.$this->getDatePrefix().'_create_'.Str::snake($name).'s_table.php';
    }
    
    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }
   
}
