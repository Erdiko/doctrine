<?php
/**
 * EntityManager
 *
 * @package     erdiko/doctrine
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\doctrine;

class EntityManager
{
    /**
    * Get Doctrine entity manager
    * @param array $config
    * @param string $db, default to the 'default' database in the config
    */
    public static function getEntityManager($dbConfig, $db = null)
    {
        if($db == null)
            $db = $dbConfig['default'];
        $dbParams = $dbConfig['connections'][$db];
        $dbParams['dbname'] = $dbParams['database'];
        $dbParams['user'] = $dbParams['username'];

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $dbConfig['meta']['entities'], $dbConfig['meta']['is_dev_mode']);

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
