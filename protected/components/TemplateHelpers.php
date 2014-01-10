<?php
/**
 * Contenitore per alcuni helpers utili alle view
 *
 * @author Alessandro Pagnin
 */
class TemplateHelpers {
	static function get_side_align($index) {
		$align = "right";
		if (($index + 1) % 3 == 1) {
			$align = "left";
		} else if (($index + 1) % 3 == 2) {
			$align = "center";
		}
		return $align;
	}
}