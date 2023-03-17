<?php
// tests/Form/InstancesFormTest.php
namespace App\Tests;

use App\Entity\Instances;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InstancesFormTest extends KernelTestCase
{
    public function testGetNameInstance()
    {
        $instance = new Instances();
        $name = 'Instance 1';
        $instance->setNameInstance($name);

        $this->assertSame($name, $instance->getNameInstance());
    }

    public function testGetId()
    {
        $instance = new Instances();
        $this->assertNull($instance->getId());
    }
}
