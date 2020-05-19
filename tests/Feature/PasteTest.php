<?php

namespace Tests\Feature;

use Tests\TestCase;

class PasteTest extends TestCase
{
    /**
     * Test if creating a public paste works
     *
     * @return void
     */
    public function testCreatePublicPaste()
    {
        $data = [

            'user' => 'test',
            'language' => 'yaml',
            'title' => 'Testing',
            'code' => 'Some random code',
            'private' => null,
        ];

        $response = $this->postJson('/api/paste', $data);

        $response
            ->assertStatus(200)
            ->assertJson([

                'saved' => true,
            ]);
    }

    /**
     * Test if creating a public paste works
     *
     * @return void
     */
    public function testCreatePrivatePaste()
    {
        $data = [

            'user' => 'test',
            'language' => 'yaml',
            'title' => 'Testing',
            'code' => 'Some random code',
            'private' => 'mypass',
        ];

        $response = $this->postJson('/api/paste', $data);

        $response
            ->assertStatus(200)
            ->assertJson([

                'saved' => true,
            ]);
    }

    /**
     * Test fetching the public paste with the slug
     * provided in the PasteSeeder
     *
     * @see PasteSeeder
     *
     * @return void
     */
    public function testGetPublicPaste(): void
    {
        $slug = 'a0a0a0';

        $response = $this->getJson('/api/paste/get/' .$slug);

        $response
            ->assertStatus(200)
            ->assertJson([

                'exist' => true,
                'private' => null,
            ]);
    }

    /**
     * Test fetching the private paste with the slug
     * provided in the PasteSeeder
     *
     * @see PasteSeeder
     *
     * @return void
     */
    public function testGetPrivatePaste(): void
    {
        $slug = 'a1a1a1';

        $response = $this->getJson('/api/paste/get/' .$slug);

        $response
            ->assertStatus(200)
            ->assertJson([

                'exist' => true,
                'private' => true,
            ]);
    }

    /**
     * Test unlocking the private paste with the slug
     * provided in the PasteSeeder
     *
     * @see PasteSeeder
     *
     * @return void
     */
    public function testUnlockPrivatePaste(): void
    {
        $slug = 'a1a1a1';

        // Test with a bad password
        $password = 'badpassword';

        $response = $this->postJson('/api/paste/unlock', [

            'slug' => $slug,
            'password' => $password,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([

                'success' => false,
            ]);

        // Test with the good password
        $password = 'mypass';

        $response = $this->postJson('/api/paste/unlock', [

            'slug' => $slug,
            'password' => $password,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([

                'success' => true,
                'private' => false,
            ]);
    }
}
