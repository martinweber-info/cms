<?php
/**
 * @link http://buildwithcraft.com/
 * @copyright Copyright (c) 2013 Pixel & Tonic, Inc.
 * @license http://buildwithcraft.com/license
 */

namespace craft\app\records;

/**
 * Class Section record.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class Section extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::getTableName()
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return 'sections';
	}

	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return array(
			'locales'       => array(static::HAS_MANY, 'SectionLocale', 'sectionId'),
			'structure'     => array(static::BELONGS_TO, 'Structure', 'onDelete' => static::SET_NULL),
		);
	}

	/**
	 * @inheritDoc BaseRecord::defineIndexes()
	 *
	 * @return array
	 */
	public function defineIndexes()
	{
		return array(
			array('columns' => array('name'), 'unique' => true),
			array('columns' => array('handle'), 'unique' => true),
		);
	}

	/**
	 * @inheritDoc BaseRecord::scopes()
	 *
	 * @return array
	 */
	public function scopes()
	{
		return array(
			'ordered' => array('order' => 'name'),
		);
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::defineAttributes()
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'name'             => array(AttributeType::Name, 'required' => true),
			'handle'           => array(AttributeType::Handle, 'required' => true),
			'type'             => array(AttributeType::Enum, 'values' => array(SectionType::Single, SectionType::Channel, SectionType::Structure), 'default' => SectionType::Channel, 'required' => true),
			'hasUrls'          => array(AttributeType::Bool, 'default' => true),
			'template'         => AttributeType::Template,
			'enableVersioning' => AttributeType::Bool,
		);
	}
}
