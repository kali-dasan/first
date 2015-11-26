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
  // Phpexcel is a drupal module to do export / create xls files.
  // Below is the example code to export xls file with out any open file format issue.
  module_load_include('inc', 'phpexcel');
  // Create directory my_dir.
  $filepath = 'public://my_dir/';
  file_prepare_directory($filepath, FILE_CREATE_DIRECTORY);

  // Store file.
  $dir = file_stream_wrapper_get_instance_by_uri('public://my_dir')->realpath();
  $filename_timestamp = "file-name" . date('d-m-Y') . ".xls";
  $path = "$dir/$filename_timestamp";

  // Use the .xls format
  $options = array('format' => 'xls');
  $excel_result = phpexcel_export($header, $data, $path, $options);

  // To avoid file format issue while open file.
  $file = new stdClass();
  $file->uri = $path;

  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename="' . $filename_timestamp . '"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');

  readfile($file->uri);
  exit
}
?>