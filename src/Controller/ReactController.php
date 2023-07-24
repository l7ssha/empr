<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ReactController extends AbstractController
{
    #[Route('/{reactRouting}', requirements: ['reactRouting' => '^(?!api).*'])]
    public function indexAction(): Response
    {
        return $this->render('base.html.twig');
    }
}
