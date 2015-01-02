<?php
/**
 * @link http://buildwithcraft.com/
 * @copyright Copyright (c) 2013 Pixel & Tonic, Inc.
 * @license http://buildwithcraft.com/license
 */

namespace craft\app\migrations;

use craft\app\db\BaseMigration;

/**
 * The class name is the UTC timestamp in the format of mYYMMDD_HHMMSS_migrationName
 */
class m140829_000001_single_title_formats extends BaseMigration
{
	/**
	 * Any migration code in here is wrapped inside of a transaction.
	 *
	 * @return bool
	 */
	public function safeUp()
	{
		// Get the single section IDs
		$singleIds = craft()->db->createCommand()
			->select('id')
			->from('sections')
			->where('type = "single"')
			->queryColumn();

		if ($singleIds)
		{
			$this->update(
				'entrytypes',
				array(
					'hasTitleField' => 0,
					'titleLabel'    => null,
					'titleFormat'   => '{section.name|raw}'
				),
				array('in', 'sectionId', $singleIds)
			);
		}

		return true;
	}
}
