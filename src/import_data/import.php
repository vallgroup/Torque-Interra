<?php

set_time_limit (0);


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

/*
*
* Users
*
 */

function interra_insert_users(): void {
  $should_run = get_option('interra_inserted_users') !== '1';
  if (!$should_run) return;

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

  update_option( 'interra_inserted_users', '1' );
}

function interra_prepare_user( &$user ) {
  $user['user_pass'] = wp_generate_password();

  $user['role'] = $user['roles'];
  unset($user['roles']);

  unset($user['user_status']);
}

/*
*
* Listings
*
 */

function interra_update_listings_with_authors() {
  ob_implicit_flush(true);
  ob_start();

  $listings = interra_import_csv_to_acc_array( get_stylesheet_directory() . '/import_data/listing-author.csv' );

  echo 'Importing '.count($listings).' listings <br>';

  for ($count=0; $count < count($listings); $count++) {
    $new_listing = $listings[$count];


    $__listing = get_page_by_title(
      $new_listing['post_title'],
      null,
      'torque_listing'
    );

    if ( ! $__listing ) {
      echo '<pre>';
      echo 'Did not find listing with title ' . $new_listing['post_title'];
      echo '</pre>';
      continue;
    }

    echo '<pre>';
    echo 'Updating property ' . $new_listing['post_title'];
    echo '</pre>';

    $_brokers = get_post_meta( $__listing->ID, 'listing_brokers', true );
    var_dump( $_brokers );
    echo '<br />';
    if ( "" !== $_brokers ) {
      array_unshift( $_brokers, $new_listing['post_author'] );
      update_field( 'listing_brokers', array_unique( $_brokers ), $__listing->ID );
    } else {
      update_field( 'listing_brokers', array( $new_listing['post_author'] ), $__listing->ID );
    }
    var_dump(get_post_meta( $__listing->ID, 'listing_brokers', true ));
    echo '<hr /><br />';

    $updated = wp_update_post( array(
      'ID' => $__listing->ID,
      'post_author' => intval( $new_listing['post_author'] ),
    ) );

    if ( ! is_wp_error( $updated ) ) {
      echo '<pre>';
      echo 'The listing (' . $new_listing['post_title'] . ') was updated successfully.';
      echo '</pre>';
    }

    flush();
    ob_flush();
  }

  ob_end_flush();
}


function interra_insert_listings() {
  $should_run = get_option('interra_inserted_listings') !== '1';
  if (!$should_run) return;

  ob_implicit_flush(true);
  ob_start();

  $listings = interra_import_csv_to_acc_array( get_stylesheet_directory() . '/import_data/listings.csv' );

  echo 'Importing '.count($listings).' listings <br>';

  for ($count=0; $count < count($listings); $count++) {
    $new_listing = $listings[$count];

    interra_prepare_listing($new_listing);

    echo '<pre>';
    echo 'Count: '.$count.'. Trying: ';
    echo '<br>';
    var_dump($new_listing);
    echo '</pre>';

    $result = wp_insert_post( $new_listing['post'], true );

    if (is_wp_error($result)) {
      echo 'Failed: ';
      echo '<br>';
      echo $result->get_error_message();
      echo '<br>';
      continue;
    } else {
      echo 'Success: '.$result.'<br>';
    }

    if (isset($new_listing['tax'])) interra_add_listing_tax( $result, $new_listing['tax'] );
    if (isset($new_listing['meta'])) interra_add_listing_meta( $result, $new_listing['meta'] );
    if (isset($new_listing['image'])) interra_add_post_image( $result, $new_listing['image'] );

    flush();
    ob_flush();
  }

  update_option( 'interra_inserted_listings', '1' );

  ob_end_flush();
}


function interra_prepare_listing( &$listing ) {
  $int_fields = [
    'post_author',
    'listing_broker_1',
    'listing_broker_2'
  ];

  $date_fields = [
    'post_date',
    'post_modified',
  ];

  // sort fields into the correct field group
  foreach ($listing as $key => $value) {

    if (strpos($key, 'image_') !== false) {
      $image_key = str_replace('image_', '', $key);

      $listing['image'][$image_key] = $value;
      unset($listing[$key]);

      continue;
    }

    if (strpos($key, 'tax_') !== false) {
      $tax_key = str_replace('tax_', '', $key);

      $listing['tax'][$tax_key] = $value;
      unset($listing[$key]);

      continue;
    }

    if (strpos($key, 'meta_') !== false) {
      $meta_key = str_replace('meta_', '', $key);

      $listing['meta'][$meta_key] = $value;
      unset($listing[$key]);

      continue;
    }

    // if none of the above, it's a standard post attribute

    $listing['post'][$key] = $value;
    unset($listing[$key]);
  }

  // convert field value types
  foreach ($listing as $field_group_key => $field_group) {
    foreach ($field_group as $key => $value) {
      if ( in_array($key, $int_fields) ) {
        $listing[$field_group_key][$key] = intval($value);
      }

      if ( in_array($key, $date_fields) ) {
        $date = strtotime($value);
        $listing[$field_group_key][$key] = date("Y-m-d H:i:s", $date);
      }
    }
  }
}

function interra_add_listing_tax( $listing_id, $tax_term_array ) {
  foreach ($tax_term_array as $tax => $terms) {
    try {
      // terms are joined by | in csv, so split them
      $terms_arr = array_filter(explode('|', $terms));

      $term_ids = [];


      foreach ($terms_arr as $term_name) {
        // create term slug an check if it exists
        $term_slug = str_replace(' ', '-', strtolower($term_name));
        $term_obj = get_term_by( 'slug', $term_slug, $tax );

        if (!$term_obj) {
          // if it doesnt exist, add it
          $term_obj = wp_insert_term( $term_name, $tax, $args = array( 'slug' => $term_slug ) );

          if (is_wp_error($term_obj)) {
            echo 'Failed adding term: <br>';
            echo $term_obj->get_error_message();
            echo '<br>';
            continue;
          }

          $term_ids[] = $term_obj['term_id'];
        } else {
          $term_ids[] = $term_obj->term_id;
        }
      }

      // links terms to listing
      wp_set_post_terms( $listing_id, $term_ids, $tax, false );

    } catch( Exception $e ) {
      echo 'Failed adding terms for taxonomy '.$tax.' of listing '.$listing_id.'<br>';
      var_dump($e);
      echo '<br>';
      continue;
    }
  }
}

function interra_add_listing_meta( $listing_id, $meta_array ) {
  try {
    $broker_ids = [];

    foreach ($meta_array as $meta_key => $meta_value) {
      if (!$meta_value) continue;

      if (strpos($meta_key, 'key_details_') !== false) {
        $row_name_slug = str_replace('key_details_', '', $meta_key); // 'key_details_asking_price' => 'asking_price'
        $row_name_words = explode('_', $row_name_slug); // => [asking, price]
        $row_name_words = array_map('ucfirst', $row_name_words); // => [Asking, Price]
        $row_name = implode(' ', $row_name_words); // => Asking Price

        $row = array(
        	'name'	=> $row_name,
        	'value'	=> $meta_value
        );
        add_row('key_details', $row, $listing_id );

        continue;
      }

      if (strpos($meta_key, '_broker_') !== false) {
        $broker_ids[] = $meta_value;

        continue;
      }

      // not a special case
      update_field( $meta_key, $meta_value, $listing_id );
    }

    // brokers have to be done last after we've created an array of ids
    update_field( 'listing_brokers', $broker_ids, $listing_id );

  } catch( Exception $e ) {
    echo 'Failed adding meta for listing '.$listing_id.'<br>';
    var_dump($e);
    echo '<br>';
  }
}

/**
 *
 * Blog Posts
 *
 */

 function interra_insert_blog_posts() {
   $should_run = get_option('interra_inserted_posts') !== '1';
   if (!$should_run) return;

   ob_implicit_flush(true);
   ob_start();

   $posts = interra_import_csv_to_acc_array( get_stylesheet_directory() . '/import_data/posts.csv' );

   echo 'Importing '.count($posts).' posts <br>';

   for ($count=0; $count < count($posts); $count++) {
     $new_post = $posts[$count];

     interra_prepare_post($new_post);

     echo '<pre>';
     echo 'Count: '.$count.'. Trying: ';
     echo '<br>';
     var_dump($new_post);
     echo '</pre>';

     $result = wp_insert_post( $new_post['post'], true );

     if (is_wp_error($result)) {
       echo 'Failed: ';
       echo '<br>';
       echo $result->get_error_message();
       echo '<br>';
       continue;
     } else {
       echo 'Success: '.$result.'<br>';
     }

     if (isset($new_post['tax'])) interra_add_post_tax( $result, $new_post['tax'] );
     if (isset($new_post['image'])) interra_add_post_image( $result, $new_post['image'] );

     flush();
     ob_flush();
   }

   update_option( 'interra_inserted_posts', '1' );

   ob_end_flush();
 }

 function interra_prepare_post( &$post ) {
   $int_fields = [
     'post_author',
   ];

   $date_fields = [
     'post_date',
     'post_modified',
   ];

   // sort fields into the correct field group
   foreach ($post as $key => $value) {

     if (strpos($key, 'image_') !== false) {
       $image_key = str_replace('image_', '', $key);

       $post['image'][$image_key] = $value;
       unset($post[$key]);

       continue;
     }

     if (strpos($key, 'tax_') !== false) {
       $tax_key = str_replace('tax_', '', $key);

       $post['tax'][$tax_key] = $value;
       unset($post[$key]);

       continue;
     }

     // if none of the above, it's a standard post attribute

     $post['post'][$key] = $value;
     unset($post[$key]);
   }

   // convert field value types
   foreach ($post as $field_group_key => $field_group) {
     foreach ($field_group as $key => $value) {
       if ( in_array($key, $int_fields) ) {
         $post[$field_group_key][$key] = intval($value);
       }

       if ( in_array($key, $date_fields) ) {
         $date = strtotime($value);
         $post[$field_group_key][$key] = date("Y-m-d H:i:s", $date);
       }
     }
   }
 }

 function interra_add_post_tax( $post_id, $tax_term_array ) {
   foreach ($tax_term_array as $tax => $terms) {
     try {
       // terms are joined by | in csv, so split them
       $terms_arr = array_filter(explode('|', $terms));

       if ($tax === 'tag') {
         wp_set_post_tags( $post_id, $terms_arr,  true );
         continue;
       }

       if ($tax === 'category') {
         $term_ids = [];
         $user_ids = [];

         foreach ($terms_arr as $term_name) {

           // try matching a user category
           $users = new WP_User_Query( array(
             'search'         => $term_name,
             'search_columns' => array( 'display_name' ),
             'fields'         => 'ID'
           ) );
           $users_found = $users->get_results();

           if (!empty($users_found)) {
             // category could be a user, so add to our additional authors field instead
             $user_ids[] = $users_found[0];
             continue;
           }


           // create term slug an check if it exists
           $term_slug = str_replace(' ', '-', strtolower($term_name));
           $term_obj = get_term_by( 'slug', $term_slug, $tax );

           if (!$term_obj) {
             // if it doesnt exist, add it
             $term_obj = wp_insert_term( $term_name, $tax, $args = array( 'slug' => $term_slug ) );

             if (is_wp_error($term_obj)) {
               echo 'Failed adding term: <br>';
               echo $term_obj->get_error_message();
               echo '<br>';
               continue;
             }

             $term_ids[] = $term_obj['term_id'];
           } else {
             $term_ids[] = $term_obj->term_id;
           }
         }

         if (count($user_ids)) {
           update_field( 'post_authors', $user_ids, $post_id );
         }

         if (count($term_ids)) {
           // links terms to post
           wp_set_post_terms( $post_id, $term_ids, $tax, false );
         }
       }
     } catch( Exception $e ) {
       echo 'Failed adding terms for taxonomy '.$tax.' of post '.$post_id.'<br>';
       var_dump($e);
       echo '<br>';
       continue;
     }
   }
 }


/**
 *
 * Remove Duplicates
 *
 */


function interra_remove_duplicates() {
  global $wpdb;

  $duplicate_titles = $wpdb->get_col("SELECT post_title FROM {$wpdb->posts} WHERE  post_type = 'attachment' GROUP BY post_title HAVING COUNT(*) > 1");

  var_dump($duplicate_titles);

  foreach( $duplicate_titles as $title ) {
     $post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_title=%s", $title ) );

     var_dump($post_ids);
     echo '<br>';

     // Iterate over the second ID with this post title till the last
     foreach( array_slice( $post_ids, 1 ) as $post_id ) {
        wp_delete_post( $post_id, true ); // Force delete this post
        echo 'deleted: '.$post_id;
        echo '<br>';
     }
  }
}


/**
 *
 * Helpers
 *
 */

 function interra_add_post_image( $post_id, $image_array ) {
   $urls = explode('|', $image_array['url']);
   $titles = explode('|', $image_array['title']);
   $captions = explode('|', $image_array['caption']);
   $descriptions = explode('|', $image_array['description']);

   $thumbnail_ix = array_search( $image_array['thumbnail'] , $urls );

   foreach ($urls as $index => $url) {
     if (!$url) continue;

     try {
       $exploded_url = explode('/', $url);
       $filename = end($exploded_url);
       $month = $exploded_url[count($exploded_url)-2];
       $year = $exploded_url[count($exploded_url)-3];

       $title = $titles[$index];
       $caption = $captions[$index];
       $description = $descriptions[$index];

       // start upload logic
       $uploaddir = wp_upload_dir( $year.'/'.$month );
       $uploadfile = $uploaddir['path'] . '/' . $filename;

       $contents= file_get_contents($url);
       $savefile = fopen($uploadfile, 'w');
       fwrite($savefile, $contents);
       fclose($savefile);

       $wp_filetype = wp_check_filetype(basename($filename), null );

       $attachment = array(
         'post_mime_type' => $wp_filetype['type'],
         'post_title' => $title,
         'post_content' => $description,
         'post_excerpt' => $caption,
         'post_status' => 'inherit'
       );

       $attach_id = wp_insert_attachment( $attachment, $uploadfile, $post_id );

       if ($attach_id === 0) throw new Exception('Insert Attachment returned 0');

       require_once(ABSPATH . 'wp-admin/includes/image.php');

       $attach_data = wp_generate_attachment_metadata( $attach_id, $uploadfile );
       wp_update_attachment_metadata( $attach_id, $attach_data );

       if ($index === $thumbnail_ix) set_post_thumbnail( $post_id, $attach_id );


     } catch(Exception $e) {
       echo 'Failed uploading image '.$url.' for post '.$post_id.'<br>';
       var_dump($e);
       echo '<br>';
     }
   }
 }

?>
