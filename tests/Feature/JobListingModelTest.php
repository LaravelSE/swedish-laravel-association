<?php

use App\Models\JobListing;

test('keyword is derived from the search label', function (string $label, ?string $expected) {
    $job = new JobListing(['search_label' => $label]);

    expect($job->keyword)->toBe($expected);
})->with([
    ['Sweden — Laravel', 'laravel'],
    ['Sweden — PHP', 'php'],
    ['Copenhagen — Symfony', 'symfony'],
    ['Remote EU — Laravel', 'laravel'],
]);

test('keyword is null when there is no search label', function () {
    $job = new JobListing(['search_label' => null]);

    expect($job->keyword)->toBeNull();
});

test('short location keeps only city and country', function (string $location, string $expected) {
    $job = new JobListing(['location' => $location]);

    expect($job->short_location)->toBe($expected);
})->with([
    ['Stockholm, Stockholm County, Sweden', 'Stockholm, Sweden'],
    ['Lund, Skåne County, Sweden', 'Lund, Sweden'],
    ['Copenhagen, Denmark', 'Copenhagen, Denmark'],
    ['European Union', 'European Union'],
    ['Greater Stockholm Metropolitan Area', 'Greater Stockholm Metropolitan Area'],
]);

test('short location is null when location is empty', function () {
    $job = new JobListing(['location' => null]);

    expect($job->short_location)->toBeNull();
});

test('admin-controlled fields are not mass assignable', function () {
    $job = new JobListing([
        'title' => 'Safe Title',
        'status' => 'approved',
        'admin_notes' => 'tampered',
        'company_id' => 999,
        'approved_at' => now(),
        'posted_to_slack_at' => now(),
    ]);

    expect($job->title)->toBe('Safe Title');
    expect($job->status)->not->toBe('approved');
    expect($job->admin_notes)->toBeNull();
    expect($job->company_id)->toBeNull();
    expect($job->approved_at)->toBeNull();
    expect($job->posted_to_slack_at)->toBeNull();
});
