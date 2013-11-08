<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class BaseAdminController extends BaseController
{
	public $layout = '//layouts/admin';
	public $items_per_page = 30;

	public function accessRules()
	{
		return array(array('allow', 'roles' => array('admin')));
	}

	protected function beforeAction($action)
	{
		$this->registerCssFile('admin.css', Yii::app()->createUrl("css/admin.css"));
		Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl("js/admin.js"));
		return parent::beforeAction($action);
	}

	/**
	 *	@description Initialise and handle admin pagination
	 *  @author bizmate
	 * 	@param class $model
	 * 	@param string $criteria
	 * 	@return CPagination
	 */
	protected function initPagination($model, $criteria = null)
	{
		$criteria = is_null($criteria) ? new CDbCriteria() : $criteria;
		$itemsCount = $model->count($criteria);
		$pagination = new CPagination($itemsCount);
		$pagination->pageSize = $this->items_per_page;
		// not needed as $_GET['page'] is used by default
		//if(isset($_GET['page']) && is_int($_GET['page']) )
		//{
		//	$pagination->currentPage = $_GET['page'];
		//}
		$pagination->applyLimit($criteria);
		return $pagination;
	}
}
