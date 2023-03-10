<?php

declare(strict_types = 1);

namespace DnsMadeEasy\Models\Concise;

use DnsMadeEasy\Interfaces\Models\Concise\ConciseFolderInterface;
use DnsMadeEasy\Interfaces\Models\FolderInterface;
use DnsMadeEasy\Models\Common\CommonFolder;

/**
 * A concise representation of Folder resources from the API. This is returned from paginate() calls to the manager. The
 * full version of the resource can be requested if required.
 *
 * @package DnsMadeEasy\Models
 *
 * @property-read string $name
 * @property-read FolderInterface $full
 */
class ConciseFolder extends CommonFolder implements ConciseFolderInterface
{
    protected array $props = [
        'name' => null,
    ];

    /**
     * Override the save method, we can't save concise resources, so we don't do anything.
     *
     * @internal
     */
    public function save(): void
    {
    }

    /**
     * Override the refresh method. Refreshing it would fetch the full version of the resource.
     */
    public function refresh(): void
    {
    }

    /**
     * Get the full representation of the Folder.
     */
    protected function getFull(): FolderInterface
    {
        return $this->manager->get($this->id);
    }

    /**
     * Parse the API data and assign it to properties on this model.
     */
    protected function parseApiData(object $data): void
    {
        parent::parseApiData($data);
        $this->props['name'] = $data->label;
    }
}
