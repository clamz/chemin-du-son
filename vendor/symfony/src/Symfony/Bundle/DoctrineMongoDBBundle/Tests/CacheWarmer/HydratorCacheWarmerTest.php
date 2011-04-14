<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\DoctrineMongoDBBundle\Tests\CacheWarmer;

use Symfony\Bundle\DoctrineMongoDBBundle\CacheWarmer\HydratorCacheWarmer;

class HydratorCacheWarmerTest extends \Symfony\Bundle\DoctrineMongoDBBundle\Tests\TestCase
{
    /**
     * This is not necessarily a good test, it doesn't generate any hydrators
     * because there are none in the AnnotationsBundle. However that is
     * rather a task of doctrine to test. We touch the lines here and
     * verify that the container is called correctly for the relevant information.
     *
     * @group DoctrineODMMongoDBHydrator
     */
    public function testWarmCache()
    {
        $testManager = $this->createTestDocumentManager(array(
            __DIR__ . "/../DependencyInjection/Fixtures/Bundles/AnnotationsBundle/Document")
        );

        $container = $this->getMock('Symfony\Component\DependencyInjection\Container');
        $container->expects($this->at(0))
                  ->method('getParameter')
                  ->with($this->equalTo('doctrine.odm.mongodb.hydrator_dir'))
                  ->will($this->returnValue(sys_get_temp_dir()));
        $container->expects($this->at(1))
                  ->method('getParameter')
                  ->with($this->equalTo('doctrine.odm.mongodb.auto_generate_hydrator_classes'))
                  ->will($this->returnValue(false));
        $container->expects($this->at(2))
                  ->method('getParameter')
                  ->with($this->equalTo('doctrine.odm.mongodb.document_managers'))
                  ->will($this->returnValue(array('default', 'foo')));
        $container->expects($this->at(3))
                  ->method('get')
                  ->with($this->equalTo('doctrine.odm.mongodb.default_document_manager'))
                  ->will($this->returnValue($testManager));
        $container->expects($this->at(4))
                  ->method('get')
                  ->with($this->equalTo('doctrine.odm.mongodb.foo_document_manager'))
                  ->will($this->returnValue($testManager));

        $cacheWarmer = new HydratorCacheWarmer($container);
        $cacheWarmer->warmUp(sys_get_temp_dir());
    }

    /**
     * @group DoctrineODMMongoDBHydrator
     */
    public function testSkipWhenHydratorsAreAutoGenerated()
    {
        $testManager = $this->createTestDocumentManager(array(
            __DIR__ . "/../DependencyInjection/Fixtures/Bundles/AnnotationsBundle/Document")
        );

        $container = $this->getMock('Symfony\Component\DependencyInjection\Container');
        $container->expects($this->at(0))
                  ->method('getParameter')
                  ->with($this->equalTo('doctrine.odm.mongodb.hydrator_dir'))
                  ->will($this->returnValue(sys_get_temp_dir()));
        $container->expects($this->at(1))
                  ->method('getParameter')
                  ->with($this->equalTo('doctrine.odm.mongodb.auto_generate_hydrator_classes'))
                  ->will($this->returnValue(true));
        $container->expects($this->at(2))
                  ->method('getParameter')
                  ->with($this->equalTo('assertion'))
                  ->will($this->returnValue(true));

        $cacheWarmer = new HydratorCacheWarmer($container);
        $cacheWarmer->warmUp(sys_get_temp_dir());

        $container->getParameter('assertion'); // check that the assertion is really the third call.
    }

    /**
     * @group DoctrineODMMongoDBHydrator
     */
    public function testHydratorCacheWarmingIsNotOptional()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\Container');
        $cacheWarmer = new HydratorCacheWarmer($container);

        $this->assertFalse($cacheWarmer->isOptional());
    }
}