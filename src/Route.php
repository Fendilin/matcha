<?php

namespace App;

class Route
{
    const ROUTE_ACTIVATION_ACCOUNT  = '/activation/{username}/{token}';
    const ROUTE_FILTER_HOME         = '/homeFilter';
    const ROUTE_FILTER_SEARCH       = '/searchFilter';
    const ROUTE_HOME                = '/home';
    const ROUTE_INSERT_IMAGE        = '/profile/{username}/insert/img';
    const ROUTE_LOGOUT              = '/logout';
    const ROUTE_MESSAGES_ADD        = '/addMessage';
    const ROUTE_MESSAGES_GET        = '/getMessages';
    const ROUTE_MESSAGES_NEW        = '/newMessages';
    const ROUTE_NOTIFICATIONS_COUNT = '/countNotif';
    const ROUTE_NOTIFICATIONS_GET   = '/getNotif';
    const ROUTE_NOTIFICATIONS_READ  = '/readNotif';
    const ROUTE_PASSWORD_RESET      = '/password-reset';
    const ROUTE_PASSWORD_RESET      = '/password-reset/{username}/{token}';
    const ROUTE_PROFILE_BLOCK       = '/profile/{username}/block';
    const ROUTE_PROFILE_FAKE        = '/profile/{username}/fake';
    const ROUTE_PROFILE_LIKE        = '/profile/{username}/like';
    const ROUTE_PROFILE_SEARCH      = '/profile/{username}';
    const ROUTE_PROFILE_UNBLOCK     = '/profile/{username}/unblock';
    const ROUTE_PROFILE_UNFAKE      = '/profile/{username}/unfake';
    const ROUTE_PROFILE_UNLIKE      = '/profile/{username}/unlike';
    const ROUTE_READ_ALL            = '/readAll';
    const ROUTE_REGISTER            = '/registration';
    const ROUTE_RESEND_CONFIRMATION = '/resend-confirm';
    const ROUTE_SEARCH              = '/search';
    const ROUTE_SIGN                = '/';
    const ROUTE_SORT_BY             = '/sort-by';
    const ROUTE_STILL_ALIVE         = '/stillAlive';
    const ROUTE_STILL_CONNECTED     = '/stillConnected';
    const ROUTE_UPDATE_BIO          = '/profile/{username}/upd/bio';
    const ROUTE_UPDATE_IMAGE        = '/profile/{username}/upd/img';
    const ROUTE_UPDATE_INFO         = '/profile/{username}/upd/info';
    const ROUTE_UPDATE_PROFILE      = '/profile/{username}/upd/profile';
    const ROUTE_UPDATE_TAG          = '/profile/{username}/upd/tag';

    /**
     * @var array
     */
    private $allowedRoutes = [];

    /**
     * @return array
     */
    public function getAllowedRoutes(): array
    {
        return $this->allowedRoutes;
    }
}
