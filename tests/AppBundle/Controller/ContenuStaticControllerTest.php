<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContenuStaticControllerTest extends WebTestCase
{
    private $client = null;

    public function testIndexPage()
    {

        $this->client->request('GET', '/');

        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/contenu page accueil a completer/',
            $this->client->getResponse()->getContent());

    }

    public function testLuttePage()
    {

        $this->client->request('GET', '/lutte/presentation');

        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/contenu page lutte a completer/',
            $this->client->getResponse()->getContent());

    }
    public function testFitnessPage()
    {

        $this->client->request('GET', '/fitness/presentation');

        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/contenu page fitness a completer/',
            $this->client->getResponse()->getContent());

    }

    public function testMusculationPage()
    {

        $this->client->request('GET', '/musculation/presentation');

        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/contenu page musculation a completer/',
            $this->client->getResponse()->getContent());

    }

    public function testGrapplingPage()
    {

        $this->client->request('GET', '/grappling/presentation');

        $this->assertEquals(301, $this->client->getResponse()->getStatusCode());
        $this->assertRegexp(
            '/contenu page grappling a completer/',
            $this->client->getResponse()->getContent());

    }

    public function setUp()
    {
        $this->client = static::createClient();

    }

}
