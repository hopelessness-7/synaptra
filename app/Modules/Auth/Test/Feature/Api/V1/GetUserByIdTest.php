<?php

namespace Modules\Auth\Test\Feature\Api\V1;

use Tests\TestCase;

class GetUserByIdTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
