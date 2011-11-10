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
		'WidgetTitle' => 'Varchar'
	);
	
	public static $has_one = array(
		'PageTabSet' => 'PageTabSet'
	);
	
	public static $defaults = array(
		'WidgetTitle' => 'Page Tabs'
	);
	
	public static $title = 'Page Tabs';
	public static $cmsTitle = 'Page Tabs Widget';
	public static $description = '';
	
	public function set_title($title) {
		$this->WidgetTitle = $title;
	}
	
	public function set_pagetabset($pageTabSet) {
		$this->PageTabSet = $pageTabSet;
	}
	
	public function Title() {
		return $this->WidgetTitle ?: self::$title;
	}
	
	public function PageTabSet() {
		return $this->PageTabSet;
	}
	
	public function getCMSFields() {
		return new FieldSet(
			new TextField('WidgetTitle', 'Widget Title')
		);
	}
}