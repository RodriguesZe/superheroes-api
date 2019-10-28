<?php

namespace App\Services\Search;

use App\Models\Superhero;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SearchService
{
    /**
     * @var Superhero
     */
    protected $superheroModel;

    /**
     * SuperheroesService constructor.
     *
     * @param Superhero $superheroModel
     */
    public function __construct( Superhero $superheroModel )
    {
        $this->superheroModel = $superheroModel;
    }

    /**
     * List superheroes.
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function index(array $filters)
    {
        return self::apply($this->superheroModel, $filters);
    }

    /**
     * @param Model $model
     * @param array $filters
     *
     * @return mixed
     */
    public static function apply(Model $model, array $filters)
    {
        $query = static::applyDecoratorsFromRequest( $filters, $model->newQuery() );

        return static::getResults($query);
    }

    /**
     * @param array   $filters
     * @param Builder $query
     *
     * @return Builder
     */
    private static function applyDecoratorsFromRequest(array $filters, Builder $query): Builder
    {
        foreach( $filters as $filterName => $value )
        {
            $decorator = static::createFilterDecorator($filterName);

            if( static::isValidDecorator($decorator) )
            {
                $query = $decorator::apply($query, $value);
            }

        }

        return $query;
    }

    /**
     * Get namespace of called class.
     *
     * @param $name
     * @return string
     */
    protected static function createFilterDecorator($name): string
    {
        $parentNamespace = substr(static::class, 0, strrpos(static::class, "\\"));

        return $parentNamespace . '\\Filters\\' . ucfirst($name);
    }

    /**
     * Check if decorator class exists and implements interface FilterInterface.
     *
     * @param $decorator
     * @return bool
     */
    protected static function isValidDecorator(string $decorator): bool
    {
        return class_exists($decorator);
    }

    /**
     * Get the desired results.
     *
     * @param Builder $query
     * @return Builder[]|Collection
     */
    protected static function getResults(Builder $query)
    {
        return $query->get();
    }
}
