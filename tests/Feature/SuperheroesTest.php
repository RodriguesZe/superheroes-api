<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperheroesTest extends TestCase
{
    static protected $expectedStructure = [
        'data' => [
            '*' => [
                'id',
                'realName', 'heroName', 'publisher', 'firstAppearance',
                'abilities' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'affiliations' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'created_at',
                'updated_at',
            ]
        ]
    ];

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuperheroesList(): void
    {
        $url = route('superheroes.index');
        $response = $this->get($url);

        $response->assertStatus(200)
            ->assertJsonStructure(self::$expectedStructure);
    }
}
