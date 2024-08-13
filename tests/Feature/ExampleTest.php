<?php

it('returns proper login links', function () {
    $roles = ['admin', 'editor', 'user'];

    foreach ($roles as $role) {
        $urls[] = \Filament\Facades\Filament::getPanel($role)->getUrl();
    }

    expect($urls)
        ->toBe([
            "http://filament-geturl-bug.test/admin/login",
            "http://filament-geturl-bug.test/editor/login",
            "http://filament-geturl-bug.test/user/login",
        ]);
});
