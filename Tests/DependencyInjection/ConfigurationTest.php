<?php
declare(strict_types=1);

namespace Webonaute\TwilioBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Webonaute\TwilioBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ArrayNode;
use Symfony\Component\Config\Definition\ScalarNode;

/**
 * Test the configuration tree
 *
 * @author Fridolin Koch <info@fridokoch.de>
 *
 */
class ConfigurationTest extends TestCase
{
    public function testGetConfigTreeBuilder()
    {
        $config = new Configuration();

        /** @var ArrayNode $tree */
        $tree = $config->getConfigTreeBuilder()->buildTree();

        // Check root name
        $this->assertEquals('twilio', $tree->getName());

        // Get child nodes and check them
        /** @var ScalarNode[] $children  */
        $children = $tree->getChildren();

        // Check length
        $this->assertEquals(4, count($children));

        // Check if all config values are available
        $this->assertArrayHasKey('username', $children);
        $this->assertArrayHasKey('password', $children);
        $this->assertArrayHasKey('accountSid', $children);
        $this->assertArrayHasKey('region', $children);
    }
}
