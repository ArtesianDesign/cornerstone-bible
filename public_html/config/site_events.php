<?php
   Events::extend('on_user_add',             /* event */
                  'ApplicationUser',         /* class */
                  'setupUserJoinInfo',       /* method */
                  'models/application_user.php'); 
   /*               
   Events::extend('on_user_update',            
                  'ApplicationUser',        
                  'setupUserGroup',       
                  'models/application_user.php'); 
   */
