<?php

namespace App\Test\Controller;

use App\Entity\AReservation;
use App\Repository\AReservationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AReservationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AReservationRepository $repository;
    private string $path = '/a/reservation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(AReservation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('AReservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'a_reservation[rdateentree]' => 'Testing',
            'a_reservation[rnombremois]' => 'Testing',
            'a_reservation[rcontrat]' => 'Testing',
            'a_reservation[rannonce]' => 'Testing',
            'a_reservation[rclient]' => 'Testing',
        ]);

        self::assertResponseRedirects('/a/reservation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new AReservation();
        $fixture->setRdateentree('My Title');
        $fixture->setRnombremois('My Title');
        $fixture->setRcontrat('My Title');
        $fixture->setRannonce('My Title');
        $fixture->setRclient('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('AReservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new AReservation();
        $fixture->setRdateentree('My Title');
        $fixture->setRnombremois('My Title');
        $fixture->setRcontrat('My Title');
        $fixture->setRannonce('My Title');
        $fixture->setRclient('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'a_reservation[rdateentree]' => 'Something New',
            'a_reservation[rnombremois]' => 'Something New',
            'a_reservation[rcontrat]' => 'Something New',
            'a_reservation[rannonce]' => 'Something New',
            'a_reservation[rclient]' => 'Something New',
        ]);

        self::assertResponseRedirects('/a/reservation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getRdateentree());
        self::assertSame('Something New', $fixture[0]->getRnombremois());
        self::assertSame('Something New', $fixture[0]->getRcontrat());
        self::assertSame('Something New', $fixture[0]->getRannonce());
        self::assertSame('Something New', $fixture[0]->getRclient());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new AReservation();
        $fixture->setRdateentree('My Title');
        $fixture->setRnombremois('My Title');
        $fixture->setRcontrat('My Title');
        $fixture->setRannonce('My Title');
        $fixture->setRclient('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/a/reservation/');
    }
}
