<?php
namespace Nyulawlms\wp;

class Debug{
    private $form_submit_button_name='nyulawlms_debug';
    private $form_submit_button_value='Enable Debugg for IP';
    private $form_action='post';
    private $data=array();
    private $processForm=false; //has the form been submitted and processed?
    private $processFormResultHtml; 
    private $processFormResultRaw; 
    private $dbobj;

    public $option_name='EnableDebuggIP';

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
            $this->processFormResultRaw=$this->processFormSubmission($this->data);
        }         
    }
    public function addAdminPages(){
        add_submenu_page( 'nyu_law_menu', 'Enable Debug for IP', 'Enable Debug for IP', 'edit_themes','nyu_law_lms_debug',array($this,'html'));
    }
    public function html(){
        $option=get_option($this->option_name);

        $html="<form method='{$this->form_action}' >";
        $html.="<label>Enter IP of the computer where debug information should be available: </label>";
        $html.="<input type='text' name='ip' value='$option' />";
        $html.="<input type='submit' name='{$this->form_submit_button_name}' value='{$this->form_submit_button_value}' />";
        $html.="</form>";

        if($this->processForm){
            $html.=$_POST['ip'].'<br /><br />';
            $html.=$this->processFormResultHtml;
            var_dump($this->processFormResultRaw);
        }

        echo $html;
    }
 
    public function processFormSubmission($submittedData){
        isset($submittedData['ip'])&&!empty($submittedData['ip'])?$input=$submittedData['ip']:$input='';
        $res=update_option( $this->option_name, $input);
        return $res;
    }
}
?>