<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 5)->create();
        
        foreach(App\Tag::all() as $tag){

        	$tag->slug = "tag-".$tag->id;
        	$tag->save();
        }
    }
}
