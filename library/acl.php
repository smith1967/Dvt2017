<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acl
 *
 * @author IT
 */
class acl {
    //put your code here
    var $allowed;
    function __construct($url,$user_type) {
        $url_list = array(
            '',
            'home/index',
            'user/edit-user',
            'user/login',
            'user/signup',
            'user/logout'
            );
        if(in_array($url, $url_list) ){
            $this->allowed = true;
        }else if($user_type==1){
            $this->allowed = true;
        }else if($user_type==2){
            $this->is_dvt_admin($url); 
        }else if($user_type==3){
            $this->is_dvt_staff($url);        
        }else if($user_type==4){
            $this->is_school_staff($url);
        }
    }
    function is_dvt_admin($url){
        $url_list = array(
            'home/dvt_admin',
            'user/edit-user',
            'do_school_vg/list-do_school_vg'
            );
        $this->allowed = in_array($url, $url_list);
    }

    function is_dvt_staff($url){
        $url_list = array(
            'user/edit-user',
            'home/dvt_staff',
            'do_school_vg/list-do_school_vg'
            );
        $this->allowed = in_array($url, $url_list);
    }
    function is_school_staff($url){
        $url_list = array(
            'home/school_staff',
            'business/list-business',
            'business/edit-business',
            "business/insert-business",
            'student/list-student',
            'student/form_student',
            'student/file-manager',
            'student/check-data',
            'do_business_vg/list-do_business_vg',
            'training/list-training',
            'training/insert-training',
            'training/edit-training'
            );
        $this->allowed = in_array($url, $url_list);
    }    
}

?>
