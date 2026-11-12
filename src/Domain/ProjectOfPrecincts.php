<?php

namespace LBHurtado\ProjectOfPrecincts\Domain;

use LBHurtado\ProjectOfPrecincts\Support\CanonicalJson;

final readonly class ProjectOfPrecincts
{
    /** @param list<Precinct> $precincts */
    public function __construct(
        public string $electionId,
        public array $precincts,
        public string $sourceReference,
        public string $schemaVersion = 'project-of-precincts.v1',
    ) {
        if (trim($this->electionId) === '' || trim($this->sourceReference) === '') {
            throw new \InvalidArgumentException('Election and source references must not be empty.');
        }
        $ids = array_map(static fn (Precinct $precinct): string => $precinct->precinctId, $precincts);
        if (count($ids) !== count(array_unique($ids))) {
            throw new \InvalidArgumentException('Precinct IDs must be unique within a POP.');
        }
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'package_type' => 'project-of-precincts',
            'schema_version' => $this->schemaVersion,
            'election_id' => $this->electionId,
            'source_reference' => $this->sourceReference,
            'precincts' => array_map(static fn (Precinct $precinct): array => $precinct->toArray(), $this->precincts),
        ];
    }

    public function hash(): string
    {
        return CanonicalJson::sha256($this->toArray());
    }
}
