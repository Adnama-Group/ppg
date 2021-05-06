<?php
namespace nyulawlms\wc;

class DeleteUserOrders{ //deletes all user orders + all user records (e.g., grades) except for the login
    private $form_submit_button_name='nyulawlms_delete_user_orders';
    private $form_submit_button_value='Delete user orders';
    private $form_action='post';
    private $data=array();
    private $processForm=false; //has the form been submitted and processed?
    private $processFormResultHtml;     
    private $dbobj;
    function __construct()
    {
        global $wpdb;
        $this->dbobj=$wpdb;
        add_action('admin_menu', array($this,'addAdminPages'));
        if(strtolower($this->form_action=='post')){
            if(isset($_POST[$this->form_submit_button_name])&&$_POST[$this->form_submit_button_name]==$this->form_submit_button_value){
                $this->data=$_POST;
                $this->processForm=true;
            }
        }else if(strtolower($this->form_action=='get')){
            if(isset($_GET[$this->form_submit_button_name])&&$_GET[$this->form_submit_button_name]==$this->form_submit_button_value){
                $this->data=$_GET;
                $this->processForm=true;
            }
        }
        if($this->processForm){ //if form's been submitted, get posts of the specified types
            add_action('init',array($this,'processForm'));
        }            
    }
    public function addAdminPages(){
        add_submenu_page( 'nyu_law_menu', 'Delete User Orders', 'Delete User Orders', 'edit_themes','nyu_law_lms_deleteUserorders',array($this,'html'));
    }
    public function html(){
        $html="<form method='{$this->form_action}' >";
        $html.="<label>Remove all orders</label> <input type='checkbox' name='remove_user_order[]' value='all' />";
        //TODO: enable user selection to seletively delete orders
        /*
        $html.="<br /><br />OR<br /><br />";
        $html.="<label>Remove orders by selected users</label><br />";
        //get all users
        $users=get_users();
        foreach($users as $k=>$v){
            $html.="<label>{$v->data->user_login}, {$v->data->user_email}</label> <input type='checkbox' name='remove_user_order[]' value={$v->ID} /><br />";
        }
        */
        $html.="<input type='submit' name='{$this->form_submit_button_name}' value='{$this->form_submit_button_value}' />";
        $html.="</form>";

        $html.=$this->processFormResultHtml;

        echo $html;
    }
    public function processForm(){ 
        $this->processFormResultHtml=$this->processFormSubmission($this->data);
    }
    public function processFormSubmission($submittedData){
        if(isset($submittedData['remove_user_order'])&&is_array($submittedData['remove_user_order'])&&sizeof($submittedData['remove_user_order'])){
            //delete orders, grades, completions
            if($submittedData['remove_user_order'][0]=='all'){
                $output=$this->deleteAll();
            }
            return $output;
        }else{
            return false;
        }

    }    
    private function deleteAll(){
        $output='';
            /*
            Refer to https://wordpress.stackexchange.com/questions/327665/delete-woocommerce-order-data-from-database:
            But the queries in the above stackoverflow doesn't work. Use below
***USE THIS TO ACTUALLY DELETE ALL:
DELETE wp_posts, wp_postmeta FROM wp_posts
inner JOIN wp_postmeta on wp_posts.ID = wp_postmeta.post_id
WHERE wp_posts.post_type = "shop_order";
truncate table wp_woocommerce_order_items;
truncate table wp_woocommerce_order_itemmeta;

***Even after the above DELETE, users enrollment records were still existent because of "transients"
in wp_options, which led $NyuLawLMSCourseEnrolled->enrolled($product->get_id()) to return TRUE 
even when all orders were removed.  Transients get create again, so delete them all from wp_options.
DELETE from wp_options where option_name like '%_transient%';

***THE FOLLOWING SHOULD SHOW ALL ORDERS:
select * from  wp_posts
inner JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id
inner join wp_woocommerce_order_itemmeta on wp_postmeta.post_id = wp_woocommerce_order_itemmeta.order_item_id
inner join wp_woocommerce_order_items on wp_posts.ID = wp_woocommerce_order_items.order_item_id
WHERE wp_posts.post_type = "shop_order"
            */
        $q="DELETE {$this->dbobj->prefix}posts, {$this->dbobj->prefix}postmeta FROM {$this->dbobj->prefix}posts
        inner JOIN {$this->dbobj->prefix}postmeta on {$this->dbobj->prefix}posts.ID = {$this->dbobj->prefix}postmeta.post_id
        WHERE {$this->dbobj->prefix}posts.post_type = 'shop_order'";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';
        $q="truncate table {$this->dbobj->prefix}woocommerce_order_items";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';
        $q="truncate table {$this->dbobj->prefix}woocommerce_order_itemmeta";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';
        $q="DELETE from {$this->dbobj->prefix}options where option_name like '%_transient%'";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';
        $q="truncate table {$this->dbobj->prefix}nyulawlms_course_asset_grades";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';
        $q="truncate table {$this->dbobj->prefix}nyulawlms_goals_completion";
        $res=$this->dbobj->query($q);
        $output.=$q.'<br />';
        $output.=$res.'<br />';        
        return '<h1>Delete Query Results</h1>'.$output;
    }
    //TODO
    private function deleteSelectedUsers($selected_users){
        
    }
}
?>