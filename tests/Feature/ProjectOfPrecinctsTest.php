<?php

use LBHurtado\ProjectOfPrecincts\Domain\Precinct;
use LBHurtado\ProjectOfPrecincts\Domain\ProjectOfPrecincts;

it('creates a deterministic project of precincts', function (): void {
    $pop = new ProjectOfPrecincts('2025NLE', [
        new Precinct('P-001', 'CP-001', 'Manila Elementary School'),
    ], '2025NLEPOP');

    expect($pop->toArray()['package_type'])->toBe('project-of-precincts')
        ->and($pop->hash())->toHaveLength(64);
});

it('rejects duplicate precinct IDs', function (): void {
    expect(fn (): ProjectOfPrecincts => new ProjectOfPrecincts('2025NLE', [
        new Precinct('DUP', 'CP-001', 'School A'),
        new Precinct('DUP', 'CP-002', 'School B'),
    ], '2025NLEPOP'))->toThrow(InvalidArgumentException::class);
});
