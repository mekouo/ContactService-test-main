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

require __DIR__ . '/../../src/ContactService.php';

/**
 * * @covers invalidInputException
 * @covers \ContactService
 *
 * @internal
 */
final class ContactServiceUnitTest extends TestCase {
    private $contactService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->contactService = new ContactService();
    }

  public function testCreationContactWithoutAnyText() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('le nom  doit être renseigné');
         $this->contactService->createContact('', '');
     }

     public function testCreationContactWithoutName() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('le nom  doit être renseigné');
         $this->contactService->createContact('', 'Riri');
     }

     public function testCreationContactWithoutPrenom() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('le prenom doit être renseigné');
         $this->contactService->createContact('Mekouo', '');
     }

     public function testCreationContactWithNomPrenom() {
         $Val = $this->contactService->createContact('Mekouo', 'Riri');
         self::assertTrue($Val);
     }

     public function testGetContactWithoutId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être renseigné");
         $this->contactService->getContact('');
     }

     public function testGetContactWithIdNotNullOrNegative() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->getContact('-2');
     }

     public function testGetContactWithIdNotNumeric() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->getContact('dce');
     }

     public function testGetContactWithId() {
         $Var = $this->contactService->getContact(4);
         self::assertIsArray($Var);
     }

     public function testsearchContactWithoutAnth() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('search doit être renseigné');
         $this->contactService->searchContact('');
     }

     public function testSearchContactWithSearchNotString() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('search doit être une chaine de caractères');
         $this->contactService->searchContact(789);
     }

     public function testSearchContactWithName() {
         $Valeur = $this->contactService->searchContact('Mekouo');
         self::assertIsArray($Valeur);
     }

     public function testSearchContactWithPrenom() {
         $Valeur = $this->contactService->searchContact('Riri');
         self::assertIsArray($Valeur);
     }

     public function testgetAllContact() {
         $Valeur = $this->contactService->getAllContacts();
         self::assertIsArray($Valeur);
     }

     public function testUpdateContactWithoutName() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('le nom  doit être renseigné');
         $this->contactService->updateContact('8','','riri');
     }

     public function testUpdateContactWithNameNotString() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage('le nom  doit être renseigné');
         $this->contactService->updateContact('1',245,'riri');
     }

     public function testUpdateContactWithoutId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être renseigné");
         $this->contactService->updateContact('','Mekouo','Riri');
     }

     public function testUpdateContactWithIdNotNumeric() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->updateContact('wate','Mekouo','Riri');
     }

     public function testUpdateContactWithnegativeId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->updateContact('-4','Mekouo','Riri');
     }

     public function testUpdateContactWithNomPrenomId() {
         $Value = $this->contactService->updateContact('8','Mekouo', 'Riri');
         self::assertTrue($Value);
     }

     public function testDeleteContactWithoutId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être renseigné");
         $this->contactService->deleteContact(null);
     }



     public function testDeleteContactWithNotNumericId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->deleteContact('fgtz');
     }

     public function testDeleteContactWithNegativeId() {
         $this->expectException(invalidInputException::class);
         $this->expectExceptionMessage("l'id doit être un entier non nul");
         $this->contactService->deleteContact('-1');
     }

     /* public function testDeleteAllContact() {
         $Valeure = $this->contactService->deleteAllContacts();
         self::assertNotFalse($Valeure);
     }  */
}
