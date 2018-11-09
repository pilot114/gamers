<?php

namespace App\Cli;

use App\Kernel;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class Generate
{
    public function run()
    {
        $em = Kernel::getORM();

        $faker = Factory::create('ru_RU');
        $populator = new Populator($faker, $em);
        $populator->addEntity(':Game', 10, [
            'name' => function() use ($faker) { return ucfirst($faker->word) .' '. ucfirst($faker->word); },
            'logo' => function() use ($faker) { return $faker->imageUrl(); },
            'created_at' => function() use ($faker) { return $faker->dateTimeBetween('-5 year', '-1 year'); },
            'updated_at' => function() use ($faker) { return $faker->dateTimeBetween('-11 month', 'now'); },
        ]);
        $populator->execute();
    }
}