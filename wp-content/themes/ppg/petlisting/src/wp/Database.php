<?php
namespace Nyulawlms\wp;

class Database{
    private $form_submit_button_name='nyulawlms_database_run_query';
    private $form_submit_button_value='Run query';
    private $form_action='post';
    private $data=array();
    private $processForm=false; //has the form been submitted and processed?
    private $processFormResultHtml; 
    private $processFormResultRaw; 
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
            $this->processFormResultRaw=$this->processFormSubmission($this->data);
        }         
    }
    public function addAdminPages(){
        add_submenu_page( 'nyu_law_menu', 'Admin Database Tool', 'Run Query', 'edit_themes','nyu_law_lms_database',array($this,'html'));
    }
    public function html(){
        $html="<form method='{$this->form_action}' >";
        $html.="<input type='text' name='query' style='width:80%' />";
        $html.="<input type='submit' name='{$this->form_submit_button_name}' value='{$this->form_submit_button_value}' />";
        $html.="</form>";

        if($this->processForm){
            $html.=$_POST['query'].'<br /><br />';
            $html.=$this->processFormResultHtml;
            var_dump($this->processFormResultRaw);
        }

        echo $html;
    }
 
    public function processFormSubmission($submittedData){
        $res=$this->dbobj->get_results($submittedData['query']);
        $this->processFormResultHtml='<style>table tr td{border:1px solid;padding:3px;}</style><table>';
        foreach($res as $k=>$v){
            if(!$k){
                $this->processFormResultHtml.='<thead>';
                foreach($v as $k1=>$v1){
                    $this->processFormResultHtml.='<th>'.$k1.'</th>';
                }
                $this->processFormResultHtml.='</thead><tbody>';
            }
            $this->processFormResultHtml.='<tr>';
            foreach($v as $k2=>$v2){
                $this->processFormResultHtml.='<td class="'.$k2.'" >'.$v2.'</td>';
            }
            $this->processFormResultHtml.='</tr>';
        }
        $this->processFormResultHtml.='</tbody></table>';
        return $res;
    }
}
?>