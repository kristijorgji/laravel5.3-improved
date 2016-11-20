<?php
use Illuminate\Database\Seeder;
use Symfony\Component\Finder\Finder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateAll();
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }

    public function truncateAll()
    {
        $files = Finder::create()->in(base_path("database\migrations"))->sortByName();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($files as $file)
        {
            //echo $file->getRealPath() . PHP_EOL;
            $content = $file->getContents();
            if (preg_match("#Schema\:\:create *\('(.*)'#", $content, $out))
            {
                DB::table($out[1])->truncate();
                echo "Truncated: {$out[1]}" . PHP_EOL;
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
