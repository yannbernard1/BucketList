<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use App\Services\MonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'pokemon')]
    public function index(
        PokemonRepository $pokemonRepository,
        MonService        $svc
    ): Response
    {
        $promo = $svc->uneMethode();
        $pokemons = $pokemonRepository->findPokemonsWithDresseurAndTypes();
        dump($pokemons);
        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
            'pokemons' => $pokemons,
            'promo' => $promo
        ]);
    }
}
