<?php

test('student can invite members to project', function () {

    //    \Pest\Laravel\actingAs($user);

    $project = App\Models\Project::factory()->create();

    $response = $this->get('/');

    $response->assertStatus(200);
});
