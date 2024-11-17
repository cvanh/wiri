<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Company;
use App\Factory\CompanyFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class CompanyTest extends ApiTestCase
{
    use ResetDatabase, Factories;

    public function testGetCollection(): void
    {
        CompanyFactory::createMany(100);

        $response = static::createClient()->request('GET', '/api/companies');

        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        self::assertJsonContains([
            '@context' => '/api/contexts/Company',
            '@id' => '/api/companies',
            '@type' => 'Collection',
            'totalItems' => 100,
            'view' => [
                '@id' => '/api/companies?page=1',
                '@type' => 'PartialCollectionView',
                'first' => '/api/companies?page=1',
                'last' => '/api/companies?page=4',
                'next' => '/api/companies?page=2',
            ],
        ]);

        // Because test fixtures are automatically loaded between each test, you can assert on them
        self::assertCount(30, $response->toArray()['member']);

        self::assertMatchesResourceCollectionJsonSchema(Company::class);
    }
}
