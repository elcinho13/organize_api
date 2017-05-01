<?php

class relations {
    
    static function getUserRelations() {
        $relations = [
            'user_type',
            'token.login_type',
            'token.access_platform',
            'plan.price',
            'plan.advantages',
            'privacy',
            'user_term.term',
            'user_security.access_platform',
            'user_security.security_question',
            'user_settings.setting',
            'user_notifications'
        ];
        return $relations;
    }
    static function getFirstAccessUserRelations() {
        $relations = [
            'user.user_type',
            'user.token.login_type',
            'user.token.access_platform',
            'user.plan.price',
            'user.plan.advantages',
            'user.privacy',
            'user.user_term.term',
            'user.user_security.access_platform',
            'user.user_security.security_question',
            'user.user_settings.setting',
            'user.user_notifications'
        ];
        return $relations;
    }
    
    static function getTokenRelations(){
        $relations = [
            'login_type',
            'access_platform'
        ];
        return $relations;
    }
    static function getContactRelations(){
        $relations = [
            'contact_type'
        ];
        return $relations;
    }
    static function getPlanRelations(){
        $relations=[
            'price',
            'advantages'
        ];
        return $relations;
    }
    static function getUserSettingsRelations(){
        $relations = [
            'setting'
        ];
        return $relations;
    }
    static function getUserSecurityRelations(){
        $relations = [
            'security_question',
            'access_platform'
        ];
        return $relations;
    }
}
