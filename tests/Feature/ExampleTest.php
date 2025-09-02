<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    // Since the root route requires authentication, it should redirect to login
    $response->assertRedirect('/login');
});
