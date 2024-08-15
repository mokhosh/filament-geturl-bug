<?php

use App\Models\User;
use Filament\Facades\Filament;

use function Pest\Laravel\be;

it('returns proper login links', function () {
    $roles = ['admin', 'editor', 'user'];

    foreach ($roles as $role) {
        $urls[] = Filament::getPanel($role)->getUrl();
    }

    expect($urls)
        ->toBe([
            "http://filament-geturl-bug.test/admin/login",
            "http://filament-geturl-bug.test/editor/login",
            "http://filament-geturl-bug.test/user/login",
        ]);
});

it('fails returning proper login links when authenticated', function () {
    be(User::factory()->create());
    $roles = ['admin', 'editor', 'user'];

    foreach ($roles as $role) {
        $urls[] = Filament::getPanel($role)->getUrl();
    }

    foreach ($roles as $role) {
        $urls2[] = Filament::getPanel($role)->getUrl();
    }

    expect($urls)
        ->toBe([
            "http://filament-geturl-bug.test/admin",
            "http://filament-geturl-bug.test/editor",
            "http://filament-geturl-bug.test/user",
        ])
        ->and($urls2)
        ->toBe([
            "http://filament-geturl-bug.test/admin",
            "http://filament-geturl-bug.test/editor",
            "http://filament-geturl-bug.test/user",
        ]);
});

it('returns proper ids even when authenticated', function () {
    be(User::factory()->create());
    $roles = ['admin', 'editor', 'user'];

    foreach ($roles as $role) {
        $ids[] = Filament::getPanel($role)->getId();
    }

    expect($ids)
        ->toBe([
            "admin",
            "editor",
            "user",
        ]);
});
