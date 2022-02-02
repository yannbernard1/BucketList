<?php

namespace App\Services;

use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManager;

class MonService
{
    protected $depotPokemon;

    public function __construct(
        PokemonRepository $depotInjecte
    )
    {
        $this->depotPokemon = $depotInjecte;
    }


    public function uneMethode(): array
    {
        $pokemons = $this->depotPokemon->findAll();
        //return "DWWM142";
        return $pokemons;
    }
}