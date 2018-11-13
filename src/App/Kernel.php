<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;

/**
 * Kernel - суперкласс, который отвечает за многое.
 * Для небольшого проекта это хорошая отправная точка,
 * но в какой-то момент его следует декомпозировать, т.к.
 * такой подход является антипаттерном
 * @package App
 */
class Kernel
{
    const IS_DEV_MODE = true;
    const ROOT_PATH = '/var/www/gamers';

    public static function getORM()
    {
        if (self::IS_DEV_MODE) {
            $cache = new \Doctrine\Common\Cache\ArrayCache;
        } else {
            $cache = new \Doctrine\Common\Cache\FilesystemCache('tmp/cache');
        }

        $config = new Configuration();
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // разработчики Symfony предоставили упрощенную реализацию, с указанием неймспейса НЕ в имени файла
        $driverImpl = new SimplifiedYamlDriver([self::ROOT_PATH . "/config/Entity" => 'Entity'], '.yml');
        $config->setMetadataDriverImpl($driverImpl);

        // настройка прокси классов
        $config->setProxyDir('tmp/proxy');
        $config->setProxyNamespace('Proxy');
        $config->setAutoGenerateProxyClasses(self::IS_DEV_MODE);

        // я совсем ленивый, не хочу писать Entity\ каждый раз при получении репозитория
        $config->addEntityNamespace('', 'Entity');

        //$config->setSQLLogger($logger);

        $conn = [
            'driver' => 'pdo_sqlite',
            'path' => self::ROOT_PATH . '/db.sqlite',
        ];

        return EntityManager::create($conn, $config);
    }

    public static function getDBAL()
    {
        return self::getORM()->getConnection();
    }
}