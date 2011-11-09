<?php

/**
 * Description of Tab
 *
 * @version		1.0
 * @license		Simplified BSD License
 * @author      Tom Densham <tom.densham at studiobonito.co.uk>
 * @copyright   Studio Bonito Ltd.
 */

/**
 * TabSet Class
 */
class PageTabSet extends DataObject {

	public static $singular_name = 'Tab Set';
	public static $plural_name = 'Tab Sets';
	public static $db = array(
		'Title' => 'Varchar',
		'CSSClass' => 'Varchar'
	);
	public static $has_many = array(
		'Tabs' => 'PageTab'
	);
	public static $summary_fields = array(
	);
	public static $searchable_fields = array(
	);
	
	protected $filter_tabs = '';
	protected $filter_tabitems = '';
	
	public function set_filter_tabs($filter_tabs) {
		$this->filter_tabs = $filter_tabs;
	}
	
	public function set_filter_tabitems($filter_tabitems) {
		$this->filter_tabitems = $filter_tabitems;
	}
	
	public function get_filter_tabs() {
		return $this->filter_tabs;
	}
	
	public function get_filter_tabitems() {
		return $this->filter_tabitems;
	}

	public function updateCMSFields(FieldSet &$fields)
	{

		return $fields;
	}

	public function getCMSFieldsForPopup()
	{
		$fields = new FieldSet();

		return $fields;
	}
	
	public function onBeforeWrite()
	{
		parent::onBeforeWrite();
		$this->CSSClass = $this->CSSClass ?: SiteTree::generateURLSegment($this->Title);
	}
	
	public function CSSClass() {
		return $this->CSSClass;
	}
	
	public function PageTabs() {
		return $this->Tabs($this->get_filter_tabs());
	}

}

/**
 * Tab Class
 */
class PageTab extends DataObject {

	public static $singular_name = 'Tab';
	public static $plural_name = 'Tabs';
	public static $db = array(
		'Title' => 'Varchar',
		'CSSClass' => 'Varchar'
	);
	public static $has_one = array(
		'TabSet' => 'PageTabSet'
	);
	public static $has_many = array(
		'TabItems' => 'PageTabItem'
	);
	public static $summary_fields = array(
	);
	public static $searchable_fields = array(
	);

	public function updateCMSFields($fields)
	{

		return $fields;
	}

	public function getCMSFieldsForPopup()
	{
		$fields = new FieldSet();

		return $fields;
	}
	
	public function onBeforeWrite()
	{
		parent::onBeforeWrite();
		$this->CSSClass = $this->CSSClass ?: SiteTree::generateURLSegment($this->Title);
	}
	
	public function CSSClass() {
		return $this->CSSClass;
	}
	
	public function PageTabItems() {
		return $this->TabItems($this->TabSet()->get_filter_tabitems());
	}

}

/**
 * TabItem Class
 */
class PageTabItem extends DataObject {

	public static $singular_name = 'Tab Item';
	public static $plural_name = 'Tab Items';
	public static $db = array(
		'Title' => 'Varchar',
		'CSSClass' => 'Varchar',
		'Content' => 'Text'
	);
	public static $has_one = array(
		'Page' => 'Page',
		'Tab' => 'PageTab',
		'Image' => 'Image'
	);
	public static $summary_fields = array(
	);
	public static $searchable_fields = array(
	);

	public function getCMSFieldsForPopup()
	{
		$fields = new FieldSet();
		$fields->push(new TextField('Title'));
		$fields->push(new TextareaField('Content'));
		$fields->push(new ImageField('Image'));
		return $fields;
	}

	public function onAfterWrite()
	{
		parent::onAfterWrite();
		if (isset($_REQUEST['ctf']))
		{
			if (!isset($_REQUEST['ctf']['childID']))
				DB::query('UPDATE `PageTabItem` SET TabID = ' . $_REQUEST['ctf']['sourceID'] . ' WHERE ID = ' . $this->ID);
		}
	}
	
	public function onBeforeWrite()
	{
		parent::onBeforeWrite();
		$this->CSSClass = $this->CSSClass ?: SiteTree::generateURLSegment($this->Title);
	}
	
	public function CSSClass() {
		return $this->CSSClass;
	}

}
