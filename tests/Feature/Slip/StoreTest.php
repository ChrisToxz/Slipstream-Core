<?php

it('shows errors if file is not valid', function () {
    $this->post(route('slips.tempupload'))
        ->assertSessionHasErrors();
});
