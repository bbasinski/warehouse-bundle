<?php

namespace Bbasinski\WarehouseBundle\DataFixtures;

use Bbasinski\WarehouseBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $products = [
            [
                'name' => 'Produkt 1',
                'amount' => 4,
            ],
            [
                'name' => 'Produkt 2',
                'amount' => 12,
            ],
            [
                'name' => 'Produkt 5',
                'amount' => 0,
            ],
            [
                'name' => 'Produkt 7',
                'amount' => 6,
            ],
            [
                'name' => 'Produkt 8',
                'amount' => 2,
            ]
        ];

        foreach ($products as $p) {
            $product = new Product();
            $product->setName($p['name']);
            $product->setAmount($p['amount']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
