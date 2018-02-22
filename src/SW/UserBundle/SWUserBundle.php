<?php

namespace SW\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SWUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
