<?php

namespace PerseiX\ProjectBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function indexAction()
	{
		return new Response(200);
	}
}
