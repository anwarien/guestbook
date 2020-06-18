<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
			return new Response(<<<EOF
				<html>
					<body>
						<img src="/images/under_construction.png" />
					</body>
				</html>
				EOF
			);
    }
}
