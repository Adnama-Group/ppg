<?php
namespace petpetgoose\product;

use  petpetgoose\util\GetAttachmentID;

//$_POST keys to human readable constants
define('addPetExtrasFormID',8); 
define('addPetExtrasUsername','input_1'); //$_POST['input_1']
define('addPetExtrasProductId','input_2');
define('addPetExtrasAdditionalArea','input_4');
define('addPetExtrasAdditionalPhotos','gform_uploaded_files');

class AddPetExtras{
    function __construct(){
        //update ACF fields associated with product
        //ACF fieldnames on wp-admin/post.php?post=284&action=edit
        update_field('more_about_you', $_POST[addPetExtrasAdditionalArea],$_POST[addPetExtrasProductId]);
        //update additional photos (gallery).  In order to update it, need attachment IDs
        add_filter( 'gform_after_submission_'.addPetExtrasFormID, array($this,'petPetGooseGalleryUpdate'),10,2 );
    }
    function petPetGooseGalleryUpdate($entry, $form ){
        //https://support.advancedcustomfields.com/forums/topic/updating-the-gallery-field-using-update_field/
        //get attachment IDs
        //$entry[3] => array of URLs of uploaded files
        $GetAttachmentID=new GetAttachmentID;
        $attachmentIDs=$GetAttachmentID->getAttchmentIDarray($entry, 3);
        update_field('additional_photos', $attachmentIDs, $_POST[addPetExtrasProductId]);
    }
}