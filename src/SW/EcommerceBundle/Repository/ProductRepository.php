<?php

namespace SW\EcommerceBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
	public function findEnabledFromIdAndSlug($id, $slug) { 
		return $this->findOneBy([
			'id'      => $id,
			'slug'    => $slug,
			'enabled' => true,
		]);
	}
}