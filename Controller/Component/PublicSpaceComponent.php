<?php
/**
 * PublicSpace Component
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * PublicSpace Component
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PrivateSpace\Controller\Component
 */
class PublicSpaceComponent extends Component {

/**
 * アクセスチェック
 *
 * @param Controller $controller Controller with components to startup
 * @return bool
 */
	public function accessCheck(Controller $controller) {
		if (! Current::read('User.id')) {
			return true;
		}

		if (! $controller->Session->check('roomAccesse.' . Current::read('Room.id'))) {
			$RolesRoomsUser = ClassRegistry::init('Rooms.RolesRoomsUser');
			$RolesRoomsUser->saveAccessed(Current::read('RolesRoomsUser.id'));
			$controller->Session->write('roomAccesse.' . Current::read('Room.id'), true);
		}

		return true;
	}
}
