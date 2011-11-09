<?php 

/**
 * Description of Tab
 *
 * @version		1.0
 * @license		Simplified BSD License
 * @author      Tom Densham <tom.densham at studiobonito.co.uk>
 * @copyright   Studio Bonito Ltd.
 */

class PageTabsWidget extends Widget {
	
	public static $db = array(
		'WidgetTitle' => 'Varchar',
		'PageTabSetID' => 'Int'
	);
	
	public static $defaults = array(
		'WidgetTitle' => 'Page Tabs'
	);
	
	public static $title = 'Page Tabs';
	public static $cmsTitle = 'Page Tabs Widget';
	public static $description = '';
	
	protected $PageID = 0;
	
	public function set_title($title) {
		$this->WidgetTitle = $title;
	}
	
	public function set_page_id($id) {
		$this->PageID = $id;
	}
	
	public function set_pagetabset_id($id) {
		$this->PageTabSetID = $id;
	}
	
	public function Title() {
		return $this->WidgetTitle ?: self::$title;
	}
	
	public function PageTabSet() {
		$pageTabSet = DataObject::get_by_id('PageTabSet', $this->PageTabSetID);
		$pageTabSet->set_filter_tabitems('PageID = '.$this->PageID);
		return $pageTabSet;
	}
	
	public function getCMSFields() {
		return new FieldSet(
			new TextField('WidgetTitle', 'Widget Title')
		);
	}
}