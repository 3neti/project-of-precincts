# 2025 NLE POP Source Fixture

This directory contains the official COMELEC consolidated Project of Precincts
workbook used for initial EMS research:

`2025NLE_POP.xlsx`

Source URL:

<https://www.comelec.gov.ph/php-tpls-attachments/2025NLE/2025NLEPOP/2025NLE_POP.xlsx>

## Observed Structure

- Workbook sheets: `FINAL_Clustered.POP_NLE_2025`
- Header row: 1
- Data rows: 93,629
- Columns: 8
- SHA-256: `d2843072240c42c7df683d3ea6480895331224b6922d2ef1d6d386492af509f0`

| Column | Meaning |
|---|---|
| `REGION` | Region or operational grouping, including `OV` and `LAV` |
| `PROVINCE` | Province or operational grouping |
| `CITY_MUNICIPALITY` | City, municipality, or operational grouping |
| `BARANGAY` | Barangay or operational grouping |
| `CLUSTERED_PRECINCT` | Clustered precinct identifier |
| `PRECINCT_CLUSTER` | Comma-separated established precinct identifiers in the cluster |
| `CLUSTERTOTAL` | Registered-voter total for the clustered precinct |
| `POLLING_PLACE` | Polling-place description |

Observed operational groupings include:

- regular domestic regions and provinces;
- `NCR` and its district groupings;
- `BARMM` and the Special Geographic Area;
- `OV` for overseas voting; and
- `LAV` for local absentee voting.

The workbook therefore provides a useful single-file research input for the
precinct topology domain. It does not by itself define candidates, contest
limits, ballot layouts, or OBTs.

## 2028 Working Assumption

For R&D, assume COMELEC will provide one consolidated workbook with the same
logical contract for 2028. The EMS should not depend on the literal 2025 sheet
name or column spelling. The production requirement should require:

1. one consolidated machine-readable POP workbook;
2. a documented schema and data dictionary;
3. stable identifiers for clustered precincts and established precincts;
4. explicit operational rows for overseas and local absentee voting;
5. publication version and effective date;
6. correction and replacement procedure; and
7. a signed or otherwise authenticated file hash.

If the 2028 workbook changes schema, the importer must fail with a visible
schema-drift report rather than silently reinterpreting columns.
