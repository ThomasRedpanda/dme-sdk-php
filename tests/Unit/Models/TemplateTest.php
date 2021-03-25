<?php
namespace DnsMadeEasy\Tests\Unit\Models;


use DnsMadeEasy\Client;
use DnsMadeEasy\Models\ManagedDomain;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
	public function testTemplateModel(): void
	{
		$client = new Client();
		$managedDomain = new ManagedDomain($client->domains, $client, (object) [
			'id' => 21,
			'updated' => 0,
			'created'=> 0
		]);
		$template = $client->templates->create();

		$template->populateFromApi((object) [
			'id' => 1,
			'name' => 'templateName',
			'domainIds' => [$managedDomain->id],
			'publicTemplate' => false,
		]);

		Assert::assertSame('templateName', $template->name);
		Assert::assertSame(1, $template->id);
	}
}