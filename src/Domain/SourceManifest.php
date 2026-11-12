<?php

namespace LBHurtado\ProjectOfPrecincts\Domain;

use LBHurtado\ProjectOfPrecincts\Support\CanonicalJson;

final readonly class SourceManifest
{
    /** @param list<array{path: string, sha256: string, media_type: string}> $files */
    public function __construct(
        public string $electionId,
        public string $sourceReference,
        public string $retrievedAt,
        public string $parserVersion,
        public array $files,
        public string $status = 'tentative',
    ) {}

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'package_type' => 'precinct-source-manifest',
            'election_id' => $this->electionId,
            'source_reference' => $this->sourceReference,
            'retrieved_at' => $this->retrievedAt,
            'parser_version' => $this->parserVersion,
            'status' => $this->status,
            'files' => $this->files,
            'package_sha256' => CanonicalJson::sha256($this->files),
        ];
    }
}
