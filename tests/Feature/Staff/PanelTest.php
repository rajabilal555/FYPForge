<?php
test('staff panel returns a successful response', function () {
    $response = $this->get('/staff');

    $response->assertStatus(200);
});
