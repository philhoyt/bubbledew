# Fonts

Both families are licensed under the SIL Open Font License 1.1; the licence text
ships alongside the files (`LICENSE-fredoka.txt`, `LICENSE-nunito.txt`). The files are
the variable weight-axis subsets published by Fontsource, taken from the npm registry
with `npm pack` so the source is pinned and reproducible.

| File | Source package | Version | SHA-256 |
| --- | --- | --- | --- |
| `fredoka-latin-wght-normal.woff2` | `@fontsource-variable/fredoka` | 5.3.0 | `99d6c78e043710d4f83ed90716779798b7b04eb690f73e0ad0e8f32d1f0e98c2` |
| `fredoka-latin-ext-wght-normal.woff2` | `@fontsource-variable/fredoka` | 5.3.0 | `18a1723c878c0d8acc2e45a108fd62fbb976e408337804afa2908982fac13e2a` |
| `nunito-latin-wght-normal.woff2` | `@fontsource-variable/nunito` | 5.3.0 | `ba344451eab25b217a165363b1982048a5e5830a0daf36577973955a04cac793` |
| `nunito-latin-wght-italic.woff2` | `@fontsource-variable/nunito` | 5.3.0 | `6cfcc3786d5ba3b5c3a41797f95272e57f4290ccbd283a4bfd0033a3d857e64c` |
| `nunito-latin-ext-wght-normal.woff2` | `@fontsource-variable/nunito` | 5.3.0 | `2c8d792869818ecb253a46bc3c63c7013df7aac2f69291c3c85e5cdc94160960` |
| `nunito-latin-ext-wght-italic.woff2` | `@fontsource-variable/nunito` | 5.3.0 | `1bb48a49c837d76a727223515b78eb2a14eaab783563be84b0718f338c56c846` |

Fredoka has no italic. Headings never use italic, and the editor's italic control on a
heading falls back to a synthesised slant. Nunito covers weights 200 to 1000, Fredoka
300 to 700. The `unicodeRange` values in `theme.json` are the ones Fontsource publishes
for each subset.
