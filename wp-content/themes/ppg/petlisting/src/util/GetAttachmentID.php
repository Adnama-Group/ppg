<?php
namespace petpetgoose\util;

class GetAttachmentID{
    function __construct(){

    }
    function getAttchmentIDarray($entry, $gf_images_field_id)
    {
        if (isset($entry['post_id'])) {
            $post = get_post($entry['post_id']);
            if (is_null($post)) return;
        }
        else {
            return;
        }

        // Clean up images upload and create array for gallery field

        if (isset($entry[$gf_images_field_id])) {
            $images = stripslashes($entry[$gf_images_field_id]);
            $images = json_decode($images, true);
            if (!empty($images) && is_array($images)) {
                $gallery = array();
                foreach($images as $key => $value) {

                    // NOTE: this is the other function you need: https://gist.github.com/joshuadavidnelson/164a0a0744f0693d5746

                    $image_id = $this->createImageID($value, $post->ID);
                    if ($image_id) {
                        $gallery[] = $image_id;
                    }
                }
            }
        }

        // Update gallery field with array

        if (!empty($gallery)) {
            return $gallery;
        }
        return false;
    }
    /* **
    * Create the image attachment and return the new media upload id.
    *
    * @since 1.0.0
    * @see https://codex.wordpress.org/Function_Reference/wp_insert_attachment#Example
    */
    function createImageID( $image_url, $parent_post_id = null ) {
        
        if( !isset( $image_url ) )
            return false;

        // Cache info on the wp uploads dir
        $wp_upload_dir = wp_upload_dir();
        // get the file path
        $path = parse_url( $image_url, PHP_URL_PATH );

        // File base name
        $file_base_name = basename( $image_url );

        // Full path
        if( site_url() != home_url() ) {
            $home_path = dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) );
        } else {
            $home_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) );
        }

        $home_path = untrailingslashit( $home_path );
        $uploaded_file_path = $home_path . $path;
        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype( $file_base_name, null );

        // error check
        if( !empty( $filetype ) && is_array( $filetype ) ) {
            // Create attachment title
            $post_title = preg_replace( '/\.[^.]+$/', '', $file_base_name );
        
            // Prepare an array of post data for the attachment.
            $attachment = array(
                'guid'           => $wp_upload_dir['url'] . '/' . basename( $uploaded_file_path ), 
                'post_mime_type' => $filetype['type'],
                'post_title'     => esc_attr( $post_title ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );
        
            // Set the post parent id if there is one
            if( !is_null( $parent_post_id ) )
                $attachment['post_parent'] = $parent_post_id;
            // Insert the attachment.
            $attach_id = wp_insert_attachment( $attachment, $uploaded_file_path );
            //Error check
            if( !is_wp_error( $attach_id ) ) {
                //Generate wp attachment meta data
                if( file_exists( ABSPATH . 'wp-admin/includes/image.php') && file_exists( ABSPATH . 'wp-admin/includes/media.php') ) {
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $uploaded_file_path );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                } // end if file exists check
            } // end if error check

            return $attach_id; 

        } else {
            return false;
        } // end if $$filetype
    } // end function get_image_id
}