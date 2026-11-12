<?php

namespace LBHurtado\ProjectOfPrecincts\Domain;

final readonly class Precinct
{
    public function __construct(
        public string $precinctId,
        public string $clusteredPrecinctId,
        public string $pollingPlace,
        public ?string $barangayCode = null,
        public ?string $cityMunicipalityCode = null,
        public ?string $legislativeDistrictCode = null,
        public ?string $provinceCode = null,
        public ?string $regionCode = null,
        public string $status = 'active',
    ) {
        foreach (['precinctId' => $precinctId, 'clusteredPrecinctId' => $clusteredPrecinctId, 'pollingPlace' => $pollingPlace] as $name => $value) {
            if (trim($value) === '') {
                throw new \InvalidArgumentException("{$name} must not be empty.");
            }
        }
    }

    /** @return array<string, ?string> */
    public function toArray(): array
    {
        return [
            'precinct_id' => $this->precinctId,
            'clustered_precinct_id' => $this->clusteredPrecinctId,
            'polling_place' => $this->pollingPlace,
            'barangay_code' => $this->barangayCode,
            'city_municipality_code' => $this->cityMunicipalityCode,
            'legislative_district_code' => $this->legislativeDistrictCode,
            'province_code' => $this->provinceCode,
            'region_code' => $this->regionCode,
            'status' => $this->status,
        ];
    }
}
