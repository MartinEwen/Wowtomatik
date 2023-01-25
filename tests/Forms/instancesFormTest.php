<?php
// tests/Form/ProductsFormTest.php
namespace App\Tests\Form;

use App\Entity\Instances;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InstancesFormTest extends KernelTestCase
{
    public function testNewInstances()
    {
        $instances = (new Instances())
            ->setNameInstance('azerty');
        self::bootKernel();
        $container = static::getContainer();
        $error = $container->get('validator')->validate($instances);
        $this->assertCount(0, $error);
    }
}
