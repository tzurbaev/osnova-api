<?php

namespace Osnova\Tests\Unit;

use Osnova\Services\Subsites\Traits\SubsitesService;
use Osnova\Services\Timeline\Traits\TimelineService;
use Osnova\Tests\TestCase;
use Osnova\TJournal;

class TJournalTest extends TestCase
{
    /**
     * @param string $service
     * @dataProvider requiredServicesDataProvider
     */
    public function testItShouldHaveRequiredServices(string $service)
    {
        $uses = class_uses(new TJournal($this->apiProviderMock()));

        $this->assertSame($service, $uses[$service]);
    }

    public function requiredServicesDataProvider()
    {
        return [
            ['service' => TimelineService::class],
            ['service' => SubsitesService::class],
        ];
    }
}
