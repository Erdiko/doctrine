<?php
namespace erdiko\doctrine;

class EntityManager
{
	public static function getEntityManager($db = null)
	{
        // Get db config info from file
        $dbConfig = \Erdiko::getConfig('local/database');
        if($db == null)
            $db = $dbConfig['default'];
        $dbParams = $dbConfig['connections'][$db];
        $dbParams['dbname'] = $dbParams['database'];

		$paths = array(APPROOT."/entities");
     	$isDevMode = true;
      	$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
      	
        // Create and return the entity manager
		return \Doctrine\ORM\EntityManager::create($dbParams, $config);
	}

	/**
	 * Update a single record
	 * Convenience method to update a row.  
	 * You should use the Doctrine EntityManager directly to take control of the Entity merge process.
     * @note do we need this?
	 */
	public static function update($entity)
	{
		$entityManager = self::getEntityManager();
    	$entity = $entityManager->merge($entity);
		$entityManager->flush(); // transact

		return $entity;
	}
}