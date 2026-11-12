# Consolidated POP Workbook Requirement

## Position

The EMS should require COMELEC to provide one official, consolidated,
machine-readable Project of Precincts workbook for each election.

The EMS import contract should revolve around that workbook. The system should
not require live crawling of COMELEC web pages during election preparation or
precinct operation.

The COMELEC publication page and any linked regional, overseas, absentee, or
correction files remain useful as public provenance and cross-check material,
but they should not be operational dependencies.

## Required Delivery

For each election, COMELEC should provide:

1. one consolidated POP workbook;
2. a published schema and data dictionary;
3. an election identifier and publication version;
4. an effective date and revision number;
5. stable identifiers for established and clustered precincts;
6. polling-place and jurisdiction fields;
7. explicit overseas-voting rows where applicable;
8. explicit local-absentee-voting rows where applicable;
9. correction and replacement rules; and
10. an authenticated file hash or signed delivery manifest.

The workbook should include all operational populations needed by the EMS,
including regular domestic precincts, NCR districts, overseas voting, local
absentee voting, BARMM or other special election groupings, and any additional
special election-day groupings required by the procurement.

## 2025 Reference Fixture

The initial research fixture is:

`resources/sources/2025NLE/2025NLE_POP.xlsx`

Observed characteristics:

- one worksheet: `FINAL_Clustered.POP_NLE_2025`;
- 93,629 data rows;
- eight columns;
- clustered precinct and established-precinct references;
- polling-place descriptions; and
- dedicated `OV` and `LAV` operational rows.

The fixture SHA-256 is:

`d2843072240c42c7df683d3ea6480895331224b6922d2ef1d6d386492af509f0`

The detailed source manifest and data dictionary are in the same directory.

## Import Behavior

The `project-of-precincts` importer should:

1. verify the source file hash;
2. verify workbook and sheet structure;
3. validate required columns and identifiers;
4. normalize whitespace and text encoding without changing source evidence;
5. preserve the original source values and row references;
6. classify operational modes such as domestic, `OV`, and `LAV`;
7. reject duplicate clustered-precinct identifiers;
8. report missing or contradictory jurisdiction fields;
9. produce a canonical normalized POP package; and
10. record the normalized package hash and parser version.

Schema drift must fail closed. A renamed, missing, or repurposed column must
produce a diagnostic requiring an explicit importer update.

## 2028 Assumption

For current R&D, assume the 2028 workbook has the same logical structure as the
2025 workbook. This is a development fixture assumption, not a claim about the
future COMELEC publication.

The EMS should therefore implement against semantic fields rather than literal
2025 names, and keep the 2025 workbook as a regression fixture. Before a 2028
production import, COMELEC's delivered schema, hash, revision, and coverage
must be verified.

## Boundary

The POP workbook supplies precinct topology and operational groupings. It does
not supply:

- candidate identity;
- candidate eligibility;
- contest limits;
- ballot-style composition;
- OBT layout;
- device assignment; or
- cryptographic approval.

Those remain separate EMS inputs and compilation responsibilities.
