<?php

declare(strict_types = 1);

namespace DnsMadeEasy\Managers;

use DnsMadeEasy\Interfaces\Managers\ContactListManagerInterface;
use DnsMadeEasy\Interfaces\Models\ContactListInterface;
use DnsMadeEasy\Interfaces\Traits\ListableManagerInterface;
use DnsMadeEasy\Models\ContactList;
use DnsMadeEasy\Traits\ListableManager;

/**
 * Represents a Contact List API resource.
 *
 * @package DnsMadeEasy\Managers
 */
class ContactListManager extends AbstractManager implements ContactListManagerInterface, ListableManagerInterface
{
    use ListableManager;

    protected string $model = ContactList::class;

    /**
     * The base URI for contact lists.
     */
    protected string $baseUri = '/contactList';

    public function create(): ContactListInterface
    {
        return $this->createObject();
    }

    public function get(int $id): ContactListInterface
    {
        return $this->getObject($id);
    }
}
