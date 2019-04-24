<?php

function interra_import_csv_to_acc_array($file_path): array {
  $row = 1;

  $heading_slugs = [];
  $rows = [];

  if (($handle = fopen($file_path, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      // set column keys on headings row
      if ($row === 1) {
        foreach ($data as $heading_slug) {
          $heading_slugs[] = $heading_slug;
        }
      }

      if ($row > 1 && count($heading_slugs)) {
        $row_data = array();

        foreach ($data as $key => $value) {
          $heading_slug = $heading_slugs[$key];
          $row_data[$heading_slug] = $value;
        }

        $rows[] = $row_data;
      }

      $row++;
    }
    fclose($handle);
  }

  return $rows;
}

function interra_insert_users(): void {
  $users = interra_import_csv_to_acc_array( get_stylesheet_directory() . '/import_data/users.csv' );

  $new_ids = array();

  foreach ($users as &$new_user) {
    interra_prepare_user($new_user);

    // make an array of new ids for each user
    $old_id = $new_user['ID'];
    unset($new_user['ID']);
    $new_ids[$old_id] = 0;

    echo '<pre>';
    echo 'Trying: ';
    echo '<br>';
    var_dump($new_user);
    echo '</pre>';

    $result = wp_insert_user( $new_user );

    if (is_wp_error($result)) {
      echo 'Failed: ';
      echo '<br>';
      echo $result->get_error_message();
      echo '<br>';
    } else {
      echo 'Success: '.$result.'<br>';
      $new_ids[$old_id] = $result;
    }
  }

  echo '<pre>';
  echo 'New Ids: ';
  echo '<br>';
  var_dump($new_ids);
  echo '</pre>';
}

function interra_prepare_user( &$user ) {
  $user['user_pass'] = wp_generate_password();

  $user['role'] = $user['roles'];
  unset($user['roles']);

  unset($user['user_status']);
}


?>
