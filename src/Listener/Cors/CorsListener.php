<?php

namespace App\Listener\Cors;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HeaderListener
 */
class CorsListener
{
	/**
	 * @param GetResponseEvent $event
	 */
	public function onKernelRequest(GetResponseEvent $event)
	{
		if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
			return;
		}
		$request = $event->getRequest();

		if ('OPTIONS' === $request->getMethod()) {
			$response = new Response();
			$response->headers->set('Access-Control-Allow-Credentials', 'true');
			$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
			$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
			$response->headers->set('Access-Control-Max-Age', 3600);
			$event->setResponse($response);

			return;
		}
	}

	/**
	 * @param FilterResponseEvent $event
	 */
	public function onKernelResponse(FilterResponseEvent $event)
	{
		$response = $event->getResponse();
		$response->headers->set('Access-Control-Allow-Credentials', 'true');
		$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
		$response->headers->set('Access-Control-Allow-Origin', '*');
		$response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
		$event->setResponse($response);

		return;
	}
}