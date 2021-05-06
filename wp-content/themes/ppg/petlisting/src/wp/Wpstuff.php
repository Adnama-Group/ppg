<?php
namespace Nyulawlms\wp;

class Wpstuff{
    private $dbobj;
    function __construct(){
        global $wpdb;
        $this->dbobj=$wpdb;
        $this->enqueue();
        $this->dbBuild();
    }
	private function enqueue(){
		if(is_admin()||preg_match('/courseView/',$_SERVER['REQUEST_URI'])||preg_match('/course-view/',$_SERVER['REQUEST_URI'])){
			wp_enqueue_script(
				'nyulawlms-main-js', // Handle.
				plugins_url( '../js/main.js', dirname( __FILE__ ) ), 
				array( 'jquery' ), // Dependencies, defined above.
				time(), 
				true 
            );          
			wp_enqueue_style(
				'nyulawlms-style-css', // Handle.
				plugins_url( '../css/style.css', dirname( __FILE__ ) ),
				array( 'wp-editor' )
            );	
        }	
        wp_enqueue_style(
            'nyulawlms-nav-css', // Handle.
            plugins_url( '../css/nav.css', dirname( __FILE__ ) ),
            array( 'wp-editor' )
        );                
        wp_enqueue_script(
            'nyulawlms-nav-js', // Handle.
            plugins_url( '../js/nav.js', dirname( __FILE__ ) ), 
            array( 'jquery' ), // Dependencies, defined above.
            time(), 
            true 
        );  
        wp_enqueue_script(
            'nyulawlms-bookmark-js', // Handle.
            plugins_url( '../js/bookmark.js', dirname( __FILE__ ) ), 
            array( 'jquery' ), // Dependencies, defined above.
            time(), 
            true 
        );          	
    }    
    private function dbBuild(){
        foreach($this->sqlTable() as $k=>$v){
            $this->dbTableBuild($v);
        }
    }
    private function dbTableBuild($v){
        global $jal_db_version;
        $jal_db_version = '1.0';
        $sql=$v;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    
        add_option( 'jal_db_version', $jal_db_version );
    }
    private function sqlTable(){ //in order to add additional tables, add an additional array elem as below
        $charset_collate=$this->dbobj->get_charset_collate();
        //TODO: proper writeup of data structure
        //till thenf
        // assets: objects inside course
        // goals: something one completes.  course (can even be sub-divided into assets later), degree, certification, program, etc.

        //TODO: gradables, assettypes, goals are lookup tables that need WP admin interface to add/edit.  For now, manual add/edit from phpmyadmin
        return array(
            "course_gradables"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_course_gradables (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    title varchar(255) DEFAULT '' NOT NULL,
                    course_post_id mediumint(9) NOT NULL,
                    unit_id mediumint(9) NOT NULL,
                    lesson_id mediumint(9) NOT NULL, 
                    lesson_post_id mediumint(9) NOT NULL,
                    asset_id mediumint(9) NOT NULL, 
                    asset_post_id mediumint(9) NULL, 
                    asset_type mediumint(9) NULL, 
                    h5p_id mediumint(9) NULL, 
                    nyulawlms_course_gradables_total_pts mediumint(9) NOT NULL,
                    max_attempt_allowed mediumint(9) DEFAULT 1 NOT NULL, 
                    active boolean NOT NULL default 1,
                    PRIMARY KEY  (id)
                ) $charset_collate;",
            "course_assettypes"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_course_assettypes ( 
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    asset_type varchar(55) DEFAULT '' NOT NULL,
                    gradable boolean not null default 0,
                    PRIMARY KEY  (id)
                ) $charset_collate;",
            "student_max_attempts"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_student_max_attempts (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) NOT NULL,
                gradable_id mediumint(9) NOT NULL,
                max_attempt_allowed mediumint(9) DEFAULT 0 NOT NULL, 
                datetime DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY  (id),
                UNIQUE KEY `user_gradable_ids` (`user_id`,`gradable_id`)
            ) $charset_collate;",        
            "course_asset_grades"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_course_asset_grades (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) NOT NULL,
                gradable_id mediumint(9) NOT NULL,
                course_post_id mediumint(9) NOT NULL,
                score_min mediumint(9) not null default 0,
                score_max mediumint(9) not null default 0,
                score_raw mediumint(9) not null default 0,
                score_scale decimal(2,1) not null default 0.0,
                datetime DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY  (id)
            ) $charset_collate;",                     
            "goals_completion"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_goals_completion (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_id mediumint(9) NOT NULL,
                goal_id mediumint(9) NOT NULL,
                post_id mediumint(9) NOT NULL,
                score decimal(9,1) not null default 0.0,
                total_score mediumint(9) not null default 0,
                datetime DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY  (id)
            ) $charset_collate;",
            "goals"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_goals (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                goal varchar(55) DEFAULT '' NOT NULL,
                description text DEFAULT '' NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;",
            "lrs"=>"CREATE TABLE {$this->dbobj->prefix}nyulawlms_lrs (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                raw_data text DEFAULT '' NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;",    
            "bookmark" => "CREATE TABLE {$this->dbobj->prefix}nyulawlms_bookmark (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                datetime DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                uid mediumint(9) NOT NULL,
                cid mediumint(9) NOT NULL,
                lid mediumint(9) NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;",                      
            "settings" => "CREATE TABLE {$this->dbobj->prefix}nyulawlms_settings (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                datetime DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                option_key varchar(55) DEFAULT '' NOT NULL,
                option_value varchar(255) DEFAULT '' NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;",                    
        );

    }  
}
?>
