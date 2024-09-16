<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Indra\Revisor\Facades\Revisor;
use Indra\Revisor\Tests\Models\Page;

beforeEach(function () {
    Revisor::getAllTablesFor('pages')->each(fn ($table) => DB::table($table)->truncate());
});

it('sets is_current to true on save', function () {
    $page = Page::create(['title' => 'Homes']);
    $page->refresh();
    expect($page->is_current)->toBeTrue();
});

it('creates a new version on created only when configured to do so', function () {
    $page = Page::create(['title' => 'Home']);

    expect($page->versions()->count())->toBe(1)
        ->and($page->currentVersion)->toBeInstanceOf(Page::class)
        ->and($page->currentVersion->title)->toBe('Home');

    config()->set('revisor.record_new_version_on_created', false);
    $page = Page::create(['title' => 'About']);
    expect($page->versions()->count())->toBe(0);

    $page = Page::make(['title' => 'Services']);
    $page->recordNewVersionOnCreated();
    $page->save();
    expect($page->versions()->count())->toBe(1);
});

it('can rollback versions', function () {
    $page = Page::create(['title' => 'Home']);
    $page->update(['title' => 'Home 2']);
    $page->update(['title' => 'Home 2']);
    $page->update(['title' => 'Home 2']);

    dd($page->versions()->count());
});
