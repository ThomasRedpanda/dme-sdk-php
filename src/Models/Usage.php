<?php

declare(strict_types = 1);

namespace DnsMadeEasy\Models;

use DnsMadeEasy\Interfaces\Models\ManagedDomainInterface;
use DnsMadeEasy\Interfaces\Models\UsageInterface;

/**
 * Represents Query Usage statistics.
 *
 * @package DnsMadeEasy\Models
 *
 * @property-read int $primaryCount
 * @property-read int $primaryTotal
 * @property-read int $secondaryCount
 * @property-read int $secondaryTotal
 * @property-read int[] $listOfMonths
 * @property-read int[] $listOfYears
 * @property-read int $month
 * @property-read int $day
 * @property-read int $accountId
 * @property-read int $total
 * @property-read int $domainId
 * @property-read ManagedDomainInterface $domain
 */
class Usage extends AbstractModel implements UsageInterface
{
    protected array $props = [
        'primaryCount' => null,
        'primaryTotal' => null,
        'secondaryCount' => null,
        'secondaryTotal' => null,
        'listOfMonths' => [],
        'listOfYears' => [],
        'month' => null,
        'day' => null,
        'accountId' => null,
        'total' => null,
        'domainId' => null,
    ];

    /**
     * Since there's no string representation of usage, just return 'Usage'.
     *
     * @internal
     */
    public function __toString(): string
    {
        return 'Usage';
    }

    /**
     * Usage is read-only and can't be saved.
     */
    public function save(): void
    {
    }

    /**
     * Usage is read-only and can't be deleted.
     */
    public function delete(): void
    {
    }

    /**
     * Usage is read-only and can't be refreshed.
     */
    public function refresh(): void
    {
    }

    /**
     * Get the domain associated with the usage.
     */
    protected function getDomain(): ?ManagedDomainInterface
    {
        if ($this->domainId === null) {
            return null;
        }
        return $this->client->domain->get($this->domainId);
    }
}
