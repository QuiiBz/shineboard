<?php

namespace Tests\Feature;

use Tests\TestCase;

class PasteTest extends TestCase
{
    /**
     * Test if creating paste works
     *
     * @return void
     */
    public function testCreatePaste()
    {
        $data = [

            'user' => 'test',
            'language' => 'yaml',
            'title' => 'Testing',
            'code' => 'Some random code',
        ];

        $response = $this->postJson('/api/paste', $data);

        $response
            ->assertStatus(200)
            ->assertJson([

                'saved' => true,
            ]);
    }

    /**
     * Test fetching the paste with the slug provided
     * in the PasteSeeder
     *
     * @see PasteSeeder
     *
     * @return void
     */
    public function testGetPaste(): void
    {
        $slug = 'a0a0a0';

        $response = $this->getJson('/api/paste/' .$slug);

        $response
            ->assertStatus(200)
            ->assertJson([

                'exist' => true,
            ]);
    }
}
