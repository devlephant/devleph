<?
    include "Wrapper/VK4DS.php";

    function onUserDataAccepted($userData){
        pre($userData);
    }
    if(VK4DS::Auth(1968179))
    {
        Async( 'VK4DS_users::get', 'onUserDataAccepted' ); // новый поток
        onUserDataAccepted( VK4DS::$users->get() ); // основной поток
    }