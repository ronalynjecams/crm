<?php
/**
 * Gallery Fixture
 */
class GalleryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'gallery_info_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'file' => array('type' => 'string', 'null' => false, 'default' => 'image_placeholder.jpg', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'comment' => 'Image', 'charset' => 'latin1'),
		'details' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB', 'comment' => 'IN PREPARATION FOR WEBSITE GALLERY')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'quotation_id' => 1,
			'client_id' => 1,
			'gallery_info_id' => 1,
			'file' => 'Lorem ipsum dolor sit amet',
			'details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2018-05-09 11:56:19',
			'modified' => '2018-05-09 11:56:19'
		),
	);

}
