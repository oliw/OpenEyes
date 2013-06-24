<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "contact_label".
 *
 * The followings are the available columns in table 'contact_label':
 * @property string $id
 * @property string $name
 * @property integer $letter_template_only
 */
class ContactLabel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactLabel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_label';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'letter_template_only' => 'Letter Template Only',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('letter_template_only', 0);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	static public function staffType() {
		if ($site = Site::model()->findByPk(Yii::app()->session['selected_site_id'])) {
			return ($site->institution->short_name ? $site->institution->short_name : $site->institution->name) . ' staff';
		}
		return 'Staff';
	}

	static public function getList() {
		$list = array();

		if (!empty(Yii::app()->params['contact_labels'])) {
			foreach (Yii::app()->params['contact_labels'] as $label) {
				if ($label == 'Staff') {
					$list['staff'] = 'Staff';
				} else if (preg_match('/{SPECIALTY}/',$label)) {
					if (!$specialty = Specialty::model()->find('code=?',array(Yii::app()->params['institution_specialty']))) {
						throw new Exception("Institution specialty not configured");
					}
					$list['nonspecialty'] = preg_replace('/{SPECIALTY}/',$specialty->adjective,$label);
				} else {
					$list[$label] = $label;
				}
			}
		}

		return $list;
	}
}