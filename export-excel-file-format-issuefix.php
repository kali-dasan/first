<?php

/* 
 * Implements function to export data into xls file.
 */
function download_xls() {
  $data = array(
    array("Kali", "Sundar", 28),
    array("Amala", "silk", 18),
    array("Vinoth", "bharath", 31)
  );
  // Form header names.
  $header = array("Firstname", "Lastname", "Age");
  // File name for download.
  $file_name = "Export_data_" . date('Ymd') . ".xls";

  // This option to trigger download widget.
  header("Content-Disposition: attachment; filename=\"$file_name\"");
  header("Content-Type: application/vnd.ms-excel");

  // push header to file.
  echo implode("\t", $header) . "\n";

  foreach($data as $row) {
    // Push each row contents.
    echo implode("\t", $row) . "\n";
  }
  exit;
}
?>