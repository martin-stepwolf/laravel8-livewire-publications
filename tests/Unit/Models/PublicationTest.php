<?php

namespace Tests\Unit\Models;

use App\Models\Publication;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase
{
    public function test_get_excerpt()
    {
        $publication = new Publication();
        $publication->content = 'Sunt quaerat eveniet hic voluptatem quod quibusdam voluptas. Cum iusto assumenda mollitia ea ut consequuntur. Labore ipsam voluptatem delectus libero ab deserunt. Recusandae ut quia rem quia qui dolorem soluta. Exercitationem saepe vel minus dolore et et maiores.';

        $this->assertEquals('Sunt quaerat eveniet hic voluptatem quod quibusdam voluptas. Cum iusto assu...', $publication->excerpt);
    }
}
