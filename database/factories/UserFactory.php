<?php

use Faker\Generator as Faker;
use App\Category;
use App\Post;
use App\Tag;
use App\PostTag;
use App\PostUser;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Category::class, function (Faker $faker) {
	return [
		'name' => implode(" ", $faker->words($nb = 2, $asText = false)),
		'created_at' => $faker->datetimeBetween('-5 months'),
		'updated_at' => $faker->datetimeBetween('-5 months'),
	];
});

$factory->define(Post::class, function (Faker $faker) {
	return [
		'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'description' => $faker->paragraph(5),
		'content' => implode('\n', $faker->paragraphs($nb = 6, $asText = false)),
		'thumnails' => $faker->image($dir = 'public/img'),
		'category_id' => function () {
			$category = Category::inRandomOrder()->first();
			return $category->id;
//str_slug($title);
		},
		'user_id' => function () {
			$user = User::inRandomOrder()->first();
			return $user->id;
//str_slug($title);
		},
		'flag'=>function(){
			return rand(0,1);
		},
		'created_at' => $faker->datetimeBetween('-5 months'),
		'updated_at' => $faker->datetimeBetween('-5 months'),
	];
});

$factory->define(Tag::class, function (Faker $faker) {
	return [
		'name' => $faker->word,
		'created_at' => $faker->datetimeBetween('-5 months'),
		'updated_at' => $faker->datetimeBetween('-5 months'),
	];
});

$factory->define(PostTag::class, function (Faker $faker) {
	return [
		'post_id' => function () {
			$post = Post::inRandomOrder()->first();
			return $post->id;

		},
		'tag_id' => function () {
			$tag = Tag::inRandomOrder()->first();
			return $tag->id;

		},
		'created_at' => $faker->datetimeBetween('-5 months'),
		'updated_at' => $faker->datetimeBetween('-5 months'),
	];
});
