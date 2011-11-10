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
		return $this->Tabs();
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
		return $this->TabItems();
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
	
	public function onBeforeWrite()
	{
		parent::onBeforeWrite();
		$this->CSSClass = $this->CSSClass ?: SiteTree::generateURLSegment($this->Title);
	}
	
	public function CSSClass() {
		return $this->CSSClass;
	}

}
