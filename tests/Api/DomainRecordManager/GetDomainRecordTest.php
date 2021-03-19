<?php
namespace DnsMadeEasy\Tests\Api\DomainRecordManager;

use DnsMadeEasy\Client;
use DnsMadeEasy\Managers\DomainRecordManager;
use DnsMadeEasy\Models\ManagedDomain;
use DnsMadeEasy\Tests\Api\ApiTestCase;

class GetDomainRecordTest extends ApiTestCase
{

	public function testGetDomainRecord(): void
	{
		$client = new Client();
		$manager = new DomainRecordManager($client);
		$domain = new ManagedDomain($manager, $client, (object) [
			'id' => 1119443,
			'updated' => 1504807431610,
			'created' => 1504807431610,
		]);

		$recordClient = $this->getMockedClient(
			200,
			(string) file_get_contents(__DIR__ . '/data/domain_records_get_success.json'),
			self::assertRoute('GET', '/V2.0/dns/managed/1119443/records')
		);

		$domainRecordManager = new DomainRecordManager($recordClient);

		$domainRecordManager->setDomain($domain);
		$record = $domainRecordManager->get(1119443);
		dd($record);

	}
}