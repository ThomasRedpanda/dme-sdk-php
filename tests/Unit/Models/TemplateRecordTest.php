<?php
namespace DnsMadeEasy\Tests\Unit\Models;


use DnsMadeEasy\Client;
use DnsMadeEasy\Enums\GTDLocation;
use DnsMadeEasy\Enums\RecordType;
use DnsMadeEasy\Interfaces\Models\TemplateInterface;
use DnsMadeEasy\Models\ManagedDomain;
use DnsMadeEasy\Models\Template;
use DnsMadeEasy\Models\TemplateRecord;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TemplateRecordTest extends TestCase
{
	public function testTemplateRecordTest(): void
	{
		$client = new Client();

		$managedDomain = new ManagedDomain($client->domains, $client, (object) [
			'id' => 69,
			'updated' => 0,
			'created' => 0,
			'name' => 'zandgolf.nl'
		]);

		$template = new Template($client->templates, $client, (object) [
			'id' => 12,
			'domainIds' => [$managedDomain->id],
			'publicTemplate' => false,
		]);

		$templateRecord = new TemplateRecord($client->templates, $client);

		$templateRecord->populateFromApi((object) [
			'id' => 12,
			'value' => '192.168.1.1',
			'type' => RecordType::A(),
			'name' => 'record-a',
			'source' => 1,
			'sourceId' => 1,
			'dynamicDns' => false,
			'password' => 'secret',
			'ttl' => 111,
			'monitor' => false,
			'failover' => false,
			'failed' => false,
			'gtdLocation' => GTDLocation::EUROPE(),
			'description' => 'a record',
			'keywords' => 'record',
			'title'  => 'zandgolf.nl',
			'hardlink' => false,
			'weight' => 24,
			'priority' => 2,
			'port' => 8080
		]);

		$templateRecord->setTemplate($template);

		/** @var Template $newTemplate */
		$newTemplate = $templateRecord->getTemplate();
		Assert::assertSame(12, $newTemplate->id);

		$records = $newTemplate->getRecords();
		dd($records);
	}
}