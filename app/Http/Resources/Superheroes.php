<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class Superheroes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'realName'          => $this->realName,
            'heroName'          => $this->heroName,
            'publisher'         => $this->publisher,
            'firstAppearance'   => $this->firstAppearance,
            'abilities'         => $this->loadAbilities($this->abilities),
            'affiliations'      => $this->loadAffiliations($this->affiliations),
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }

    /**
     * Load all the superheroe's abilities.
     * 
     * @param $abilities
     *
     * @return array
     */
    private function loadAbilities(Collection $abilities): array
    {
        $result = [];

        foreach( $abilities as $ability )
        {
            $result[] = Abilities::make($ability->ability);
        }

        return $result;
    }

    /**
     * Load all the superheroe's affiliations.
     *
     * @param Collection $affiliations
     *
     * @return array
     */
    private function loadAffiliations(Collection $affiliations): array
    {
        $result = [];

        foreach( $affiliations as $affiliation )
        {
            $result[] = Teams::make($affiliation->team);
        }

        return $result;
    }
}
