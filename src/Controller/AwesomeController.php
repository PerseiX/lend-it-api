<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AwesomeController
 * @package App\Controller
 */
class AwesomeController extends Controller
{
	/**
	 * @return Response
	 *
	 * @Route("/index", name="my_index")
	 */
	public function indexAction()
	{
		return new Response("OK");
	}
}