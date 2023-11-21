<?php

test('advisor panel returns a successful response', function () {
    $response = $this->get('/advisor');

    $response->assertStatus(200);
});
