# `3neti/project-of-precincts`

Framework-neutral precinct topology and Project of Precincts (POP) primitives
for the WAES EMS. The package represents an immutable, hashable snapshot of
where voting units are organized and where they are assigned to vote.

## Responsibility

This package owns precinct identifiers, clustered-precinct identifiers,
polling-place descriptions, jurisdiction references, precinct status, source
provenance, and deterministic POP serialization and hashing.

It does not own candidate identity, contest limits, ballot layout, OBT
generation, device assignment, ACM initialization, cryptographic trust-roster
administration, or EMS user-interface workflows. It records precinct topology;
it does not silently resolve conflicting jurisdiction data or invent missing
assignments.

## Domain Model

`Precinct` is an immutable normalized record. It requires a precinct ID, a
clustered-precinct ID, and a polling-place description. Jurisdiction fields are
explicit so the same model can represent national, district, city,
municipality, provincial, and barangay scopes.

`ProjectOfPrecincts` is an election-scoped collection and precinct IDs must be
unique within it:

```json
{
  "package_type": "project-of-precincts",
  "schema_version": "project-of-precincts.v1",
  "election_id": "2025NLE",
  "source_reference": "2025NLEPOP",
  "precincts": []
}
```

`SourceManifest` records the source reference, retrieval time, parser version,
status, file paths, and file hashes. It establishes reproducibility for the POP
snapshot; it does not approve the source or assign devices.

## Determinism and Hashing

All public value objects expose `toArray()`. POP hashes are SHA-256 hashes of
the canonical JSON representation produced by the package. The EMS should
persist the source manifest and POP hash beside every ballot-style and precinct
package output.

## Import Boundary

`PrecinctSourceImporter` is the adapter boundary for POP imports. A future
importer may read a COMELEC PDF, spreadsheet, or other published source, but it
must produce a `SourceManifest` and normalized `ProjectOfPrecincts`.
Source-specific parsing and jurisdiction reconciliation do not belong in the
domain objects.

```php
use LBHurtado\ProjectOfPrecincts\Domain\Precinct;
use LBHurtado\ProjectOfPrecincts\Domain\ProjectOfPrecincts;

$pop = new ProjectOfPrecincts('2025NLE', [
    new Precinct('P-001', 'CP-001', 'Manila Elementary School',
        cityMunicipalityCode: 'MANILA',
        legislativeDistrictCode: 'MANILA-1'),
], '2025NLEPOP');

$popHash = $pop->hash();
```

## EMS Relationship

```text
POP source snapshot -> project-of-precincts -> ballot-style resolver -> precinct-package compiler
```

The package deliberately stops before device assignment and ACM custody. Those
are operational outputs of the EMS and precinct-provisioning workflow.

## Current Status

This is a domain scaffold with immutable records, canonical hashing,
validation, an importer port, and focused tests. A production POP parser,
jurisdiction reconciliation rules, and source-format conformance fixtures
remain EMS work.

## Development

```bash
composer install
vendor/bin/pest
```

The package is PHP 8.4+, framework-neutral, and uses no external runtime
dependencies.
