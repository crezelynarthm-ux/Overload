<?php
$stream = "BT\n/F1 22 Tf\n72 730 Td\n(16 Clans Katutubong Blaan) Tj\n/F1 12 Tf\n0 -32 Td\n(Bagong Pag-asa Tribal Community) Tj\n0 -18 Td\n(Brgy. Sinawal, General Santos City) Tj\n0 -42 Td\n(Community Profile - Example Document) Tj\n0 -30 Td\n(Preserving Culture, Protecting Heritage, Strengthening Community) Tj\n0 -42 Td\n(This sample PDF confirms that community documents can be downloaded.) Tj\n0 -20 Td\n(Please replace this example with an approved community document.) Tj\nET\n";

$objects = [
    "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
    "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
    "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n",
    "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
    "5 0 obj\n<< /Length " . strlen($stream) . " >>\nstream\n" . $stream . "endstream\nendobj\n"
];

$pdf = "%PDF-1.4\n%\xE2\xE3\xCF\xD3\n";
$offsets = [0];
foreach ($objects as $object) {
    $offsets[] = strlen($pdf);
    $pdf .= $object;
}
$xrefOffset = strlen($pdf);
$pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
$pdf .= "0000000000 65535 f \n";
for ($index = 1; $index <= count($objects); $index++) {
    $pdf .= sprintf("%010d 00000 n \n", $offsets[$index]);
}
$pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n" . $xrefOffset . "\n%%EOF\n";

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="16-clans-community-profile.pdf"');
header('Content-Length: ' . strlen($pdf));
echo $pdf;
