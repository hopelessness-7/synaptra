<?php

namespace Modules\Auth\Test\Feature\Api\V1;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
