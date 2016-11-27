<?php
namespace Blackford\TwilioBundle\Tests\DependencyInjection;

use Blackford\TwilioBundle\Service\TwilioLookupsWrapper;
use Blackford\TwilioBundle\Service\TwilioWrapper,
    Blackford\TwilioBundle\Service\TwilioCapabilityWrapper;

/**
 * Test the TwilioWrapper
 *
 * @author Fridolin Koch <info@fridokoch.de>
 *
 */
class TwilioWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testTwilioWrapper()
    {
        $twilio = new TwilioWrapper('AAAA', 'XXXX');
        //check if instance
        $this->assertInstanceOf('Blackford\TwilioBundle\Service\TwilioWrapper', $twilio);
    }

    /**
     * @test
     */
    public function testCreateInstance()
    {
        $twilio = new TwilioWrapper('AAAA', 'XXXX');
        //create other instance
        $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');
        //check class
        $this->assertInstanceOf('\Services_Twilio', $otherInstance);
    }

    /**
     * @test
     */
    public function testCapabilityWrapper()
    {
        $twilio = new TwilioCapabilityWrapper('AAAA', 'XXXX');
        //check class
        $this->assertInstanceOf('\Services_Twilio_Capability', $twilio);
    }

    /**
     * @test
     */
    public function testCapabilityCreateInstance()
    {
        $twilio = new TwilioCapabilityWrapper('AAAA', 'XXXX');
        //create other instance
        $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');
        //check class
        $this->assertInstanceOf('\Services_Twilio_Capability', $otherInstance);
    }

    /**
     * @test
     */
    public function testLookupsWrapper()
    {
        $twilio = new TwilioLookupsWrapper('AAAA', 'XXXX');
        //check class
        $this->assertInstanceOf('\Lookups_Services_Twilio', $twilio);
    }
}
