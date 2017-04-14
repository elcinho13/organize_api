<?php

class relations {
    
    static function getUserRelationsOne() {
        $user_relations = [
            'user_type',
            'token.login_type',
            'token.access_platform',
            'plan.price',
            'plan.advantages',
            'user_term.term',
            'user_security.access_platform',
            'user_security.security_question',
            'user_settings.setting',
            'user_privacy.privacy',
            'user_notifications'
        ];
        return $user_relations;
    }

    static function getUserRelationsTwo() {
        $user_relations = [
            'user.user_type',
            'user.token.login_type',
            'user.token.access_platform',
            'user.plan.price',
            'user.plan.advantages',
            'user.user_term.term',
            'user.user_security.access_platform',
            'user.user_security.security_question',
            'user.user_settings.setting',
            'user.user_privacy.privacy',
            'user.user_notifications'
        ];
        return $user_relations;
    }
}
