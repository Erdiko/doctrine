<?php
/**
 * EntityTrait
 *
 * Convenient db traits to be used with models and service models
 *
 * @package     erdiko/doctrine
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\doctrine\models;

trait EntityTrait
{
    protected $entityManager = null;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * getEntityManager
     *
     * @return \Doctrine\ORM\EntityManager $em
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * getRepository
     *
     * @param string $entityName, the name of the entity
     * @param string $db, name of the db to connect to
     * @return \Doctrine\ORM\EntityRepository The repository class
     */
    public function getRepository($entityName)
    {
        try {
            return $this->getEntityManager()->getRepository($entityName);
        } catch (MappingException $e) {
            throw new \Exception("Entity $entityName not found.", $e->getCode(), $e);
        } catch (ORMException $e) {
            throw new \Exception("Invalid database configuration.", $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}
