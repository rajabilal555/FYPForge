<?php
test('student panel returns a successful response', function () {
    $response = $this->get('/student');

    $response->assertStatus(200);
});
