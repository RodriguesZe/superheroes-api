<?php

namespace Tests\Feature;

use App\Models\Ability;
use App\Models\Superhero;
use App\Models\SuperheroAbility;
use App\Models\Team;
use App\Models\TeamAffiliate;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperheroesTest extends TestCase
{
    use DatabaseTransactions;

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

    static protected $expectedItemStructure = [
        'data' => [
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
    ];

    static protected $notFoundError = [
        'message'   => 'Superhero not found.',
    ];

    protected $fakeUUId = '22d19587b28e4f55a034476d7a10d0fa';

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

    /**
     * Get a superhero details.
     */
    public function testSuperheroesDetails(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.show', [$superhero->id]);

        $response = $this->get($url);

        $response->assertStatus(200)
            ->assertJsonStructure(self::$expectedItemStructure);
    }

    /**
     * Request the details of a non-existing superhero.
     */
    public function testSuperheroesDetailsNotFound(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.show', [$this->fakeUUId]);

        $response = $this->get($url);

        $response->assertStatus(404)
            ->assertJson(self::$notFoundError);
    }

    /**
     * Add a new superhero to the database, with all its characteristics.
     *
     * @return Superhero
     */
    private function createCompleteSuperhero(): Superhero
    {
        $superhero = factory(Superhero::class)->create();

        $ability = factory(Ability::class)->create();

        $team = factory(Team::class)->create();

        $superheroAbility = factory(SuperheroAbility::class)->create([
            'idSuperhero'   => $superhero->id,
            'idAbility'     => $ability->id,
        ]);
        $superheroTeam = factory(TeamAffiliate::class)->create([
            'idTeam'        => $team->id,
            'idSuperhero'   => $superhero->id,
        ]);

        return $superhero;
    }
}
