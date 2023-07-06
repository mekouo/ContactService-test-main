<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

require __DIR__.'/../../src/ContactService.php';

/**
 * * @covers invalidInputException
 * @covers \ContactService
 *
 * @internal
 */
final class ContactServiceIntegrationTest extends TestCase
{
    private $contactService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->contactService = new ContactService();
    }




    public function testDeleteAll()
                  {

                      static::assertTrue($this->contactService->createContact('Mekouo', 'Riri'));
                      static::assertTrue($this->contactService->createContact('Santa', 'Maria'));
                      $this->contactService->deleteAllContact();
                      static::assertSame(0, count($this->contactService->getAllContacts()));
                  }

    public function testCreationContact()
                  {

                      static::assertTrue($this->contactService->createContact('Santa', 'Maria'));
                      $data = $this->contactService->getAllContacts();
                      static::assertSame('Santa', $data[0]['nom']);
                      static::assertSame('Maria', $data[0]['prenom']);

                  }

    public function testSearchContact()
                  {

                      $this->testCreationContact();
                      static::assertSame(1, count($this->contactService->searchContact('Santa')));
                  }

    public function testModifyContact()
                  {

                      $this->testCreationContact();
                      static::assertTrue($this->contactService->updateContact(1, 'Koko', 'Max'));
                      $data = $this->contactService->getContact(1);
                      static::assertSame('Koko', $data['nom']);
                      static::assertSame('Koko', $data['nom']);
                      static::assertSame('Max', $data['prenom']);
                  }

    public function testDeleteContact()
                  {

                      $this->contactService->deleteContact(1);
                      static::assertSame(0, count($this->contactService->getAllContacts()));
                  }


}
