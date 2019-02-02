<?
/**
 * @name VK4DS
 * @author DENFER
 * @version 4.0
 */

Abstract Class VK4DS extends VK4DS_Base {

    /**
     * users factory
     * @var VK4DS_users users factory
     */
    Public Static $users;

    /**
     * likes factory
     * @var VK4DS_likes likes factory
     */
    Public Static $likes;

    /**
     * friends factory
     * @var VK4DS_friends friends factory
     */
    Public Static $friends;

    /**
     * groups factory
     * @var VK4DS_groups groups factory
     */
    Public Static $groups;

    /**
     * photos factory
     * @var VK4DS_photos photos factory
     */
    Public Static $photos;

    /**
     * wall factory
     * @var VK4DS_wall wall factory
     */
    Public Static $wall;

    /**
     * newsfeed factory
     * @var VK4DS_newsfeed newsfeed factory
     */
    Public Static $newsfeed;

    /**
     * notifications factory
     * @var VK4DS_notifications notifications factory
     */
    Public Static $notifications;

    /**
     * audio factory
     * @var VK4DS_audio audio factory
     */
    Public Static $audio;

    /**
     * video factory
     * @var VK4DS_video video factory
     */
    Public Static $video;

    /**
     * docs factory
     * @var VK4DS_docs docs factory
     */
    Public Static $docs;

    /**
     * places factory
     * @var VK4DS_places places factory
     */
    Public Static $places;

    /**
     * secure factory
     * @var VK4DS_secure secure factory
     */
    Public Static $secure;

    /**
     * storage factory
     * @var VK4DS_storage storage factory
     */
    Public Static $storage;

    /**
     * notes factory
     * @var VK4DS_notes notes factory
     */
    Public Static $notes;

    /**
     * pages factory
     * @var VK4DS_pages pages factory
     */
    Public Static $pages;

    /**
     * stats factory
     * @var VK4DS_stats stats factory
     */
    Public Static $stats;

    /**
     * subscriptions factory
     * @var VK4DS_subscriptions subscriptions factory
     */
    Public Static $subscriptions;

    /**
     * widgets factory
     * @var VK4DS_widgets widgets factory
     */
    Public Static $widgets;

    /**
     * Фабрика сообщений
     * @var VK4DS_messages messages factory
     */
    Public Static $messages;

    /**
     * Фабрика стенки расширенная
     * @var VK4DS_wallEx wall factory
     */
    Public Static $wallEx;

    /**
     * Фабрика фотографий расширенная
     * @var VK4DS_photosEx photos factory
     */
    Public Static $photosEx;

    /**
     * Фабрика новостей расширенная
     * @var VK4DS_newsfeedEx newsfeed factory
     */
    Public Static $newsfeedEx;

    /**
     * Фабрика "Мне нравиться" расширенная
     * @var VK4DS_likesEx likes factory
     */
    Public Static $likesEx;

    /**
     * Фабрика статусов
     * @var VK4DS_status status factory
     */
    Public Static $status;

    /**
     * Фабрика дразей расширенная
     * @var VK4DS_friendsEx friends factory
     */
    Public Static $friendsEx;

    /**
     * Фабрика опросов
     * @var VK4DS_polls polls factory
     */
    Public Static $polls;

    /**
     * Фабрика подписчиков расширенная
     * @var VK4DS_subscriptionsEx subscriptions factory
     */
    Public Static $subscriptionsEx;

    /**
     * Инициализация VK4DS Base
     */
    Public Static Function Initialize(){
        self::$messages = new VK4DS_messages;
        self::$wall = new VK4DS_wall;
        self::$photos = new VK4DS_photos;
        self::$newsfeed = new VK4DS_newsfeed;
        self::$likes = new VK4DS_likes;
        self::$status = new VK4DS_status;
        self::$friends = new VK4DS_friends;
        self::$polls = new VK4DS_polls;
        self::$subscriptions = new VK4DS_subscriptions;
        self::$users = new VK4DS_users;
        self::$likesEx = new VK4DS_likesEx;
        self::$friendsEx = new VK4DS_friendsEx;
        self::$groups = new VK4DS_groups;
        self::$photosEx = new VK4DS_photosEx;
        self::$wallEx = new VK4DS_wallEx;
        self::$newsfeedEx = new VK4DS_newsfeedEx;
        self::$notifications = new VK4DS_notifications;
        self::$audio = new VK4DS_audio;
        self::$video = new VK4DS_video;
        self::$docs = new VK4DS_docs;
        self::$places = new VK4DS_places;
        self::$secure = new VK4DS_secure;
        self::$storage = new VK4DS_storage;
        self::$notes = new VK4DS_notes;
        self::$pages = new VK4DS_pages;
        self::$stats = new VK4DS_stats;
        self::$subscriptionsEx = new VK4DS_subscriptionsEx;
        self::$widgets = new VK4DS_widgets;

    }

    /**
     * Авторизация пользователя
     * @param int $AppId Application id
     * @param string|int $Scope Required settings
     * @return bool Is user is authenticated
     */
    Public Static Function Auth( $AppId = 1968179, $Scope = 2079999 ){
        return parent::Auth($AppId, $Scope);
    }

    /**
     * Отправить асинхронизированный запрос
     * @param string $Method Метод
     * @param array|string|null $Parameters Параметры
     * @param string|array $Callback Функция результата
     */
    Public Static Function AsyncAPI( $Method, $Parameters = array(), $Callback = 'pre' ){
        if(!is_array($Parameters))
            $Parameters = array();
        parent::AsyncAPI( $Method, $Parameters, $Callback );
    }

    /**
     * Отправить запрос
     * @param string $Method Метод
     * @param array|string|null $Parameters Параметры
     * @return object Результат
     */
    Public Static Function API( $Method, $Parameters = array() ){
        if(!is_array($Parameters))
            $Parameters = array();
        return parent::API( $Method, $Parameters );
    }

    /**
     * Проверка авторизации пользователя
     * @return bool Результат
     */
    Public Static Function IsAuth(){
        return parent::IsAuth();
    }

    /**
     * Получить маркер доступа
     * @return string Маркер доступа
     */
    Public Static Function GetAccessToken(){
        return parent::GetAccessToken();
    }

    /**
     * Получить время отсоединения
     * @return int Время отсоединения
     */
    Public Static Function GetExpiresIn(){
        return parent::GetExpiresIn();
    }

    /**
     * Получить идентификатор текущего пользователя
     * @return int Идентификатор
     */
    Public Static Function GetUserId(){
        return parent::GetUserId();
    }

    /**
     * Задать маркер доступа
     * @param int $access_token Mаркер доступа
     */
    Public Static Function SetAccessToken($access_token){
        vk4ds_config( $access_token, self::GetExpiresIn(), self::GetUserId() );
    }

    /**
     * Задать время отсоединения
     * @param int $expires_in Время отсоединения
     */
    Public Static Function SetExpiresIn($expires_in){
        vk4ds_config( self::GetAccessToken(), $expires_in, self::GetUserId() );
    }

    /**
     * Задать идентификатор текущего пользователя
     * @param int $user_id Идентификатор
     */
    Public Static Function SetUserId($user_id){
        vk4ds_config( self::GetAccessToken(), self::GetExpiresIn(), $user_id );
    }

}

Abstract Class Session {
    Public Static Function GetPath($sid){
        return sys_get_temp_dir().'/'.strtoupper(md5($sid.'VK4DS')).'.session';
    }
    Public Static Function Save($sid){
        $SessionFile = self::GetPath($sid);
        file_put_contents( $SessionFile, json_encode( array('access_token'=>VK4DS::GetAccessToken(), 'expires_in'=>VK4DS::GetExpiresIn(), 'user_id'=>VK4DS::GetUserId()) ) );
    }

    Public Static Function Load($sid){
        $SessionFile = self::GetPath($sid);
        $config = json_decode(file_get_contents($SessionFile));
        vk4ds_config( $config->access_token, $config->expires_in, $config->user_id );
    }

    Public Static Function Exists($sid)
    {
        return file_exists(self::GetPath($sid));
    }
}


/**
* Factory Base
*/

Abstract Class VK4DS_Factory {
    Public Static Function Call( $Method, $Arguments ){
        return VK4DS::API( $Method, $Arguments );
    }
}

/**
 * Factories
 */

Class VK4DS_users extends VK4DS_Factory {
    /**
     * Возвращает расширенную информацию о пользователях.
     * @param mixed $uids Перечисленные через запятую ID пользователей или их короткие имена (screen_name). Максимум 1000 пользователей.
     * @param mixed $fields Перечисленные через запятую поля анкет, необходимые для получения. Доступные значения: uid, first_name, last_name, nickname, screen_name, sex, bdate (birthdate), city, country, timezone, photo, photo_medium, photo_big, has_mobile, rate, contacts, education, online, counters.
     * @param mixed $name_case Падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – nom, родительный – gen, дательный – dat, винительный – acc, творительный – ins, предложный – abl. По умолчанию nom.
     * @return object Result
     */
    Public Static Function get($uids = null, $fields = null, $name_case = null){
        $Fields = array( 'uids' => $uids, 'fields' => $fields, 'name_case' => $name_case );
        return parent::Call( 'users.get', $Fields );
    }

    /**
     * Возвращает список пользователей в соответствии с заданным критерием поиска.
     * @param mixed $q Поискового запроса. Например, Вася Бабич.
     * @return object Result
     */
    Public Static Function search($q = null){
        $Fields = array( 'q' => $q );
        return parent::Call( 'users.search', $Fields );
    }

}

Class VK4DS_likes extends VK4DS_Factory {
    /**
     * Возвращает список пользователей, которые добавили объект в список «Мне нравится».
     * @param mixed $type Like-объекта. Подробнее о типах объектов можно узнать на странице Список типов Like-объектов.
     * @param mixed $page_url Страницы, на которой установлен виджет «Мне нравится». Используется вместо параметра item_id.
     * @return object Result
     */
    Public Static Function getList($type = null, $page_url = null){
        $Fields = array( 'type' => $type, 'page_url' => $page_url );
        return parent::Call( 'likes.getList', $Fields );
    }

}

Class VK4DS_friends extends VK4DS_Factory {
    /**
     * Возвращает список id друзей пользователя.
     * @return object Result
     */
    Public Static Function get(){
        $Fields = array();
        return parent::Call( 'friends.get', $Fields );
    }

    /**
     * Возвращает список id друзей пользователя, которые установили данное приложение.
     * @return object Result
     */
    Public Static Function getAppUsers(){
        $Fields = array();
        return parent::Call( 'friends.getAppUsers', $Fields );
    }

    /**
     * Возвращает список id общих друзей между парой пользователей.
     * @param mixed $target_uid Пользователя, с которым необходимо искать общих друзей.
     * @return object Result
     */
    Public Static Function getMutual($target_uid = null){
        $Fields = array( 'target_uid' => $target_uid );
        return parent::Call( 'friends.getMutual', $Fields );
    }

    /**
     * Возвращает информацию о дружбе между двумя пользователями.
     * @param mixed $uids Идентификаторов пользователей, раделённых запятыми, статус дружбы с которыми необходимо получить.
     * @return object Result
     */
    Public Static Function areFriends($uids = null){
        $Fields = array( 'uids' => $uids );
        return parent::Call( 'friends.areFriends', $Fields );
    }

}

Class VK4DS_groups extends VK4DS_Factory {
    /**
     * Возвращает список групп пользователя.
     * @param mixed $uid ID пользователя, группы которого необходимо получить. По умолчанию выбираются группы текущего пользователя.
     * @param mixed $extended Если указать в качестве этого параметра 1, то будет возвращена полная информация о группах пользователя. По умолчанию 0.
     * @param mixed $filter Список фильтров сообществ, которые необходимо вернуть, перечисленные через запятую. Доступны значения admin, groups, publics, events. По умолчанию возвращаются все сообщества пользователя.
    При указании фильтра admin будут возвращены администрируемые пользователем сообщества.
     * @param mixed $fields Список полей из информации о группах, которые необходимо получить. См. Параметр fields для групп
     * @param mixed $offset Смещение, необходимое для выборки определённого подмножества групп.
     * @param mixed $count Количество записей которое необходимо вернуть, не более 1000.
     * @return object Result
     */
    Public Static Function get($uid = null, $extended = null, $filter = null, $fields = null, $offset = null, $count = null){
        $Fields = array( 'uid' => $uid, 'extended' => $extended, 'filter' => $filter, 'fields' => $fields, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'groups.get', $Fields );
    }

    /**
     * Возвращает информацию о группах по их идентификаторам.
     * @param mixed $gids ID групп, перечисленные через запятую, информацию о которых необходимо получить. В качестве ID могут быть использованы короткие имена групп. Максимум 500 групп.
     * @return object Result
     */
    Public Static Function getById($gids){
        $Fields = array( 'gids' => $gids );
        return parent::Call( 'groups.getById', $Fields );
    }

    /**
     * Возвращает информацию о том, является ли пользователь участником группы.
     * @param mixed $gid ID или короткое имя группы.
     * @param mixed $uid ID пользователя. По умолчанию ID текущего пользователя.
     * @param mixed $extended 1 - вернуть ответ в расширенной форме, 2 - возвращать ответ в сокращённой форме (по умолчанию)
     * @return object Result
     */
    Public Static Function isMember($gid = null, $uid = null, $extended = null){
        $Fields = array( 'gid' => $gid, 'uid' => $uid, 'extended' => $extended );
        return parent::Call( 'groups.isMember', $Fields );
    }

    /**
     * Возвращает список участников группы.
     * @param mixed $gid Или короткое имя группы, список пользователей которой необходимо получить.
     * @return object Result
     */
    Public Static Function getMembers($gid = null){
        $Fields = array( 'gid' => $gid );
        return parent::Call( 'groups.getMembers', $Fields );
    }

    /**
     * Осуществляет поиск групп по заданной подстроке.
     * @return object Result
     */
    Public Static Function search(){
        $Fields = array();
        return parent::Call( 'groups.search', $Fields );
    }

}

Class VK4DS_photos extends VK4DS_Factory {
    /**
     * Возвращает список альбомов пользователя.
     * @param mixed $uid ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
     * @param mixed $gid ID группы, которой принадлежат альбомы.
     * @param mixed $aids Перечисленные через запятую ID альбомов.
     * @param mixed $need_covers 1 - будет возвращено дополнительное поле thumb_src. По умолчанию поле thumb_src не возвращается.
     * @return object Result
     */
    Public Static Function getAlbums($uid = null, $gid = null, $aids = null, $need_covers = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'aids' => $aids, 'need_covers' => $need_covers );
        return parent::Call( 'photos.getAlbums', $Fields );
    }

    /**
     * Возвращает количество альбомов пользователя.
     * @param mixed $uid ID пользователя, которому принадлежат альбомы. По умолчанию – ID текущего пользователя.
     * @param mixed $gid ID группы, которой принадлежат альбомы.
     * @return object Result
     */
    Public Static Function getAlbumsCount($uid = null, $gid = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid );
        return parent::Call( 'photos.getAlbumsCount', $Fields );
    }

    /**
     * Возвращает список фотографий в альбоме.
     * @param mixed $uid ID пользователя, которому принадлежит альбом с фотографиями.
     * @param mixed $gid ID группы, которой принадлежит альбом с фотографиями.
     * @param mixed $aid ID альбома с фотографиями. Для получения сервисных фотографий Вы можете передавать строковое обозначение альбома: profile, wall, saved.
     * @param mixed $pids Перечисленные через запятую ID фотографий.
     * @param mixed $extended 1 - будут возвращены дополнительные поле likes, comments, tags. Поля comments и tags содержат только количество объектов. По умолчанию данные поля не возвращается.
     * @param mixed $limit Количество фотографий, которое нужно вернуть. (по умолчанию – все фотографии)
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества фотографий.
     * @param mixed $feed Unixtime, который может быть получен методом newsfeed.get в поле date, для получения всех фотографий загруженных пользователем в определённый день либо на которых пользователь был отмечен. Также нужно указать параметр uid пользователя, с которым произошло событие.
     * @param mixed $feed_type Тип новости получаемый в поле type метода newsfeed.get, для получения только загруженных пользователем фотографий, либо только фотографий, на которых он был отмечен. Может принимать значения photo, photo_tag.
     * @return object Result
     */
    Public Static Function get($uid, $gid = null, $aid = null, $pids = null, $extended = null, $limit = null, $offset = null, $feed = null, $feed_type = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'aid' => $aid, 'pids' => $pids, 'extended' => $extended, 'limit' => $limit, 'offset' => $offset, 'feed' => $feed, 'feed_type' => $feed_type );
        return parent::Call( 'photos.get', $Fields );
    }

    /**
     * Возвращает список фотографий со страницы пользователя.
     * @param mixed $uid ID пользователя, которому принадлежит альбом с фотографиями.
     * @param mixed $extended1 - будет возвращено дополнительное поле likes. По умолчанию поле likes не возвращается.
     * @return object Result
     */
    Public Static Function getProfile($uid, $extended1 = null){
        $Fields = array( 'uid' => $uid, 'extended1' => $extended1 );
        return parent::Call( 'photos.getProfile', $Fields );
    }

    /**
     * Возвращает все фотографии пользователя в антихронологическом порядке.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографий пользователя будут возвращены все фотографии группы с идентификатором -owner_id.
     * @param mixed $no_service_albums 0 - вернуть все фотографии, включая находящиеся в сервисных альбомах, таких как &quot;Фотографии на моей стене&quot;. (по умолчанию)
    1 - вернуть фотографии только из стандартных альбомов пользователя.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества фотографий.
     * @param mixed $count Количество фотографий, которое необходимо получить (но не более 100).
     * @param mixed $extended 1 - будет возвращено дополнительное поле likes. По умолчанию поле likes не возвращается.
     * @return object Result
     */
    Public Static Function getAll($owner_id = null, $no_service_albums = null, $offset = null, $count = null, $extended = null){
        $Fields = array( 'owner_id' => $owner_id, 'no_service_albums' => $no_service_albums, 'offset' => $offset, 'count' => $count, 'extended' => $extended );
        return parent::Call( 'photos.getAll', $Fields );
    }

    /**
     * Возвращает информацию о фотографиях.
     * @param mixed $photos Перечисленные через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id пользователей, разместивших фотографии, и id самих фотографий. Чтобы получить информацию о фотографии в альбоме группы, вместо id пользователя следует указать -id группы.Пример значения photos: 1_129207899,6492_135055734,
    -20629724_271945303
     * @param mixed $extended 1 - будут возвращены дополнительные поле likes, comments, tags. Поля comments и tags содержат только количество объектов. По умолчанию данные поля не возвращается.
     * @return object Result
     */
    Public Static Function getById($photos = null, $extended = null){
        $Fields = array( 'photos' => $photos, 'extended' => $extended );
        return parent::Call( 'photos.getById', $Fields );
    }

    /**
     * Создает пустой альбом для фотографий.
     * @param mixed $title Альбома.
     * @return object Result
     */
    Public Static Function createAlbum($title = null){
        $Fields = array( 'title' => $title );
        return parent::Call( 'photos.createAlbum', $Fields );
    }

    /**
     * Обновляет данные альбома для фотографий.
     * @param mixed $aid Редактируемого альбома.
     * @param mixed $title Название альбома.
     * @return object Result
     */
    Public Static Function editAlbum($aid = null, $title = null){
        $Fields = array( 'aid' => $aid, 'title' => $title );
        return parent::Call( 'photos.editAlbum', $Fields );
    }

    /**
     * Изменяет описание у выбранной фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, вместо фотографии пользователя будет изменена фотография группы с идентификатором -owner_id.
     * @param mixed $pid Фотографии, у которой необходимо изменить описание.
     * @return object Result
     */
    Public Static Function edit($owner_id = null, $pid = null){
        $Fields = array( 'owner_id' => $owner_id, 'pid' => $pid );
        return parent::Call( 'photos.edit', $Fields );
    }

    /**
     * Переносит фотографию из одного альбома в другой.
     * @param mixed $pid Переносимой фотографии.
     * @param mixed $target_a Альбома, куда переносится фотография.
     * @param mixed $oid Владельца переносимой фотографии, по умолчанию id текущего пользователя.
     * @return object Result
     */
    Public Static Function move($pid = null, $target_a = null, $oid = null){
        $Fields = array( 'pid' => $pid, 'target_a' => $target_a, 'oid' => $oid );
        return parent::Call( 'photos.move', $Fields );
    }

    /**
     * Делает фотографию обложкой альбома.
     * @param mixed $pid Фотографии, которая должна стать обложкой альбома.
     * @param mixed $aid Альбома.
     * @param mixed $oid Владельца альбома, по умолчанию id текущего пользователя.
     * @return object Result
     */
    Public Static Function makeCover($pid = null, $aid = null, $oid = null){
        $Fields = array( 'pid' => $pid, 'aid' => $aid, 'oid' => $oid );
        return parent::Call( 'photos.makeCover', $Fields );
    }

    /**
     * Меняет порядок альбома в списке альбомов пользователя.
     * @param mixed $aid Альбома, порядок которого нужно изменить.
     * @param mixed $before Альбома, перед которым следует поместить альбом.
     * @param mixed $after Альбома, после которого следует поместить альбом.
     * @param mixed $oid Владельца альбома, по умолчанию id текущего пользователя.
     * @return object Result
     */
    Public Static Function reorderAlbums($aid = null, $before = null, $after = null, $oid = null){
        $Fields = array( 'aid' => $aid, 'before' => $before, 'after' => $after, 'oid' => $oid );
        return parent::Call( 'photos.reorderAlbums', $Fields );
    }

    /**
     * Меняет порядок фотографий в списке фотографий альбома.
     * @param mixed $pid Фотографии, порядок которой нужно изменить.
     * @param mixed $before Фотографии, перед которой следует поместить фотографию.
     * @param mixed $after Фотографии, после которой следует поместить фотографию.
     * @param mixed $oid Владельца фотографии, по умолчанию id текущего пользователя.
     * @return object Result
     */
    Public Static Function reorderPhotos($pid = null, $before = null, $after = null, $oid = null){
        $Fields = array( 'pid' => $pid, 'before' => $before, 'after' => $after, 'oid' => $oid );
        return parent::Call( 'photos.reorderPhotos', $Fields );
    }

    /**
     * Возвращает адрес сервера для загрузки фотографий.
     * @param mixed $aid Альбома, в который необходимо загрузить фотографии.
     * @param mixed $gid Группы, при загрузке фотографии в группу.
     * @return object Result
     */
    Public Static Function getUploadServer($aid = null, $gid = null){
        $Fields = array( 'aid' => $aid, 'gid' => $gid );
        return parent::Call( 'photos.getUploadServer', $Fields );
    }

    /**
     * Сохраняет фотографии после успешной загрузки.
     * @param mixed $aid Альбома, в который необходимо загрузить фотографии.
     * @param mixed $server Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $photos_list Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $hash Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $gid Группы, при загрузке фотографии в группу.
     * @return object Result
     */
    Public Static Function save($aid = null, $server = null, $photos_list = null, $hash = null, $gid = null){
        $Fields = array( 'aid' => $aid, 'server' => $server, 'photos_list' => $photos_list, 'hash' => $hash, 'gid' => $gid );
        return parent::Call( 'photos.save', $Fields );
    }

    /**
     * Возвращает адрес сервера для загрузки фотографии на страницу пользователя.
     * @return object Result
     */
    Public Static Function getProfileUploadServer(){
        $Fields = array();
        return parent::Call( 'photos.getProfileUploadServer', $Fields );
    }

    /**
     * Сохраняет фотографию страницы пользователя после успешной загрузки.
     * @param mixed $server Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $photo Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $hash Возвращаемый в результате загрузки фотографий на сервер.
     * @return object Result
     */
    Public Static Function saveProfilePhoto($server = null, $photo = null, $hash = null){
        $Fields = array( 'server' => $server, 'photo' => $photo, 'hash' => $hash );
        return parent::Call( 'photos.saveProfilePhoto', $Fields );
    }

}

Class VK4DS_wall extends VK4DS_Factory {
    /**
     * Возвращает список записей со стены.
     * @param mixed $extended1 - будут возвращены три массива wall, profiles, и groups. По умолчанию дополнительные поля не возвращаются.
     * @return object Result
     */
    Public Static Function get($extended1 = null){
        $Fields = array( 'extended1' => $extended1 );
        return parent::Call( 'wall.get', $Fields );
    }

    /**
     * Получает комментарии к записи на стене пользователя.
     * @param mixed $owner_id Идентификатор пользователя, на чьей стене находится запись, к которой необходимо получить комментарии. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
     * @param mixed $post_id Идентификатор записи на стене пользователя.
     * @param mixed $sort Порядок сортировки комментариев:asc - хронологический
    desc - антихронологический
     * @param mixed $need_likes 1 - будет возвращено дополнительное поле likes. По умолчанию поле likes не возвращается.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества комментариев.
     * @param mixed $count Количество комментариев, которое необходимо получить (но не более 100).
     * @param mixed $preview_length Количество символов, по которому нужно обрезать комментарии. Укажите 0, если Вы не хотите обрезать комментарии. (по умолчанию 90). Обратите внимание, что комментарии обрезаются по словам.
     * @return object Result
     */
    Public Static Function getComments($owner_id = null, $post_id = null, $sort = null, $need_likes = null, $offset = null, $count = null, $preview_length = null){
        $Fields = array( 'owner_id' => $owner_id, 'post_id' => $post_id, 'sort' => $sort, 'need_likes' => $need_likes, 'offset' => $offset, 'count' => $count, 'preview_length' => $preview_length );
        return parent::Call( 'wall.getComments', $Fields );
    }

    /**
     * Получает записи со стен пользователей по их идентификаторам.
     * @param mixed $posts Через запятую идентификаторы, которые представляют собой идущие через знак подчеркивания id владельцев стен и id самих записей на стене.Пример значения posts:
    93388_21539,93388_20904,2943_4276
     * @return object Result
     */
    Public Static Function getById($posts = null){
        $Fields = array( 'posts' => $posts );
        return parent::Call( 'wall.getById', $Fields );
    }

    /**
     * Добавляет запись на стену.
     * @param mixed $owner_id Идентификатор пользователя, у которого должна быть опубликована запись. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
     * @param mixed $message Текст сообщения (является обязательным, если не задан параметр attachments)
     * @param mixed $attachments Список объектов, приложенных к записи и разделённых символом &quot;,&quot;. Поле attachments представляется в формате:&#60;type&#62;&#60;owner_id&#62;_&#60;media_id&#62;,&#60;type&#62;&#60;owner_id&#62;_&#60;media_id&#62;
    &#60;type&#62; - тип медиа-приложения:photo - фотография
    video - видеозапись
    audio - аудиозапись
    doc - документ
    &#60;owner_id&#62; - идентификатор владельца медиа-приложения
    &#60;media_id&#62; - идентификатор медиа-приложения.

    Например:photo100172_166443618,photo66748_265827614
    Также в поле attachments может быть указана ссылка на внешнюю страницу, которую Вы хотите разместить в статусе, например: photo66748_265827614,http://habrahabr.ru
    При попытке приложить больше одной ссылки будет возвращена ошибка.

    Параметр является обязательным, если не задан параметр message.
     * @param mixed $lat Географическая широта отметки, заданная в градусах (от -90 до 90).
     * @param mixed $long Географическая долгота отметки, заданная в градусах (от -180 до 180).
     * @param mixed $place_id Идентификатор места, в котором отмечен пользователь
     * @param mixed $services Список сервисов или сайтов, на которые необходимо экспортировать статус, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
     * @param mixed $from_group Данный параметр учитывается, если owner_id &#60; 0 (статус публикуется на стене группы). 1 - статус будет опубликован от имени группы, 0 - статус будет опубликован от имени пользователя (по умолчанию).
     * @param mixed $signed 1 - у статуса, размещенного от имени группы будет добавлена подпись (имя пользователя, разместившего запись), 0 - подписи добавлено не будет. Параметр учитывается только при публикации на стене группы и указании параметра from_group. По умолчанию подпись не добавляется.
     * @param mixed $friends_only 1 - статус будет доступен только друзьям, 0 - всем пользователям. По умолчанию публикуемые статусы доступны всем пользователям.
     * @return object Result
     */
    Public Static Function post($owner_id = null, $message = null, $attachments = null, $lat = null, $long = null, $place_id = null, $services = null, $from_group = null, $signed = null, $friends_only = null){
        $Fields = array( 'owner_id' => $owner_id, 'message' => $message, 'attachments' => $attachments, 'lat' => $lat, 'long' => $long, 'place_id' => $place_id, 'services' => $services, 'from_group' => $from_group, 'signed' => $signed, 'friends_only' => $friends_only );
        return parent::Call( 'wall.post', $Fields );
    }

}

Class VK4DS_newsfeed extends VK4DS_Factory {
    /**
     * Возвращает ленту новостей для текущего пользователя.
     * @param mixed $source_ids Перечисленные через запятую иcточники новостей, новости от которых необходимо получить.

    Идентификаторы пользователей можно указывать в форматах &lt;uid&gt; или u&lt;uid&gt;где &lt;uid&gt; - идентификатор друга пользователя.

    Идентификаторы групп можно указывать в форматах-&lt;gid&gt; или g&lt;gid&gt;где &lt;gid&gt; - идентификатор группы.

    Например, следующая строка1,-1,u10,g12904887указывает, что необходимо получить только новости друзей с идентификаторами 1 и 10, а также групп с идентификаторами 1 и 12904887.

    Если параметр не задан, то считается, что он включает список всех друзей и групп пользователя, за исключением скрытых источников, которые можно получить методом newsfeed.getBanned.
     * @param mixed $filters Перечисленные через запятую названия списков новостей, которые необходимо получить. В данный момент поддерживаются следующие списки новостей:post - новые записи со стен
    photo - новые фотографии
    photo_tag - новые отметки на фотографиях
    wall_photo - новые фотографии на стенах
    friend - новые друзья
    note - новые заметкиЕсли параметр не задан, то будут получены все возможные списки новостей.
     * @param mixed $start_time Время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
     * @param mixed $end_time Время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
     * @param mixed $offset Указывает, начиная с какого элемента в данном промежутке времени необходимо получить новости. по умолчанию 0.
     * @param mixed $from Значение, полученное в поле new_from при последней загруке новостей. Помогает избавляться от дубликатов при реализации автоподгрузки.
     * @param mixed $count Указывает, какое максимальное число новостей следует возвращать, но не более 100. По умолчанию 50. Для автоподгрузки Вы можете использовать возвращаемый данным методом параметр new_offset.
     * @param mixed $max_photos Максимальное количество фотографий, информацию о которых необходимо вернуть. По умолчанию 5.
     * @return object Result
     */
    Public Static Function get($source_ids = null, $filters = null, $start_time = null, $end_time = null, $offset = null, $from = null, $count = null, $max_photos = null){
        $Fields = array( 'source_ids' => $source_ids, 'filters' => $filters, 'start_time' => $start_time, 'end_time' => $end_time, 'offset' => $offset, 'from' => $from, 'count' => $count, 'max_photos' => $max_photos );
        return parent::Call( 'newsfeed.get', $Fields );
    }

    /**
     * Осуществляет поиск по новостям.
     * @param mixed $q Поисковой запрос, по которому необходимо получить результаты.
     * @param mixed $count Указывает, какое максимальное число записей следует возвращать, но не более 100.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества результатов поиска.
     * @param mixed $start_time Время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
     * @param mixed $end_time Время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
     * @param mixed $start_id Строковый id последней полученной записи. (Возвращается в результатах запроса, для того, чтобы исключить из выборки нового запроса уже полученные записи)
     * @param mixed $extended Указывается 1 если необходимо получить информацию о пользователе или группе, разместившей запись. По умолчанию 0.
     * @return object Result
     */
    Public Static Function search($q = null, $count = null, $offset = null, $start_time = null, $end_time = null, $start_id = null, $extended = null){
        $Fields = array( 'q' => $q, 'count' => $count, 'offset' => $offset, 'start_time' => $start_time, 'end_time' => $end_time, 'start_id' => $start_id, 'extended' => $extended );
        return parent::Call( 'newsfeed.search', $Fields );
    }

}

Class VK4DS_notifications extends VK4DS_Factory {
    /**
     * Возвращает список оповещений об ответах текущему пользователю.
     * @param mixed $filters Перечисленные через запятую типы оповещений, которые необходимо получить. В данный момент поддерживаются следующие типы оповещений:wall - записи на стене пользователя
    mentions - упоминания в записях на стене, в комментариях или в обсуждениях
    comments - комментарии к записям на стене, фотографиям и видеозаписям
    likes - отметки &quot;Мне нравится&quot;
    reposts - скопированные у текущего пользователя записи на стене, фотографии и видеозаписи
    followers - новые подписчики
    friends - принятые заявки в друзьяЕсли параметр не задан, то будут получены все возможные типы оповещений.
     * @param mixed $start_time Время, в формате unixtime, начиная с которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
     * @param mixed $end_time Время, в формате unixtime, до которого следует получить оповещения для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
     * @param mixed $offset Смещение, начиная с которого следует вернуть список оповещений.
     * @param mixed $count Указывает, какое максимальное число оповещений следует возвращать, но не более 100. По умолчанию 30.
     * @return object Result
     */
    Public Static Function get($filters = null, $start_time = null, $end_time = null, $offset = null, $count = null){
        $Fields = array( 'filters' => $filters, 'start_time' => $start_time, 'end_time' => $end_time, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'notifications.get', $Fields );
    }

    /**
     * Сбрасывает счетчик новых оповещений.
     * @return object Result
     */
    Public Static Function markAsViewed(){
        $Fields = array();
        return parent::Call( 'notifications.markAsViewed', $Fields );
    }

}

Class VK4DS_audio extends VK4DS_Factory {
    /**
     * Возвращает список аудиозаписей пользователя или группы.
     * @param mixed $uid Id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
     * @param mixed $gid Id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
     * @param mixed $album_id Id альбома, аудиозаписи которого необходимо вернуть (по умолчанию возвращаются аудиозаписи из всех альбомов).
     * @param mixed $aids Перечисленные через запятую id аудиозаписей, входящие в выборку по uid или gid.
     * @param mixed $need_user Если этот параметр равен 1, сервер возвратит базовую информацию о владельце аудиозаписей в структуре user (id, photo, name, name_gen).
     * @return object Result
     */
    Public Static Function get($uid = null, $gid = null, $album_id = null, $aids = null, $need_user = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'album_id' => $album_id, 'aids' => $aids, 'need_user' => $need_user );
        return parent::Call( 'audio.get', $Fields );
    }

    /**
     * Возвращает информацию об аудиозаписях по их идентификаторам.
     * @return object Result
     */
    Public Static Function getById(){
        $Fields = array();
        return parent::Call( 'audio.getById', $Fields );
    }

    /**
     * Возвращает количество аудиозаписей пользователя или группы.
     * @return object Result
     */
    Public Static Function getCount(){
        $Fields = array();
        return parent::Call( 'audio.getCount', $Fields );
    }

    /**
     * Возвращает адрес сервера для <a href="developers.php?oid=-1&p=%D0%9F%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B8_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2_%D0%BD%D0%B0_%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80_%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5
     * @return object Result
     */
    Public Static Function getUploadServer(){
        $Fields = array();
        return parent::Call( 'audio.getUploadServer', $Fields );
    }

    /**
     * Сохраняет аудиозаписи после успешной <a href="developers.php?oid=-1&p=%D0%9F%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B8_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2_%D0%BD%D0%B0_%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80_%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5
     * @param mixed $server Возвращаемый в результате загрузки аудиофайла на сервер.
     * @param mixed $audio Возвращаемый в результате загрузки аудиофайла на сервер.
     * @param mixed $hash Возвращаемый в результате загрузки аудиофайла на сервер.
     * @return object Result
     */
    Public Static Function save($server = null, $audio = null, $hash = null){
        $Fields = array( 'server' => $server, 'audio' => $audio, 'hash' => $hash );
        return parent::Call( 'audio.save', $Fields );
    }

    /**
     * Осуществляет поиск по аудиозаписям.
     * @param mixed $q Поискового запроса. Например, The Beatles.
     * @return object Result
     */
    Public Static Function search($q = null){
        $Fields = array( 'q' => $q );
        return parent::Call( 'audio.search', $Fields );
    }

    /**
     * Копирует существующую аудиозапись на страницу пользователя или группы.
     * @param mixed $aid Аудиозаписи.
     * @param mixed $oid Владельца аудиозаписи. Если копируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
     * @param mixed $gid Группы, в которую следует копировать аудиозапись. Если параметр не указан, аудиозапись копируется не в группу, а на страницу текущего пользователя. Если аудиозапись все же копируется в группу, у текущего пользователя должны быть права на эту операцию.
     * @return object Result
     */
    Public Static Function add($aid = null, $oid = null, $gid = null){
        $Fields = array( 'aid' => $aid, 'oid' => $oid, 'gid' => $gid );
        return parent::Call( 'audio.add', $Fields );
    }

    /**
     * Удаляет аудиозапись со страницы пользователя или группы.
     * @param mixed $aid Аудиозаписи.
     * @param mixed $oid Владельца аудиозаписи. Если удаляемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
     * @return object Result
     */
    Public Static Function delete($aid = null, $oid = null){
        $Fields = array( 'aid' => $aid, 'oid' => $oid );
        return parent::Call( 'audio.delete', $Fields );
    }

    /**
     * Редактирует аудиозапись пользователя или группы.
     * @param mixed $aid Аудиозаписи.
     * @param mixed $oid Владельца аудиозаписи. Если редактируемая аудиозапись находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
     * @param mixed $artist Исполнителя аудиозаписи.
     * @param mixed $title Аудиозаписи.
     * @param mixed $text Аудиозаписи, если введен.
     * @param mixed $no_search - скрывает аудиозапись из поиска по аудиозаписям, 0 (по умолчанию) - не скрывает.
     * @return object Result
     */
    Public Static Function edit($aid = null, $oid = null, $artist = null, $title = null, $text = null, $no_search = null){
        $Fields = array( 'aid' => $aid, 'oid' => $oid, 'artist' => $artist, 'title' => $title, 'text' => $text, 'no_search' => $no_search );
        return parent::Call( 'audio.edit', $Fields );
    }

    /**
     * Восстанавливает удаленную аудиозапись пользователя или группы.
     * @param mixed $aid Удаленной аудиозаписи.
     * @param mixed $oid Владельца аудиозаписи. По умолчанию - id текущего пользователя.
     * @return object Result
     */
    Public Static Function restore($aid = null, $oid = null){
        $Fields = array( 'aid' => $aid, 'oid' => $oid );
        return parent::Call( 'audio.restore', $Fields );
    }

    /**
     * Изменяет порядок аудиозаписи в списке аудиозаписей пользователя.
     * @param mixed $aid Аудиозаписи, порядок которой изменяется.
     * @param mixed $oid Владельца изменяемой аудиозаписи. По умолчанию - id текущего пользователя.
     * @param mixed $after Аудиозаписи, после которой нужно поместить аудиозапись. Если аудиозапись переносится в начало, параметр может быть равен нулю.
     * @param mixed $before Аудиозаписи, перед которой нужно поместить аудиозапись. Если аудиозапись переносится в конец, параметр может быть равен нулю.
     * @return object Result
     */
    Public Static Function reorder($aid = null, $oid = null, $after = null, $before = null){
        $Fields = array( 'aid' => $aid, 'oid' => $oid, 'after' => $after, 'before' => $before );
        return parent::Call( 'audio.reorder', $Fields );
    }

    /**
     * Возвращает альбомы аудиозаписей пользователя или группы.
     * @param mixed $uid Id пользователя, которому принадлежат аудиозаписи (по умолчанию — текущий пользователь)
     * @param mixed $gid Id группы, которой принадлежат аудиозаписи. Если указан параметр gid, uid игнорируется.
     * @param mixed $count Количество альбомов, которое необходимо вернуть. (по умолчанию – не больше 50, максимум - 100).
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества альбомов.
     * @return object Result
     */
    Public Static Function getAlbums($uid = null, $gid = null, $count = null, $offset = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'count' => $count, 'offset' => $offset );
        return parent::Call( 'audio.getAlbums', $Fields );
    }

    /**
     * Создает альбом аудиозаписей пользователя или группы.
     * @param mixed $title Альбома.
     * @param mixed $gid Группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
     * @return object Result
     */
    Public Static Function addAlbum($title = null, $gid = null){
        $Fields = array( 'title' => $title, 'gid' => $gid );
        return parent::Call( 'audio.addAlbum', $Fields );
    }

    /**
     * Изменяет название альбома аудиозаписей пользователя или группы.
     * @param mixed $title Название альбома.
     * @param mixed $album_id Редактируемого альбома.
     * @param mixed $gid Группы, которой принадлежат аудиозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
     * @return object Result
     */
    Public Static Function editAlbum($title = null, $album_id = null, $gid = null){
        $Fields = array( 'title' => $title, 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'audio.editAlbum', $Fields );
    }

    /**
     * Удаляет альбом аудиозаписей пользователя или группы.
     * @param mixed $album_id Удаляемого альбома.
     * @param mixed $gid Группы, которой принадлежат аудиозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
     * @return object Result
     */
    Public Static Function deleteAlbum($album_id = null, $gid = null){
        $Fields = array( 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'audio.deleteAlbum', $Fields );
    }

    /**
     * Перемещает в альбом аудиозаписи пользователя или группы.
     * @param mixed $aids Аудиозаписей, перечисленные через запятую.
     * @param mixed $album_id Альбома, в который перемещаются аудиозаписи.
     * @param mixed $gid Группы, которой принадлежат аудиозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
     * @return object Result
     */
    Public Static Function moveToAlbum($aids = null, $album_id = null, $gid = null){
        $Fields = array( 'aids' => $aids, 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'audio.moveToAlbum', $Fields );
    }

}

Class VK4DS_video extends VK4DS_Factory {
    /**
     * Возвращает информацию о видеозаписях.
     * @param mixed $uid Пользователя, видеозаписи которого нужно вернуть. Если указан параметр videos, uid игнорируется.
     * @param mixed $gid Группы, видеозаписи которой нужно вернуть. Если указан параметр videos, gid игнорируется.
     * @param mixed $aid Альбома видеозаписи из которого нужно вернуть.
     * @return object Result
     */
    Public Static Function get($uid = null, $gid = null, $aid = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'aid' => $aid );
        return parent::Call( 'video.get', $Fields );
    }

    /**
     * Редактирует данные видеозаписи на странице пользователя.
     * @param mixed $vid Видеозаписи.
     * @param mixed $oid Владельца видеозаписи.
     * @param mixed $name Видеозаписи.
     * @param mixed $desc Видеозаписи.
     * @return object Result
     */
    Public Static Function edit($vid = null, $oid = null, $name = null, $desc = null){
        $Fields = array( 'vid' => $vid, 'oid' => $oid, 'name' => $name, 'desc' => $desc );
        return parent::Call( 'video.edit', $Fields );
    }

    /**
     * Копирует видеозапись на страницу пользователя.
     * @param mixed $vid Видеозаписи.
     * @param mixed $oid Владельца видеозаписи.
     * @return object Result
     */
    Public Static Function add($vid = null, $oid = null){
        $Fields = array( 'vid' => $vid, 'oid' => $oid );
        return parent::Call( 'video.add', $Fields );
    }

    /**
     * Удаляет видеозапись со страницы пользователя.
     * @param mixed $vid Видеозаписи.
     * @param mixed $oid Владельца видеозаписи.
     * @return object Result
     */
    Public Static Function delete($vid = null, $oid = null){
        $Fields = array( 'vid' => $vid, 'oid' => $oid );
        return parent::Call( 'video.delete', $Fields );
    }

    /**
     * Возвращает список видеозаписей в соответствии с заданным критерием поиска.
     * @param mixed $q Поискового запроса. Например, The Beatles.
     * @return object Result
     */
    Public Static Function search($q = null){
        $Fields = array( 'q' => $q );
        return parent::Call( 'video.search', $Fields );
    }

    /**
     * Возвращает список видеозаписей, на которых отмечен пользователь.
     * @return object Result
     */
    Public Static Function getUserVideos(){
        $Fields = array();
        return parent::Call( 'video.getUserVideos', $Fields );
    }

    /**
     * Возвращает список комментариев к видеозаписи.
     * @param mixed $vid Видеозаписи.
     * @param mixed $sort Порядок сортировки комментариев (asc - от старых к новым, desc - от новых к старым)
     * @return object Result
     */
    Public Static Function getComments($vid = null, $sort = null){
        $Fields = array( 'vid' => $vid, 'sort' => $sort );
        return parent::Call( 'video.getComments', $Fields );
    }

    /**
     * Создает новый комментарий к видеозаписи.
     * @param mixed $vid Видеозаписи.
     * @param mixed $message Комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function createComment($vid = null, $message = null){
        $Fields = array( 'vid' => $vid, 'message' => $message );
        return parent::Call( 'video.createComment', $Fields );
    }

    /**
     * Изменяет текст комментария к видеозаписи.
     * @param mixed $message Комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function editComment($message = null){
        $Fields = array( 'message' => $message );
        return parent::Call( 'video.editComment', $Fields );
    }

    /**
     * Удаляет комментарий к видеозаписи.
     * @param mixed $cid Комментария.
     * @return object Result
     */
    Public Static Function deleteComment($cid = null){
        $Fields = array( 'cid' => $cid );
        return parent::Call( 'video.deleteComment', $Fields );
    }

    /**
     * Возвращает список отметок на видеозаписи.
     * @param mixed $vid Видеозаписи.
     * @return object Result
     */
    Public Static Function getTags($vid = null){
        $Fields = array( 'vid' => $vid );
        return parent::Call( 'video.getTags', $Fields );
    }

    /**
     * Добавляет отметку на видеозапись.
     * @param mixed $vid Видеозаписи.
     * @param mixed $uid Пользователя, которого нужно отметить на видеозаписи.
     * @return object Result
     */
    Public Static Function putTag($vid = null, $uid = null){
        $Fields = array( 'vid' => $vid, 'uid' => $uid );
        return parent::Call( 'video.putTag', $Fields );
    }

    /**
     * Удаляет отметку с видеозаписи.
     * @param mixed $vid Видеозаписи.
     * @param mixed $tag_id Отметки, которую нужно удалить.
     * @return object Result
     */
    Public Static Function removeTag($vid = null, $tag_id = null){
        $Fields = array( 'vid' => $vid, 'tag_id' => $tag_id );
        return parent::Call( 'video.removeTag', $Fields );
    }

    /**
     * Возвращает данные, необходимые для <a href="developers.php?oid=-1&p=%D0%9F%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B8_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2_%D0%BD%D0%B0_%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80_%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5
     * @param mixed $name Название видеофайла.
     * @param mixed $description Описание видеофайла.
     * @param mixed $gid Группа, в которую будет сохранён видеофайл. По умолчанию видеофайл сохраняется на страницу пользователя.
     * @return object Result
     */
    Public Static Function save($name = null, $description = null, $gid = null){
        $Fields = array( 'name' => $name, 'description' => $description, 'gid' => $gid );
        return parent::Call( 'video.save', $Fields );
    }

    /**
     * Возвращает альбомы видеозаписей пользователя или группы.
     * @param mixed $uid Id пользователя, которому принадлежат видеозаписи (по умолчанию — текущий пользователь)
     * @param mixed $gid Id группы, которой принадлежат видеозаписи. Если указан параметр gid, uid игнорируется.
     * @param mixed $count Количество альбомов, которое необходимо вернуть. (по умолчанию – не больше 50, максимум - 100).
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества альбомов.
     * @return object Result
     */
    Public Static Function getAlbums($uid = null, $gid = null, $count = null, $offset = null){
        $Fields = array( 'uid' => $uid, 'gid' => $gid, 'count' => $count, 'offset' => $offset );
        return parent::Call( 'video.getAlbums', $Fields );
    }

    /**
     * Создает альбом видеозаписей пользователя или группы.
     * @param mixed $title Альбома.
     * @param mixed $gid Группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом создается у текущего пользователя.
     * @return object Result
     */
    Public Static Function addAlbum($title = null, $gid = null){
        $Fields = array( 'title' => $title, 'gid' => $gid );
        return parent::Call( 'video.addAlbum', $Fields );
    }

    /**
     * Изменяет название альбома видеозаписей пользователя или группы.
     * @param mixed $title Название альбома.
     * @param mixed $album_id Редактируемого альбома.
     * @param mixed $gid Группы, которой принадлежат видеозаписи. Если параметр не указан, то изменяется альбом текущего пользователя.
     * @return object Result
     */
    Public Static Function editAlbum($title = null, $album_id = null, $gid = null){
        $Fields = array( 'title' => $title, 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'video.editAlbum', $Fields );
    }

    /**
     * Удаляет альбом видеозаписей пользователя или группы.
     * @param mixed $album_id Удаляемого альбома.
     * @param mixed $gid Группы, которой принадлежат видеозаписи. Если параметр не указан, то альбом удаляется у текущего пользователя.
     * @return object Result
     */
    Public Static Function deleteAlbum($album_id = null, $gid = null){
        $Fields = array( 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'video.deleteAlbum', $Fields );
    }

    /**
     * Перемещает в альбом видеозаписи пользователя или группы.
     * @param mixed $vids Видеозаписей, перечисленные через запятую.
     * @param mixed $album_id Альбома, в который перемещаются видеозаписи.
     * @param mixed $gid Группы, которой принадлежат видеозаписи. Если параметр не указан, то работа ведется с альбомом текущего пользователя.
     * @return object Result
     */
    Public Static Function moveToAlbum($vids = null, $album_id = null, $gid = null){
        $Fields = array( 'vids' => $vids, 'album_id' => $album_id, 'gid' => $gid );
        return parent::Call( 'video.moveToAlbum', $Fields );
    }

}

Class VK4DS_docs extends VK4DS_Factory {
    /**
     * Возвращает информацию о документах текущего пользователя или группы.
     * @param mixed $oid Пользователя или группы, документы которого нужно вернуть. По умолчанию – id текущего пользователя. Если необходимо получить документы группы, в этом параметре должно стоять значение, равное -id группы.
     * @return object Result
     */
    Public Static Function get($oid = null){
        $Fields = array( 'oid' => $oid );
        return parent::Call( 'docs.get', $Fields );
    }

    /**
     * Возвращает информацию о документах текущего пользователя по их id.
     * @return object Result
     */
    Public Static Function getById(){
        $Fields = array();
        return parent::Call( 'docs.getById', $Fields );
    }

    /**
     * Возвращает адрес сервера для <a href="developers.php?oid=-1&p=%D0%9F%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B8_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2_%D0%BD%D0%B0_%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80_%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5
     * @return object Result
     */
    Public Static Function getUploadServer(){
        $Fields = array();
        return parent::Call( 'docs.getUploadServer', $Fields );
    }

    /**
     * Возвращает адрес сервера для <a href="developers.php?oid=-1&p=%D0%9F%D1%80%D0%BE%D1%86%D0%B5%D1%81%D1%81_%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B8_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2_%D0%BD%D0%B0_%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80_%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5
     * @return object Result
     */
    Public Static Function getWallUploadServer(){
        $Fields = array();
        return parent::Call( 'docs.getWallUploadServer', $Fields );
    }

    /**
     * Удаляет документ пользователя или группы.
     * @param mixed $did Документа.
     * @param mixed $oid Владельца документы. Если удаляемый документ находится на странице группы, в этом параметре должно стоять значение, равное -id группы.
     * @return object Result
     */
    Public Static Function delete($did = null, $oid = null){
        $Fields = array( 'did' => $did, 'oid' => $oid );
        return parent::Call( 'docs.delete', $Fields );
    }

    /**
     * Cохраняет загруженные документы.
     * @param mixed $file Возвращаемый в результате загрузки файла на сервер.
     * @return object Result
     */
    Public Static Function save($file = null){
        $Fields = array( 'file' => $file );
        return parent::Call( 'docs.save', $Fields );
    }

}

Class VK4DS_places extends VK4DS_Factory {
    /**
     * Создает новое место.
     * @param mixed $title Нового места.
     * @param mixed $latitude Широта нового места, заданная в градусах (от -90 до 90).
     * @param mixed $longitude Долгота нового места, заданная в градусах (от -180 до 180).
     * @param mixed $type Типа нового места, полученный методом places.getTypes.
     * @return object Result
     */
    Public Static Function add($title = null, $latitude = null, $longitude = null, $type = null){
        $Fields = array( 'title' => $title, 'latitude' => $latitude, 'longitude' => $longitude, 'type' => $type );
        return parent::Call( 'places.add', $Fields );
    }

    /**
     * Возвращает информацию о местах.
     * @param mixed $places Перечисленные через запятую идентификаторы мест.Пример значения places:
    1,2,3,4,5
     * @return object Result
     */
    Public Static Function getById($places = null){
        $Fields = array( 'places' => $places );
        return parent::Call( 'places.getById', $Fields );
    }

    /**
     * Возвращает список найденных мест.
     * @param mixed $latitude Широта точки, в радиусе которой необходимо производить поиск, заданная в градусах (от -90 до 90).
     * @param mixed $longitude Долгота точки, в радиусе которой необходимо производить поиск, заданная в градусах (от -180 до 180).
     * @return object Result
     */
    Public Static Function search($latitude = null, $longitude = null){
        $Fields = array( 'latitude' => $latitude, 'longitude' => $longitude );
        return parent::Call( 'places.search', $Fields );
    }

    /**
     * Отмечает пользователя в указанном месте.
     * @param mixed $place_id Места.
     * @param mixed $services Список сервисов или сайтов, на которые необходимо экспортировать отметку, в случае если пользователь настроил соответствующую опцию. Например twitter, facebook.
     * @param mixed $friends_only 1 - отметка будет доступна только друзьям, 0 - всем пользователям. По умолчанию публикуемые отметки доступны всем пользователям.
     * @return object Result
     */
    Public Static Function checkin($place_id = null, $services = null, $friends_only = null){
        $Fields = array( 'place_id' => $place_id, 'services' => $services, 'friends_only' => $friends_only );
        return parent::Call( 'places.checkin', $Fields );
    }

    /**
     * Возвращает список отметок.
     * @param mixed $latitude Географическая широта исходной точки поиска, заданная в градусах (от -90 до 90).
     * @param mixed $longitude Географическая долгота исходной точки поиска, заданная в градусах (от -180 до 180).
     * @param mixed $place Идентификатор места. Игнорируется, если указаны latitude и longitude.
     * @param mixed $uid Идентификатор пользователя. Игнорируется, если указаны latitude и longitude или place.
     * @param mixed $offset Смещение относительно первой отметки для выборки определенного подмножества. Игнорируется, если установлен ненулевой timestamp.
     * @param mixed $count Количество возвращаемых отметок (максимум 50). Игнорируется, если установлен ненулевой timestamp.
     * @param mixed $timestamp Указывает, что нужно вернуть только те отметки, которые были созданы после заданного timestamp.
     * @param mixed $friends_only Указывает, что следует выводить только отметки друзей, если заданы географические координаты. Игнорируется, если не заданы параметры latitude и longitude.
     * @param mixed $need_places Указывает, следует ли возвращать информацию о месте в котором была сделана отметка. Игнорируется, если указан параметр place.
     * @return object Result
     */
    Public Static Function getCheckins($latitude = null, $longitude = null, $place = null, $uid = null, $offset = null, $count = null, $timestamp = null, $friends_only = null, $need_places = null){
        $Fields = array( 'latitude' => $latitude, 'longitude' => $longitude, 'place' => $place, 'uid' => $uid, 'offset' => $offset, 'count' => $count, 'timestamp' => $timestamp, 'friends_only' => $friends_only, 'need_places' => $need_places );
        return parent::Call( 'places.getCheckins', $Fields );
    }

    /**
     * Возвращает список типов мест.
     * @return object Result
     */
    Public Static Function getTypes(){
        $Fields = array();
        return parent::Call( 'places.getTypes', $Fields );
    }

    /**
     * Возвращает список стран.
     * @return object Result
     */
    Public Static Function getCountries(){
        $Fields = array();
        return parent::Call( 'places.getCountries', $Fields );
    }

    /**
     * Возвращает список городов.
     * @param mixed $country Страны, полученый в методе places.getCountries.
     * @return object Result
     */
    Public Static Function getCities($country = null){
        $Fields = array( 'country' => $country );
        return parent::Call( 'places.getCities', $Fields );
    }

    /**
     * Возвращает список регионов.
     * @param mixed $country Страны, полученный в методе places.getCountries.
     * @return object Result
     */
    Public Static Function getRegions($country = null){
        $Fields = array( 'country' => $country );
        return parent::Call( 'places.getRegions', $Fields );
    }

    /**
     * Возвращает информацию о странах по их id.
     * @param mixed $cids Через запятую ID стран.
     * @return object Result
     */
    Public Static Function getCountryById($cids = null){
        $Fields = array( 'cids' => $cids );
        return parent::Call( 'places.getCountryById', $Fields );
    }

    /**
     * Возвращает информацию о городах по их id.
     * @param mixed $cids Через запятую ID городов.
     * @return object Result
     */
    Public Static Function getCityById($cids = null){
        $Fields = array( 'cids' => $cids );
        return parent::Call( 'places.getCityById', $Fields );
    }

    /**
     * Возвращает информацию об улицах по их id.
     * @return object Result
     */
    Public Static Function getStreetById(){
        $Fields = array();
        return parent::Call( 'places.getStreetById', $Fields );
    }

}

Class VK4DS_secure extends VK4DS_Factory {
    /**
     * Отправляет уведомление пользователю.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @param mixed $uids Через запятую ID пользователей, которым отправляется уведомление (максимум 100 штук).
     * @param mixed $message Уведомления, который следует передавать в кодировке UTF-8 (максимум 254 символа).
     * @return object Result
     */
    Public Static Function sendNotification($timestamp = null, $random = null, $uids = null, $message = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random, 'uids' => $uids, 'message' => $message );
        return parent::Call( 'secure.sendNotification', $Fields );
    }

    /**
     * Возвращает платежный баланс приложения.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @return object Result
     */
    Public Static Function getAppBalance($timestamp = null, $random = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random );
        return parent::Call( 'secure.getAppBalance', $Fields );
    }

    /**
     * Возвращает историю транзакций внутри приложения.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @return object Result
     */
    Public Static Function getTransactionsHistory($timestamp = null, $random = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random );
        return parent::Call( 'secure.getTransactionsHistory', $Fields );
    }

    /**
     * Поднимает пользователю рейтинг от имени приложения.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @param mixed $uid Пользователя, которому повышается рейтинг.
     * @param mixed $rate Баллов рейтинга, которое следует добавить.
     * @return object Result
     */
    Public Static Function addRating($timestamp = null, $random = null, $uid = null, $rate = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random, 'uid' => $uid, 'rate' => $rate );
        return parent::Call( 'secure.addRating', $Fields );
    }

    /**
     * Устанавливает счетчик, который выводится пользователю жирным шрифтом в левом меню, если он добавил приложение в левое меню.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @param mixed $uid Пользователя, которому устанавливается счетчик.
     * @param mixed $counter Счетчика.
     * @return object Result
     */
    Public Static Function setCounter($timestamp = null, $random = null, $uid = null, $counter = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random, 'uid' => $uid, 'counter' => $counter );
        return parent::Call( 'secure.setCounter', $Fields );
    }

    /**
     * Устанавливает уровень пользователя в приложении.
     * @param mixed $uid Пользователя, которому устанавливается уровень.
     * @param mixed $level Значение текущего уровня пользователя.
     * @return object Result
     */
    Public Static Function setUserLevel($uid = null, $level = null){
        $Fields = array( 'uid' => $uid, 'level' => $level );
        return parent::Call( 'secure.setUserLevel', $Fields );
    }

    /**
     * Получает уровень пользователя в приложении.
     * @param mixed $uids Пользователей, разделённые через запятую, игровые уровни которых необходимо получить.
     * @return object Result
     */
    Public Static Function getUserLevel($uids = null){
        $Fields = array( 'uids' => $uids );
        return parent::Call( 'secure.getUserLevel', $Fields );
    }

    /**
     * Возвращает список SMS-уведомлений, отосланных приложением.
     * @param mixed $timestamp UNIX-time сервера.
     * @param mixed $random Любое случайное число для обеспечения уникальности запроса
     * @param mixed $uid Фильтр по id пользователя, которому высылалось уведомление.
     * @param mixed $date_from Фильтр по дате начала. Задается в виде UNIX-time.
     * @param mixed $date_to Фильтр по дате окончания. Задается в виде UNIX-time.
     * @param mixed $limit Количество возвращаемых записей. По умолчанию 1000.
     * @return object Result
     */
    Public Static Function getSMSHistory($timestamp = null, $random = null, $uid = null, $date_from = null, $date_to = null, $limit = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random, 'uid' => $uid, 'date_from' => $date_from, 'date_to' => $date_to, 'limit' => $limit );
        return parent::Call( 'secure.getSMSHistory', $Fields );
    }

    /**
     * Отправляет SMS-уведомление на телефон пользователя.
     * @param mixed $timestamp Сервера.
     * @param mixed $random Случайное число для обеспечения уникальности запроса
     * @param mixed $uid Пользователя, которому отправляется SMS-уведомление. Пользователь должен разрешить приложению отсылать ему уведомления (getUserSettings, +1).
     * @param mixed $message SMS, который следует передавать в кодировке UTF-8. Допускаются только латинские буквы и цифры. Максимальный размер - 160 символов.
     * @return object Result
     */
    Public Static Function sendSMSNotification($timestamp = null, $random = null, $uid = null, $message = null){
        $Fields = array( 'timestamp' => $timestamp, 'random' => $random, 'uid' => $uid, 'message' => $message );
        return parent::Call( 'secure.sendSMSNotification', $Fields );
    }

}

Class VK4DS_storage extends VK4DS_Factory {
    /**
     * Возвращает значение хранимой переменной.
     * @param mixed $key Название переменной длиной не более 100 символов.
     * @param mixed $uid Пользователя, переменная которого считывается, в случае если данные запрашиваются серверным методом.
     * @return object Result
     */
    Public Static Function get($key = null, $uid = null){
        $Fields = array( 'key' => $key, 'uid' => $uid );
        return parent::Call( 'storage.get', $Fields );
    }

    /**
     * Сохраняет значение хранимой переменной.
     * @param mixed $key Название переменной длиной не более 100 символов. Может содержать символы латинского алфавита, цифры, знак тире, нижнее подчёркивание [a-zA-Z_&#092;-0-9].
     * @param mixed $uid Пользователя, переменная которого устанавливается, в случае если данные запрашиваются серверным методом.
     * @return object Result
     */
    Public Static Function set($key = null, $uid = null){
        $Fields = array( 'key' => $key, 'uid' => $uid );
        return parent::Call( 'storage.set', $Fields );
    }

}

Class VK4DS_notes extends VK4DS_Factory {
    /**
     * Возвращает список заметок пользователя.
     * @param mixed $uid Id пользователя, заметки которого нужно вернуть. По умолчанию – id текущего пользователя.
     * @param mixed $nids Перечисленные через запятую id заметок, входящие в выборку по uid.
     * @param mixed $sort Сортировка результатов (0 - по дате создания в порядке убывания, 1 - по дате создания в порядке возрастания).
     * @param mixed $count Количество сообщений, которое необходимо получить (но не более 100). По умолчанию выставляется 20.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества заметок.
     * @return object Result
     */
    Public Static Function get($uid = null, $nids = null, $sort = null, $count = null, $offset = null){
        $Fields = array( 'uid' => $uid, 'nids' => $nids, 'sort' => $sort, 'count' => $count, 'offset' => $offset );
        return parent::Call( 'notes.get', $Fields );
    }

    /**
     * Возвращает текущую заметку пользователя.
     * @param mixed $nid Id запрашиваемой заметки.
     * @param mixed $owner_id Id владельца заметки (по умолчанию используется id текущего пользователя)
     * @param mixed $need_wiki Определяет, требуется ли в ответе wiki-представление заметки (работает, только если запрашиваются заметки текущего пользователя)
     * @return object Result
     */
    Public Static Function getById($nid = null, $owner_id = null, $need_wiki = null){
        $Fields = array( 'nid' => $nid, 'owner_id' => $owner_id, 'need_wiki' => $need_wiki );
        return parent::Call( 'notes.getById', $Fields );
    }

    /**
     * Возвращает список заметок друзей пользователя.
     * @return object Result
     */
    Public Static Function getFriendsNotes(){
        $Fields = array();
        return parent::Call( 'notes.getFriendsNotes', $Fields );
    }

    /**
     * Создаёт новую заметку
     * @param mixed $title Заметки.
     * @param mixed $text Заметки.
     * @return object Result
     */
    Public Static Function add($title = null, $text = null){
        $Fields = array( 'title' => $title, 'text' => $text );
        return parent::Call( 'notes.add', $Fields );
    }

    /**
     * Редактирует заметку пользователя
     * @param mixed $nid Редактируемой заметки.
     * @param mixed $title Заметки.
     * @param mixed $text Заметки.
     * @return object Result
     */
    Public Static Function edit($nid = null, $title = null, $text = null){
        $Fields = array( 'nid' => $nid, 'title' => $title, 'text' => $text );
        return parent::Call( 'notes.edit', $Fields );
    }

    /**
     * Удаляет заметку пользователя
     * @param mixed $nid Удаляемой заметки.
     * @return object Result
     */
    Public Static Function delete($nid = null){
        $Fields = array( 'nid' => $nid );
        return parent::Call( 'notes.delete', $Fields );
    }

    /**
     * Возвращает список комментариев к заметке.
     * @param mixed $nid Id заметки, комментарии которой нужно вернуть
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь).
     * @param mixed $sort Сортировка результатов (0 - по дате добавления в порядке возрастания, 1 - по дате добавления в порядке убывания).
     * @param mixed $count Количество комментариев, которое необходимо получить (не более 100). По умолчанию выставляется 20.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества комментариев.
     * @return object Result
     */
    Public Static Function getComments($nid = null, $owner_id = null, $sort = null, $count = null, $offset = null){
        $Fields = array( 'nid' => $nid, 'owner_id' => $owner_id, 'sort' => $sort, 'count' => $count, 'offset' => $offset );
        return parent::Call( 'notes.getComments', $Fields );
    }

    /**
     * Добавляет новый комментарий к заметке.
     * @param mixed $nid Id заметки, в которой нужно создать комментарий
     * @param mixed $owner_id Идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
     * @param mixed $reply_to Id пользователя, ответом на комментарий которого является добавляемый комментарий (не передаётся если комментарий не является ответом).
     * @param mixed $message Текст комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function createComment($nid = null, $owner_id = null, $reply_to = null, $message = null){
        $Fields = array( 'nid' => $nid, 'owner_id' => $owner_id, 'reply_to' => $reply_to, 'message' => $message );
        return parent::Call( 'notes.createComment', $Fields );
    }

    /**
     * Изменяет текст комментария к заметке.
     * @param mixed $message Текст комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function editComment($message = null){
        $Fields = array( 'message' => $message );
        return parent::Call( 'notes.editComment', $Fields );
    }

    /**
     * Удаляет комментарий у заметки.
     * @return object Result
     */
    Public Static Function deleteComment(){
        $Fields = array();
        return parent::Call( 'notes.deleteComment', $Fields );
    }

    /**
     * Восстанавливает комментарий у заметки.
     * @param mixed $owner_id Идентификатор пользователя, владельца заметки (по умолчанию - текущий пользователь).
     * @return object Result
     */
    Public Static Function restoreComment($owner_id = null){
        $Fields = array( 'owner_id' => $owner_id );
        return parent::Call( 'notes.restoreComment', $Fields );
    }

}

Class VK4DS_pages extends VK4DS_Factory {
    /**
     * Возвращает вики-страницу.
     * @param mixed $pid Вики-страницы. Вместо pid может быть передан параметр title - название вики-страницы.
     * @param mixed $gid Группы, где создана страница.
     * @param mixed $mid Создателя вики-страницы, в случае если необходимо обратиться к одной из личных вики страниц пользователя.
     * @param mixed $global1 - требуется получить глобальную вики-страницу. В данном случае, при указании параметра title, параметры gid и mid игнорируются. По умолчанию 0.
     * @return object Result
     */
    Public Static Function get($pid = null, $gid = null, $mid = null, $global1 = null){
        $Fields = array( 'pid' => $pid, 'gid' => $gid, 'mid' => $mid, 'global1' => $global1 );
        return parent::Call( 'pages.get', $Fields );
    }

    /**
     * Сохраняет текст вики-страницы.
     * @param mixed $pid Вики-страницы. Вместо pid может быть передан параметр title - название вики-страницы. В этом случае если страницы с таким названием еще нет, она будет создана.
     * @param mixed $gid Группы, где создана страница. Вместо gid может быть передан параметр mid - id создателя вики-страницы. В этом случае произойдет обращение не к странице группы, а к одной из личных вики-страниц пользователя.
     * @param mixed $Text Текст страницы в вики-формате.
     * @return object Result
     */
    Public Static Function save($pid = null, $gid = null, $Text = null){
        $Fields = array( 'pid' => $pid, 'gid' => $gid, 'Text' => $Text );
        return parent::Call( 'pages.save', $Fields );
    }

    /**
     * Сохраняет настройки доступа вики-страницы.
     * @param mixed $pid Вики-страницы.
     * @param mixed $gid Группы, где создана страница.
     * @param mixed $view Настройки доступа на чтение; описание значений Вы можете узнать странице, посвященной методу pages.get.
     * @param mixed $edit Настройки доступа на редактирование; описание значений Вы можете узнать странице, посвященной методу pages.get.
     * @return object Result
     */
    Public Static Function saveAccess($pid = null, $gid = null, $view = null, $edit = null){
        $Fields = array( 'pid' => $pid, 'gid' => $gid, 'view' => $view, 'edit' => $edit );
        return parent::Call( 'pages.saveAccess', $Fields );
    }

    /**
     * Возвращает старую версию вики-страницы.
     * @param mixed $hid Версии вики-страницы.
     * @param mixed $gid Группы, где создана страница.
     * @return object Result
     */
    Public Static Function getVersion($hid = null, $gid = null){
        $Fields = array( 'hid' => $hid, 'gid' => $gid );
        return parent::Call( 'pages.getVersion', $Fields );
    }

    /**
     * Возвращает список всех старых версий вики-страницы.
     * @param mixed $pid Вики-страницы.
     * @param mixed $gid Группы, где создана страница.
     * @return object Result
     */
    Public Static Function getHistory($pid = null, $gid = null){
        $Fields = array( 'pid' => $pid, 'gid' => $gid );
        return parent::Call( 'pages.getHistory', $Fields );
    }

    /**
     * Возвращает список вики-страниц в группе.
     * @param mixed $gid Группы, где создана страница. Если параметр не указывать, возвращается список всех страниц, созданных текущим пользователем.
     * @return object Result
     */
    Public Static Function getTitles($gid = null){
        $Fields = array( 'gid' => $gid );
        return parent::Call( 'pages.getTitles', $Fields );
    }

    /**
     * Возвращает html-представление wiki-разметки.
     * @param mixed $text В вики-формате.
     * @return object Result
     */
    Public Static Function parseWiki($text = null){
        $Fields = array( 'text' => $text );
        return parent::Call( 'pages.parseWiki', $Fields );
    }

}

Class VK4DS_stats extends VK4DS_Factory {
    /**
     * Возвращает статистику группы или приложения.
     * @param mixed $gid ID группы, статистику которой необходимо получить.
     * @param mixed $aid ID приложения, статистику которой необходимо получить.
     * @param mixed $date_from Начальная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
     * @param mixed $date_to Конечная дата выводимой статистики в формате YYYY-MM-DD, пример: 2011-09-27 - 27 сентября 2011
     * @return object Result
     */
    Public Static Function get($gid, $aid = null, $date_from = null, $date_to = null){
        $Fields = array( 'gid' => $gid, 'aid' => $aid, 'date_from' => $date_from, 'date_to' => $date_to );
        return parent::Call( 'stats.get', $Fields );
    }

}

Class VK4DS_subscriptions extends VK4DS_Factory {
    /**
     * Возвращает список подписок пользователя.
     * @param mixed $uid Идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
     * @param mixed $offset Смещение относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
     * @param mixed $count Количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра – 1000.
     * @return object Result
     */
    Public Static Function get($uid = null, $offset = null, $count = null){
        $Fields = array( 'uid' => $uid, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'subscriptions.get', $Fields );
    }

    /**
     * Возвращает список подписчиков пользователя.
     * @return object Result
     */
    Public Static Function getFollowers(){
        $Fields = array();
        return parent::Call( 'subscriptions.getFollowers', $Fields );
    }

}

Class VK4DS_widgets extends VK4DS_Factory {
    /**
     * Возвращает список страниц приложения, на которых установлены виджеты.
     * @param mixed $widget_api_id Приложения/сайта, с которым инициализируются виджеты.
     * @return object Result
     */
    Public Static Function getPages($widget_api_id = null){
        $Fields = array( 'widget_api_id' => $widget_api_id );
        return parent::Call( 'widgets.getPages', $Fields );
    }

    /**
     * Возвращает список комментариев к странице.
     * @param mixed $widget_api_id Приложения/сайта, с которым инициализируются виджеты.
     * @return object Result
     */
    Public Static Function getComments($widget_api_id = null){
        $Fields = array( 'widget_api_id' => $widget_api_id );
        return parent::Call( 'widgets.getComments', $Fields );
    }

}

Class VK4DS_messages extends VK4DS_Factory {
    /**
     * Возвращает список диалогов текущего пользователя.
     * @param mixed $uid Идентификатор пользователя, последнее сообщение в переписке с которым необходимо вернуть.
     * @param mixed $chat_id Идентификатор беседы, последнее сообщение в которой необходимо вернуть.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества диалогов.
     * @param mixed $count Количество диалогов, которое необходимо получить (но не более 200).
     * @param mixed $preview_length Количество символов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
     * @return object Result
     */
    Public Static Function getDialogs($uid = null, $chat_id = null, $offset = null, $count = null, $preview_length = null){
        $Fields = array( 'uid' => $uid, 'chat_id' => $chat_id, 'offset' => $offset, 'count' => $count, 'preview_length' => $preview_length );
        return parent::Call( 'messages.getDialogs', $Fields );
    }

    /**
     * Возвращает историю сообщений для данного пользователя.
     * @param mixed $uid Идентификатор пользователя, историю переписки с которым необходимо вернуть. Является необязательным параметром в случае с истории сообщений в беседе.
     * @param mixed $chat_id Идентификатор беседы, историю переписки в которой необходимо вернуть.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества сообщений.
     * @param mixed $count Количество сообщений, которое необходимо получить (но не более 200).
     * @param mixed $start_mid Идентификатор сообщения, начиная с которго необходимо получить последующие сообщения.
     * @param mixed $rev 1 – возвращать сообщения в хронологическом порядке. 0 – возвращать сообщения в обратном хронологическом порядке (по умолчанию)
     * @return object Result
     */
    Public Static Function getHistory($uid, $chat_id = null, $offset = null, $count = null, $start_mid = null, $rev = null){
        $Fields = array( 'uid' => $uid, 'chat_id' => $chat_id, 'offset' => $offset, 'count' => $count, 'start_mid' => $start_mid, 'rev' => $rev );
        return parent::Call( 'messages.getHistory', $Fields );
    }

    /**
     * Возвращает сообщения по их ID.
     * @param mixed $mid ID сообщения, если необходимо получить одно сообщение. Если указан параметр mids, этот параметр игнорируется.
     * @param mixed $mids ID сообщений, которые необходимо вернуть, разделенные запятыми (не более 100
     * @param mixed $preview_length Количество слов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются).
     * @return object Result
     */
    Public Static Function getById($mid, $mids = null, $preview_length = null){
        $Fields = array( 'mid' => $mid, 'mids' => $mids, 'preview_length' => $preview_length );
        return parent::Call( 'messages.getById', $Fields );
    }

    /**
     * Возвращает список входящих либо исходящих сообщений текущего пользователя.
     * @param mixed $out Если этот параметр равен 1, сервер вернет исходящие сообщения.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества сообщений.
     * @param mixed $count Количество сообщений, которое необходимо получить (но не более 100).
     * @param mixed $filters Фильтр возвращаемых сообщений: 1 - только непрочитанные; 2 - не из чата; 4 - сообщения от друзей. Если установлен флаг &quot;4&quot;, то флаги &quot;1&quot; и &quot;2&quot; не учитываются.
     * @param mixed $preview_length Количество символов, по которому нужно обрезать сообщение. Укажите 0, если Вы не хотите обрезать сообщение. (по умолчанию сообщения не обрезаются). Обратите внимание что сообщения обрезаются по словам.
     * @param mixed $time_offset Максимальное время, прошедшее с момента отправки сообщения до текущего момента в секундах. 0, если Вы хотите получить сообщения любой давности.
     * @return object Result
     */
    Public Static Function get($out = null, $offset = null, $count = null, $filters = null, $preview_length = null, $time_offset = null){
        $Fields = array( 'out' => $out, 'offset' => $offset, 'count' => $count, 'filters' => $filters, 'preview_length' => $preview_length, 'time_offset' => $time_offset );
        return parent::Call( 'messages.get', $Fields );
    }

    /**
     * Возвращает список диалогов и бесед пользователя по поисковому запросу.
     * @param mixed $q По которой будет производиться поиск.
     * @param mixed $fields Поля профилей собеседников, которые необходимо вернуть.
     * @return object Result
     */
    Public Static Function searchDialogs($q = null, $fields = null){
        $Fields = array( 'q' => $q, 'fields' => $fields );
        return parent::Call( 'messages.searchDialogs', $Fields );
    }

    /**
     * Возвращает найденные сообщения текущего пользователя по введенной строке поиска.
     * @param mixed $q По которой будет производиться поиск.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества сообщений из списка найденных.
     * @param mixed $count Количество сообщений, которое необходимо получить (но не более 100).
     * @return object Result
     */
    Public Static Function search($q = null, $offset = null, $count = null){
        $Fields = array( 'q' => $q, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'messages.search', $Fields );
    }

    /**
     * Посылает сообщение.
     * @param mixed $uid ID пользователя (по умолчанию - текущий пользователь
     * @param mixed $chat_id ID беседы, к которой будет относиться сообщение
     * @param mixed $title Заголовок сообщения.
     * @param mixed $type 0  - обычное сообщение, 1 - сообщение из чата. (по умолчанию 0)
     * @param mixed $lat Latitude, широта при добавлении метоположения.
     * @param mixed $long Longitude, долгота при добавлении метоположения.
     * @param mixed $guid Уникальный строковой идентификатор, предназначенный для предотвращения повторной отправки одинакового сообщения.
     * @return object Result
     */
    Public Static Function send($uid, $chat_id = null, $title = null, $type = null, $lat = null, $long = null, $guid = null){
        $Fields = array( 'uid' => $uid, 'chat_id' => $chat_id, 'title' => $title, 'type' => $type, 'lat' => $lat, 'long' => $long, 'guid' => $guid );
        return parent::Call( 'messages.send', $Fields );
    }

    /**
     * Удаляет сообщение.
     * @param mixed $mids Список идентификаторов сообщений, разделённых через запятую.
     * @return object Result
     */
    Public Static Function delete($mids = null){
        $Fields = array( 'mids' => $mids );
        return parent::Call( 'messages.delete', $Fields );
    }

    /**
     * Удаляет все сообщения в диалоге,
     * @param mixed $uid ID пользователя.
     * @param mixed $chat_id ID беседы, к которой будет относиться сообщение
     * @param mixed $offset Начиная с какого сообщения нужно удалить переписку. (По умолчанию удаляются все сообщения начиная с первого).
     * @param mixed $limit Как много сообщений нужно удалить. Обратите внимание что на метод наложено ограничение, за один вызов нельзя удалить больше 10000 сообщений, поэтому если сообщений в переписке больше - метод нужно вызывать несколько раз.
     * @return object Result
     */
    Public Static Function deleteDialog($uid, $chat_id = null, $offset = null, $limit = null){
        $Fields = array( 'uid' => $uid, 'chat_id' => $chat_id, 'offset' => $offset, 'limit' => $limit );
        return parent::Call( 'messages.deleteDialog', $Fields );
    }

    /**
     * Восстанавливает только что удаленное сообщение.
     * @param mixed $mid Идентификатор сообщения.
     * @return object Result
     */
    Public Static Function restore($mid = null){
        $Fields = array( 'mid' => $mid );
        return parent::Call( 'messages.restore', $Fields );
    }

    /**
     * Помечает сообщения как непрочитанные.
     * @param mixed $mids Идентификаторов сообщений, разделенных запятой.
     * @return object Result
     */
    Public Static Function markAsNew($mids = null){
        $Fields = array( 'mids' => $mids );
        return parent::Call( 'messages.markAsNew', $Fields );
    }

    /**
     * Помечает сообщения как прочитанные.
     * @param mixed $mids Список идентификаторов сообщений, разделенных запятой.
     * @return object Result
     */
    Public Static Function markAsRead($mids = null){
        $Fields = array( 'mids' => $mids );
        return parent::Call( 'messages.markAsRead', $Fields );
    }

    /**
     * Изменяет статус набора текста пользователем в диалоге.
     * @param mixed $uid ID пользователя (по умолчанию - текущий пользователь
     * @param mixed $chat_id ID беседы, к которой будет относиться сообщение
     * @param mixed $type - пользователь начал набирать текст
     * @return object Result
     */
    Public Static Function setActivity($uid, $chat_id = null, $type = null){
        $Fields = array( 'uid' => $uid, 'chat_id' => $chat_id, 'type' => $type );
        return parent::Call( 'messages.setActivity', $Fields );
    }

    /**
     * Возвращает текущий статус и время последней активности пользователя.
     * @param mixed $uid Пользователя, для которого нужно получить время активности.
     * @return object Result
     */
    Public Static Function getLastActivity($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'messages.getLastActivity', $Fields );
    }

    /**
     * Получить информацию о беседе.
     * @param mixed $chat_id Чата
     * @return object Result
     */
    Public Static Function getChat($chat_id = null){
        $Fields = array( 'chat_id' => $chat_id );
        return parent::Call( 'messages.getChat', $Fields );
    }

    /**
     * Создаёт беседу с несколькими участниками.
     * @param mixed $uids Идентификаторов друзей текущего пользователя с которыми необходимо создать беседу.
     * @param mixed $title Название мультидиалога.
     * @return object Result
     */
    Public Static Function createChat($uids = null, $title = null){
        $Fields = array( 'uids' => $uids, 'title' => $title );
        return parent::Call( 'messages.createChat', $Fields );
    }

    /**
     * Изменяет название беседы.
     * @param mixed $chat_id Чата
     * @param mixed $title Беседы.
     * @return object Result
     */
    Public Static Function editChat($chat_id = null, $title = null){
        $Fields = array( 'chat_id' => $chat_id, 'title' => $title );
        return parent::Call( 'messages.editChat', $Fields );
    }

    /**
     * Получает список участников беседы.
     * @param mixed $chat_id Беседы, пользователей которой необходимо получить
     * @return object Result
     */
    Public Static Function getChatUsers($chat_id = null){
        $Fields = array( 'chat_id' => $chat_id );
        return parent::Call( 'messages.getChatUsers', $Fields );
    }

    /**
     * Добавляет в беседу нового участника.
     * @param mixed $chat_id Беседы, в которую необходимо добавить пользователя
     * @param mixed $uid Пользователя.
     * @return object Result
     */
    Public Static Function addChatUser($chat_id = null, $uid = null){
        $Fields = array( 'chat_id' => $chat_id, 'uid' => $uid );
        return parent::Call( 'messages.addChatUser', $Fields );
    }

    /**
     * Исключает участника из беседы.
     * @param mixed $chat_id Беседы, из которой необходимо удалить пользователя.
     * @param mixed $uid Пользователя.
     * @return object Result
     */
    Public Static Function removeChatUser($chat_id = null, $uid = null){
        $Fields = array( 'chat_id' => $chat_id, 'uid' => $uid );
        return parent::Call( 'messages.removeChatUser', $Fields );
    }

    /**
     * Возвращает данные, необходимые для LongPoll
     * @return object Result
     */
    Public Static Function getLongPollServer(){
        $Fields = array();
        return parent::Call( 'messages.getLongPollServer', $Fields );
    }

    /**
     * Возвращает последовательность обновлений в личных сообщениях пользователя начиная с указанного времени.
     * @param mixed $ts Значение параметра ts, полученное от Long Poll сервера или с помощью метода messages.getLongPollServer
     * @return object Result
     */
    Public Static Function getLongPollHistory($ts = null){
        $Fields = array( 'ts' => $ts );
        return parent::Call( 'messages.getLongPollHistory', $Fields );
    }

}

Class VK4DS_wallEx extends VK4DS_Factory {
    /**
     * Удаляет запись со стены.
     * @param mixed $post_id Записи на стене пользователя.
     * @return object Result
     */
    Public Static Function delete($post_id = null){
        $Fields = array( 'post_id' => $post_id );
        return parent::Call( 'wall.delete', $Fields );
    }

    /**
     * Восстанавливает удаленную со стены запись.
     * @param mixed $post_id Записи на стене пользователя.
     * @return object Result
     */
    Public Static Function restore($post_id = null){
        $Fields = array( 'post_id' => $post_id );
        return parent::Call( 'wall.restore', $Fields );
    }

    /**
     * Получает комментарии к записи на стене пользователя.
     * @param mixed $owner_id Идентификатор пользователя, на чьей стене находится запись, к которой необходимо получить комментарии. Если параметр не задан, то он считается равным идентификатору текущего пользователя.
     * @param mixed $post_id Идентификатор записи на стене пользователя.
     * @param mixed $sort Порядок сортировки комментариев:asc - хронологический
    desc - антихронологический
     * @param mixed $need_likes 1 - будет возвращено дополнительное поле likes. По умолчанию поле likes не возвращается.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества комментариев.
     * @param mixed $count Количество комментариев, которое необходимо получить (но не более 100).
     * @param mixed $preview_length Количество символов, по которому нужно обрезать комментарии. Укажите 0, если Вы не хотите обрезать комментарии. (по умолчанию 90). Обратите внимание, что комментарии обрезаются по словам.
     * @return object Result
     */
    Public Static Function getComments($owner_id = null, $post_id = null, $sort = null, $need_likes = null, $offset = null, $count = null, $preview_length = null){
        $Fields = array( 'owner_id' => $owner_id, 'post_id' => $post_id, 'sort' => $sort, 'need_likes' => $need_likes, 'offset' => $offset, 'count' => $count, 'preview_length' => $preview_length );
        return parent::Call( 'wall.getComments', $Fields );
    }

    /**
     * Добавляет комментарий к записи на стене пользователя.
     * @param mixed $post_id Записи на стене пользователя.
     * @param mixed $text Комментария к записи на стене пользователя.
     * @return object Result
     */
    Public Static Function addComment($post_id = null, $text = null){
        $Fields = array( 'post_id' => $post_id, 'text' => $text );
        return parent::Call( 'wall.addComment', $Fields );
    }

    /**
     * Удаляет комментарий к записи на стене полльзователя.
     * @param mixed $cid Комментария на стене пользователя.
     * @return object Result
     */
    Public Static Function deleteComment($cid = null){
        $Fields = array( 'cid' => $cid );
        return parent::Call( 'wall.deleteComment', $Fields );
    }

    /**
     * Восстанавливает комментарий к записи на стене пользователя.
     * @param mixed $cid Комментария на стене пользователя.
     * @return object Result
     */
    Public Static Function restoreComment($cid = null){
        $Fields = array( 'cid' => $cid );
        return parent::Call( 'wall.restoreComment', $Fields );
    }

    /**
     * Добавляет запись на стене пользователя в список <b>Мне нравится</b>.
     * @param mixed $post_id Сообщения на стене пользователя, которое необходимо добавить в список Мне нравится.
     * @return object Result
     */
    Public Static Function addLike($post_id = null){
        $Fields = array( 'post_id' => $post_id );
        return parent::Call( 'wall.addLike', $Fields );
    }

    /**
     * Удаляет запись на стене пользователя из списка <b>Мне нравится</b>.
     * @param mixed $post_id Сообщения на стене пользователя, которое необходимо удалить из списка Мне нравится.
     * @return object Result
     */
    Public Static Function deleteLike($post_id = null){
        $Fields = array( 'post_id' => $post_id );
        return parent::Call( 'wall.deleteLike', $Fields );
    }

}

Class VK4DS_photosEx extends VK4DS_Factory {
    /**
     * Возвращает список комментариев к фотографии.
     * @param mixed $pid Идентификатор фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будут возвращены комментарии к фотографии группы с идентификатором
    -owner_id.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества комментариев.
     * @param mixed $count Количество комментариев, которое необходимо получить (но не более 100).
     * @param mixed $sort Порядок сортировки комментариев (asc - от старых к новым, desc - от новых к старым)
     * @return object Result
     */
    Public Static Function getComments($pid = null, $owner_id = null, $offset = null, $count = null, $sort = null){
        $Fields = array( 'pid' => $pid, 'owner_id' => $owner_id, 'offset' => $offset, 'count' => $count, 'sort' => $sort );
        return parent::Call( 'photos.getComments', $Fields );
    }

    /**
     * Возвращает список комментариев к альбому или ко всем альбомам.
     * @return object Result
     */
    Public Static Function getAllComments(){
        $Fields = array();
        return parent::Call( 'photos.getAllComments', $Fields );
    }

    /**
     * Создает новый комментарий к фотографии.
     * @param mixed $pid Идентификатор фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет создан комментарий к фотографии группы с идентификатором
    -owner_id.
     * @param mixed $message Текст комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function createComment($pid = null, $owner_id = null, $message = null){
        $Fields = array( 'pid' => $pid, 'owner_id' => $owner_id, 'message' => $message );
        return parent::Call( 'photos.createComment', $Fields );
    }

    /**
     * Изменяет текст комментария к фотографии.
     * @param mixed $pid Идентификатор фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь).
     * @param mixed $message Текст комментария (минимальная длина - 2 символа).
     * @return object Result
     */
    Public Static Function editComment($pid = null, $owner_id = null, $message = null){
        $Fields = array( 'pid' => $pid, 'owner_id' => $owner_id, 'message' => $message );
        return parent::Call( 'photos.editComment', $Fields );
    }

    /**
     * Удаляет комментарий к фотографии.
     * @param mixed $pid Идентификатор фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь). Если передано отрицательное значение, будет удален комментарий к фотографии группы с идентификатором
    -owner_id.
     * @param mixed $cid Идентификатор комментария.
     * @return object Result
     */
    Public Static Function deleteComment($pid = null, $owner_id = null, $cid = null){
        $Fields = array( 'pid' => $pid, 'owner_id' => $owner_id, 'cid' => $cid );
        return parent::Call( 'photos.deleteComment', $Fields );
    }

    /**
     * Восстанавливает комментарий к фотографии.
     * @param mixed $pid Идентификатор фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь).
     * @param mixed $cid Идентификатор комментария.
     * @return object Result
     */
    Public Static Function restoreComment($pid = null, $owner_id = null, $cid = null){
        $Fields = array( 'pid' => $pid, 'owner_id' => $owner_id, 'cid' => $cid );
        return parent::Call( 'photos.restoreComment', $Fields );
    }

    /**
     * Возвращает список фотографий, на которых отмечен пользователь.
     * @param mixed $uid Идентификатор пользователя (по умолчанию - текущий пользователь).
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества фотографий.
     * @param mixed $count Количество фотографий, которое необходимо получить (но не более 100).
     * @param mixed $sort Сортировка результатов (0 - по дате добавления отметки в порядке убывания, 1 - по дате добавления отметки в порядке возрастания).
     * @param mixed $extended1 - будет возвращено дополнительное поле likes. По умолчанию поле likes не возвращается.
     * @return object Result
     */
    Public Static Function getUserPhotos($uid = null, $offset = null, $count = null, $sort = null, $extended1 = null){
        $Fields = array( 'uid' => $uid, 'offset' => $offset, 'count' => $count, 'sort' => $sort, 'extended1' => $extended1 );
        return parent::Call( 'photos.getUserPhotos', $Fields );
    }

    /**
     * Возвращает список отметок на фотографии.
     * @param mixed $owner_id Идентификатор пользователя (по умолчанию - текущий пользователь).
     * @param mixed $pid Идентификатор фотографии.
     * @return object Result
     */
    Public Static Function getTags($owner_id = null, $pid = null){
        $Fields = array( 'owner_id' => $owner_id, 'pid' => $pid );
        return parent::Call( 'photos.getTags', $Fields );
    }

    /**
     * Добавляет отметку на фотографию.
     * @param mixed $pid Фотографии.
     * @param mixed $uid Пользователя, которого нужно отметить на фотографии.
     * @param mixed $x Верхнего-левого угла отметки в % от ширины фотографии.
     * @param mixed $y Верхнего-левого угла отметки в % от высоты фотографии.
     * @param mixed $x2 Правого-нижнего угла отметки в % от ширины фотографии.
     * @param mixed $y2 Правого-нижнего угла отметки  в % от высоты фотографии.
     * @return object Result
     */
    Public Static Function putTag($pid = null, $uid = null, $x = null, $y = null, $x2 = null, $y2 = null){
        $Fields = array( 'pid' => $pid, 'uid' => $uid, 'x' => $x, 'y' => $y, 'x2' => $x2, 'y2' => $y2 );
        return parent::Call( 'photos.putTag', $Fields );
    }

    /**
     * Удаляет отметку с фотографии.
     * @param mixed $pid Фотографии.
     * @param mixed $tag_id Отметки, которую нужно удалить.
     * @return object Result
     */
    Public Static Function removeTag($pid = null, $tag_id = null){
        $Fields = array( 'pid' => $pid, 'tag_id' => $tag_id );
        return parent::Call( 'photos.removeTag', $Fields );
    }

    /**
     * Удаляет фотоальбом пользователя.
     * @param mixed $aid Удаляемого альбома.
     * @return object Result
     */
    Public Static Function deleteAlbum($aid = null){
        $Fields = array( 'aid' => $aid );
        return parent::Call( 'photos.deleteAlbum', $Fields );
    }

    /**
     * Возвращает адрес сервера для загрузки фотографии в качестве прикрепления к личному сообщению.
     * @return object Result
     */
    Public Static Function getMessagesUploadServer(){
        $Fields = array();
        return parent::Call( 'photos.getMessagesUploadServer', $Fields );
    }

    /**
     * Сохраняет фотографию после загрузки.
     * @param mixed $server Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $photo Возвращаемый в результате загрузки фотографий на сервер.
     * @param mixed $hash Возвращаемый в результате загрузки фотографий на сервер.
     * @return object Result
     */
    Public Static Function saveMessagesPhoto($server = null, $photo = null, $hash = null){
        $Fields = array( 'server' => $server, 'photo' => $photo, 'hash' => $hash );
        return parent::Call( 'photos.saveMessagesPhoto', $Fields );
    }

    /**
     * Удаляет фотографию.
     * @param mixed $oid Пользователя, которому принадлежит фотография. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя. Если передано отрицательное значение, будет удалена фотография группы с идентификатором
    -owner_id.
     * @param mixed $pid Фотографии, которую необходимо удалить.
     * @return object Result
     */
    Public Static Function delete($oid = null, $pid = null){
        $Fields = array( 'oid' => $oid, 'pid' => $pid );
        return parent::Call( 'photos.delete', $Fields );
    }

}

Class VK4DS_newsfeedEx extends VK4DS_Factory {
    /**
     * Возвращает список скрытых пользователей и групп в новостях.
     * @param mixed $extended Если этот параметр равен 1, возвращается дополнительная информация о пользователях и группах 
     * @param mixed $fields  поля профилей, которые необходимо вернуть. См. Описание полей параметра fields
     * @return object Result
     */
    Public Static Function getBanned($extended = null, $fields = null){
        $Fields = array( 'extended' => $extended, 'fields' => $fields );
        return parent::Call( 'newsfeed.getBanned', $Fields );
    }

    /**
     * Запрещает показывать новости от заданных пользователей и групп.
     * @return object Result
     */
    Public Static Function addBan(){
        $Fields = array();
        return parent::Call( 'newsfeed.addBan', $Fields );
    }

    /**
     * Разрешает показывать новости от заданных пользователей и групп.
     * @return object Result
     */
    Public Static Function deleteBan(){
        $Fields = array();
        return parent::Call( 'newsfeed.deleteBan', $Fields );
    }

    /**
     * Возвращает данные, необходимые для показа раздела комментариев в новостях пользователя.
     * @param mixed $filters Перечисленные через запятую типы объектов, изменения комментариев к которым нужно вернуть. В данный момент поддерживаются следующие списки новостей:post - новые комментарии к записям со стен
    photo - новые комментарии к фотографиям
    video - новые комментарии к видеозаписям
    topic - новые сообщения в обсуждениях
    note - новые комментарии к заметкамЕсли параметр не задан, то будут получены все возможные списки новостей.
     * @param mixed $start_time Время, в формате unixtime, начиная с которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным значению времени, которое было сутки назад.
     * @param mixed $end_time Время, в формате unixtime, до которого следует получить новости для текущего пользователя. Если параметр не задан, то он считается равным текущему времени.
     * @param mixed $count Указывает, какое максимальное число новостей следует возвращать, но не более 100. По умолчанию 30.
     * @param mixed $last_comments 1 - возвращать последние комментарии к записям. 0 - не возвращать последние комментарии.
     * @param mixed $reposts Идентификатор объекта, комментарии к репостам которого необходимо вернуть, например wall1_45486. Если указан данный параметр, параметр filters указывать не обзательно.
     * @return object Result
     */
    Public Static Function getComments($filters = null, $start_time = null, $end_time = null, $count = null, $last_comments = null, $reposts = null){
        $Fields = array( 'filters' => $filters, 'start_time' => $start_time, 'end_time' => $end_time, 'count' => $count, 'last_comments' => $last_comments, 'reposts' => $reposts );
        return parent::Call( 'newsfeed.getComments', $Fields );
    }

}

Class VK4DS_likesEx extends VK4DS_Factory {
    /**
     * Добавляет объект в список «Мне нравится» текущего пользователя.
     * @param mixed $owner_id Идентификатор владельца Like-объекта. Если параметр не задан, то считается, что он равен идентифкатору текущего пользователя.
    В случае записей и комментариев на стене owner_id равен идентификатору страницы со стеной, а не автору записи.
     * @param mixed $type Идентификатор типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице Список типов Like-объектов.
     * @param mixed $item_id Идентификатор Like-объекта.
     * @return object Result
     */
    Public Static Function add($owner_id = null, $type = null, $item_id = null){
        $Fields = array( 'owner_id' => $owner_id, 'type' => $type, 'item_id' => $item_id );
        return parent::Call( 'likes.add', $Fields );
    }

    /**
     * Удаляет объект из списка «Мне нравится» текущего пользователя.
     * @param mixed $type Типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице Список типов Like-объектов.
     * @param mixed $item_id Like-объекта.
     * @return object Result
     */
    Public Static Function delete($type = null, $item_id = null){
        $Fields = array( 'type' => $type, 'item_id' => $item_id );
        return parent::Call( 'likes.delete', $Fields );
    }

    /**
     * Возвращает список пользователей, которые добавили объект в список «Мне нравится».
     * @param mixed $type Like-объекта. Подробнее о типах объектов можно узнать на странице Список типов Like-объектов.
     * @param mixed $page_url Страницы, на которой установлен виджет «Мне нравится». Используется вместо параметра item_id.
     * @return object Result
     */
    Public Static Function getList($type = null, $page_url = null){
        $Fields = array( 'type' => $type, 'page_url' => $page_url );
        return parent::Call( 'likes.getList', $Fields );
    }

    /**
     * Проверяет, находится ли объект в списке «Мне нравится».
     * @param mixed $type Типа Like-объекта. Подробнее об идентификаторах объектов можно узнать на странице Список типов Like-объектов.
     * @param mixed $item_id Like-объекта.
     * @return object Result
     */
    Public Static Function isLiked($type = null, $item_id = null){
        $Fields = array( 'type' => $type, 'item_id' => $item_id );
        return parent::Call( 'likes.isLiked', $Fields );
    }

}

Class VK4DS_status extends VK4DS_Factory {
    /**
     * Получает статус пользователя.
     * @param mixed $uid Идентификатор пользователя, статус которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
     * @return object Result
     */
    Public Static Function get($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'status.get', $Fields );
    }

    /**
     * Устанавливает статус текущего пользователя.
     * @return object Result
     */
    Public Static Function set(){
        $Fields = array();
        return parent::Call( 'status.set', $Fields );
    }

}

Class VK4DS_friendsEx extends VK4DS_Factory {
    /**
     * Возвращает информацию о списках друзей.
     * @return object Result
     */
    Public Static Function getLists(){
        $Fields = array();
        return parent::Call( 'friends.getLists', $Fields );
    }

    /**
     * Создаёт новый список друзей.
     * @param mixed $name Создаваемого списка друзей.
     * @return object Result
     */
    Public Static Function addList($name = null){
        $Fields = array( 'name' => $name );
        return parent::Call( 'friends.addList', $Fields );
    }

    /**
     * Редактирует существующий список друзей.
     * @param mixed $lid Существующего списка друзей.
     * @param mixed $name Списка друзей.
     * @return object Result
     */
    Public Static Function editList($lid = null, $name = null){
        $Fields = array( 'lid' => $lid, 'name' => $name );
        return parent::Call( 'friends.editList', $Fields );
    }

    /**
     * Добавляет пользователя в друзья или одобряет заявку на добавление.
     * @param mixed $uid Пользователя которому необходимо отправить заявку, либо заявку от которого необходимо одобрить.
     * @return object Result
     */
    Public Static Function add($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'friends.add', $Fields );
    }

    /**
     * Удаляет пользователя из друзей или отклоняет заявку на добавление.
     * @param mixed $uid Пользователя, которого необходимо удалить из списка друзей, либо заявку от которого необходимо отклонить.
     * @return object Result
     */
    Public Static Function delete($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'friends.delete', $Fields );
    }

    /**
     * Возвращает список заявок в друзья у текущего пользователя.
     * @param mixed $offset Смещение, необходимое для выборки определенного подмножества заявок на добавление в друзья.
     * @param mixed $count Максимальное количество заявок на добавление в друзья, которые необходимо получить (не более 1000). Если параметр не задан, то считается, что он равен 100.
     * @param mixed $need_messages Определяет требуется ли возвращать в ответе сообщения от пользователей, подавших заявку на добавление в друзья.
     * @param mixed $need_mutual Определяет требуется ли возвращать в ответе список общих друзей, если они есть. Обратите внимание, что при использовании need_mutual будет возвращено не более 20 заявок.
     * @param mixed $out 0 - возвращать полученные заявки в друзья (по умолчанию), 1 - возвращать отправленные пользователем заявки.
     * @param mixed $sort 0 - сортировать по дате добавления, 1 - сортировать по количеству общих друзей. (Если out = 1 – данный параметр работать не будет.)
     * @return object Result
     */
    Public Static Function getRequests($offset = null, $count = null, $need_messages = null, $need_mutual = null, $out = null, $sort = null){
        $Fields = array( 'offset' => $offset, 'count' => $count, 'need_messages' => $need_messages, 'need_mutual' => $need_mutual, 'out' => $out, 'sort' => $sort );
        return parent::Call( 'friends.getRequests', $Fields );
    }

    /**
     * Отклоняет все заявки на добавление в друзья.
     * @return object Result
     */
    Public Static Function deleteAllRequests(){
        $Fields = array();
        return parent::Call( 'friends.deleteAllRequests', $Fields );
    }

    /**
     * Возвращает список профилей пользователей, которые могут быть друзьями текущего пользователя.
     * @param mixed $filter Типы предрагаемых друзей которые нужно вернуть, перечисленные через запятую.
    Параметр может принимать следующие значения:
    mutual - пользователи, с которыми много общих друзей,
    contacts - пользователи найденные благодаря методу account.importContacts.
    mutual_contacts - пользователи, которые импортировали те же контакты что и текущий пользователь, используя метод account.importContacts.
    По умолчанию будут возвращены все возможные друзья.
     * @param mixed $offset Cмещение необходимое для выбора определённого подмножества списка.
     * @param mixed $count Количество рекомендаций, которое необходимо вернуть.
     * @return object Result
     */
    Public Static Function getSuggestions($filter = null, $offset = null, $count = null){
        $Fields = array( 'filter' => $filter, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'friends.getSuggestions', $Fields );
    }

}

Class VK4DS_polls extends VK4DS_Factory {
    /**
     * Возвращает детальную информацию об опросе.
     * @param mixed $owner_id Идентификатор владельца опроса, информацию о котором необходимо получить. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
     * @param mixed $poll_id Идентификатор опроса, информацию о котором необходимо получить.
     * @return object Result
     */
    Public Static Function getById($owner_id = null, $poll_id = null){
        $Fields = array( 'owner_id' => $owner_id, 'poll_id' => $poll_id );
        return parent::Call( 'polls.getById', $Fields );
    }

    /**
     * Добавляет голос текущего пользователя к выбранному варианту ответа.
     * @param mixed $owner_id Идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
     * @param mixed $poll_id Идентификатор опроса, в котором необходимо проголосовать.
     * @param mixed $answer_id Идентификатор варианта ответа, за который необходимо проголосовать.
     * @return object Result
     */
    Public Static Function addVote($owner_id = null, $poll_id = null, $answer_id = null){
        $Fields = array( 'owner_id' => $owner_id, 'poll_id' => $poll_id, 'answer_id' => $answer_id );
        return parent::Call( 'polls.addVote', $Fields );
    }

    /**
     * Снимает голос текущего пользователя с выбранного варианта ответа.
     * @param mixed $owner_id Идентификатор владельца опроса. Если параметр не указан, то он считается равным идентификатору текущего пользователя.
     * @param mixed $poll_id Идентификатор опроса, в котором необходимо снять голос.
     * @param mixed $answer_id Идентификатор варианта ответа, с которого необходимо снять голос.
     * @return object Result
     */
    Public Static Function deleteVote($owner_id = null, $poll_id = null, $answer_id = null){
        $Fields = array( 'owner_id' => $owner_id, 'poll_id' => $poll_id, 'answer_id' => $answer_id );
        return parent::Call( 'polls.deleteVote', $Fields );
    }

}

Class VK4DS_subscriptionsEx extends VK4DS_Factory {
    /**
     * Возвращает список подписок пользователя.
     * @param mixed $uid Идентификатор пользователя, список которого необходимо получить. Если параметр не задан, то считается, что он равен идентификатору текущего пользователя.
     * @param mixed $offset Смещение относительно начала списка, для выборки определенного подмножества. Если параметр не задан, то считается, что он равен 0.
     * @param mixed $count Количество возвращаемых идентификаторов пользователей. Если параметр не задан, то считается, что он равен 100. Максимальное значение параметра – 1000.
     * @return object Result
     */
    Public Static Function get($uid = null, $offset = null, $count = null){
        $Fields = array( 'uid' => $uid, 'offset' => $offset, 'count' => $count );
        return parent::Call( 'subscriptions.get', $Fields );
    }

    /**
     * Возвращает список подписчиков пользователя.
     * @return object Result
     */
    Public Static Function getFollowers(){
        $Fields = array();
        return parent::Call( 'subscriptions.getFollowers', $Fields );
    }

    /**
     * Добавляет указанного пользователя в список подписок текущего пользователя.
     * @param mixed $uid Идентификатор пользователя, которого необходимо добавить в список подписок.
     * @return object Result
     */
    Public Static Function follow($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'subscriptions.follow', $Fields );
    }

    /**
     * Удаляет указанного пользователя из списка подписок текущего пользователя.
     * @param mixed $uid Идентификатор пользователя, которого необходимо удалить из списка подписок.
     * @return object Result
     */
    Public Static Function unfollow($uid = null){
        $Fields = array( 'uid' => $uid );
        return parent::Call( 'subscriptions.unfollow', $Fields );
    }

}


VK4DS::Initialize();