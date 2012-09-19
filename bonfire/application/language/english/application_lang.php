<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

//--------------------------------------------------------------------
// !SETTINGS
//--------------------------------------------------------------------

$lang['bf_site_name']			= 'Название';
$lang['bf_site_email']			= 'Email';
$lang['bf_site_email_help']		= 'Дефолтный Email с которого отправляются сгенерированные системой сообщения.';
$lang['bf_site_status']			= 'Статус';
$lang['bf_online']				= 'Online';
$lang['bf_offline']				= 'Offline';
$lang['bf_top_number']			= 'Елементов <em>на</em> странице:';
$lang['bf_top_number_help']		= 'Какое количество елементов должно отображаться одновременно при просмотре отчетов?';

$lang['bf_security']			= 'Безопасность';
$lang['bf_login_type']			= 'Тип Авторизации';
$lang['bf_login_type_email']	= 'Только Email';
$lang['bf_login_type_username']	= 'Только Никнейм';
$lang['bf_allow_register']		= 'Позволить пользовательскую регистрацию?';
$lang['bf_login_type_both']		= 'Email или Никнейм';
$lang['bf_use_usernames']		= 'Способ отображения пользователя в системе:';
$lang['bf_use_own_name']		= 'Испольовать Собственное Имя';
$lang['bf_allow_remember']		= 'Разрешить \'Запомнить Меня\'?';
$lang['bf_remember_time']		= 'Запомнить На';
$lang['bf_week']				= 'Неделю';
$lang['bf_weeks']				= 'Недели';
$lang['bf_days']				= 'Дней';
$lang['bf_username']			= 'Никнейм';
$lang['bf_password']			= 'Пароль';
$lang['bf_password_confirm']	= 'Пароль (повторно)';

$lang['bf_home_page']			= 'Домашняя Страница';
$lang['bf_pages']				= 'Страницы';
$lang['bf_enable_rte']			= 'Разрешить RTE для страниц?';
$lang['bf_rte_type']			= 'Тип RTE';
$lang['bf_searchable_default']	= 'Searchable by default?';
$lang['bf_cacheable_default']	= 'Cacheable by default?';
$lang['bf_track_hits']			= 'Track Page Hits?';

$lang['bf_action_save']			= 'Сохранить';
$lang['bf_action_delete']		= 'Удалить';
$lang['bf_action_cancel']		= 'Отмена';
$lang['bf_action_download']		= 'Загрузить';
$lang['bf_action_preview']		= 'Предварительный просмотр';
$lang['bf_action_search']		= 'Поиск';
$lang['bf_action_purge']		= 'Purge';
$lang['bf_action_restore']		= 'Восстановить';
$lang['bf_action_show']			= 'Показать';
$lang['bf_action_login']		= 'Авторизироваться';
$lang['bf_actions']				= 'Действия';

$lang['bf_do_check']			= 'Проверить обновления?';
$lang['bf_do_check_edge']		= 'Must be enabled to see bleeding edge updates as well.';

$lang['bf_update_show_edge']	= 'Показать критические обновления?';
$lang['bf_update_info_edge']	= 'Leave unchecked to only check for new tagged updates. Check to see any new commits to the official repository.';

$lang['bf_ext_profile_show']	= 'Does User accounts have extended profile?';
$lang['bf_ext_profile_info']	= 'Check "Extended Profiles" to have extra profile meta-data available option(wip), omiting some default bonfire fields (eg: address).';

$lang['bf_yes']					= 'Да';
$lang['bf_no']					= 'Нет';
$lang['bf_none']				= 'None';

$lang['bf_or']					= 'или';
$lang['bf_size']				= 'Размер';
$lang['bf_files']				= 'Файлы';
$lang['bf_file']				= 'Файл';

$lang['bf_with_selected']		= 'С выбранными';

$lang['bf_env_dev']				= 'Development';
$lang['bf_env_test']			= 'Testing';
$lang['bf_env_prod']			= 'Production';

$lang['bf_user']				= 'Пользователь';
$lang['bf_users']				= 'Пользователи';
$lang['bf_username']			= 'Никнейм';
$lang['bf_description']			= 'Описание';
$lang['bf_email']				= 'Email';
$lang['bf_user_settings']		= 'Мой Профиль';

$lang['bf_both']				= 'оба';
$lang['bf_go_back']				= 'Назад';
$lang['bf_new']					= 'Новый';
$lang['bf_required_note']		= 'Обязательные поля выделены <b>жирным</b>.';

$lang['bf_show_profiler']		= 'Показать Admin Profiler?';
$lang['bf_show_front_profiler']	= 'Показать Front End Profiler?';

//--------------------------------------------------------------------
// MY_Model
//--------------------------------------------------------------------
$lang['bf_model_no_data']		= 'No data available.';
$lang['bf_model_invalid_id']	= 'Invalid ID passed to model.';
$lang['bf_model_no_table']		= 'Model has unspecified database table.';
$lang['bf_model_fetch_error']	= 'Not enough information to fetch field.';
$lang['bf_model_count_error']	= 'Not enough information to count results.';
$lang['bf_model_unique_error']	= 'Not enough information to check uniqueness.';
$lang['bf_model_find_error']	= 'Not enough information to find by.';
$lang['bf_model_bad_select']	= 'Invalid selection.';

//--------------------------------------------------------------------
// Contexts
//--------------------------------------------------------------------
$lang['bf_no_contexts']			= 'Массив контекстов не верно настроен. Проверьте ваш конфигурационный файл';
$lang['bf_context_content']		= 'Контент';
$lang['bf_context_reports']		= 'Отчеты';
$lang['bf_context_settings']	= 'Настройки';
$lang['bf_context_developer']	= 'Разработка';

//--------------------------------------------------------------------
// Activities
//--------------------------------------------------------------------
$lang['bf_act_settings_saved']	= 'App settings saved from';