<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $book = new Book();
            $book->setTitle(ucfirst($this->faker->word) . ' ' . ucfirst($this->faker->word));
            $book->setDescription($this->getBookDescription(rand(4,10)));
            $book->setAuthor($this->faker->name);
            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getBookDescription(int $words = 5): string
    {
        $description = ucfirst($this->faker->word);
        for ($j = 1; $j < $words; $j++) {
            $description .= ' ' . $this->faker->word;
        }
        return $description;
    }
}
