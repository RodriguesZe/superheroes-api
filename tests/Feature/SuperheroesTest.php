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
     * List all superheroes.
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
     * List all superheroes passing valid parameters.
     *
     * @return void
     */
    public function testSuperheroesListWithValidParameters(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.index', ['name' => $superhero->heroName]);
        $response = $this->get($url);

        $response->assertStatus(200)
            ->assertJsonStructure(self::$expectedStructure)
            ->assertJsonFragment([
                'heroName'  => $superhero->heroName,
                'realName'  => $superhero->realName,
                'publisher' => $superhero->publisher,
            ]);
    }

    /**
     * List all superheroes passing invalid parameters.
     *
     * @return void
     */
    public function testSuperheroesListWithInvalidParameters(): void
    {
        $superhero = $this->createCompleteSuperhero();

        // note: the accepted parameter is "name", not "heroName".
        $url = route('superheroes.index', ['heroName' => $superhero->heroName]);
        $response = $this->get($url);

        $response->assertStatus(200)
            ->assertJsonStructure(self::$expectedStructure);
    }

    /**
     * List all superheroes passing invalid parameters.
     *
     * @return void
     */
    public function testSuperheroesListWithNoResults(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.index', ['name' => 'wrong-name']);
        $response = $this->get($url);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
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
     * Edit a superhero.
     */
    public function testEditSuperhero(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.update', [$superhero->id]);

        $payload = [
            'realName'  => 'New name',
        ];

        $response = $this->put($url, $payload);

        $response->assertStatus(204);
    }

    /**
     * Edit a superhero with invalid data.
     */
    public function testEditSuperheroWithInvalidData(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.update', [$superhero->id]);

        $payload = [
            'realName'  => 123,
        ];

        $response = $this->put($url, $payload);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Validation failed.',
                'errors' => [
                    'realName'  => ['The real name must be a string.']
                ]
            ]);
    }

    /**
     * Edit a superhero passing an invalid superhero id.
     */
    public function testEditSuperheroWithInvalidId(): void
    {
        $superhero = $this->createCompleteSuperhero();

        $url = route('superheroes.update', [$this->fakeUUId]);

        $payload = [
            'realName'  => 'New name',
        ];

        $response = $this->put($url, $payload);

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
