<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// HorizontalBarGraph
require_once 'SVGGraph/autoloader.php';

class Graph
{
	function createChart( $values,$type = 'HorizontalBarGraph',$max = 100){
		 $settings = array(
		  'auto_fit' => false,
		  'back_colour' => '#fff',
		  'back_stroke_width' => 0,
		  'back_stroke_colour' => '#eee',
		  'stroke_colour' => '#000',
		  'axis_colour' => '#333',
		  'axis_overlap' => 2,
		  'grid_colour' => '#666',
		  'label_colour' => '#000',
		  'axis_font' => 'Arial',
		  'axis_font_size' => 10,
		  'pad_right' => 20,
		  'pad_left' => 20,
		  'axis_max_h' => $max,
		  //'link_base' => '/',
		  //'link_target' => '_top',
		  'minimum_grid_spacing' => 20,
		  'show_subdivisions' => false,
		  'show_grid_subdivisions' => false,
		  'grid_subdivision_colour' => '#ccc',
		);
		$width = 600;
		$height = 50*count($values);

		//$type = 'HorizontalBarGraph';
		/*$values = [
		  ['Dough' => 30, 'Ray' => 50, 'Me' => 40, 'So' => 25, 'Far' => 45, 'Lard' => 35],
		];*/

		//$colours = [ ['red', 'yellow'], ['blue', 'white'] ];
		$barColor = array('#99622B','#808017','#499990','#F3813C','#FEE13A','#41B451','#4564D5');
		  
		$graph = new Goat1000\SVGGraph\SVGGraph($width, $height, $settings);
		$graph->colours($barColor);
		$graph->values($values);
		$graph->render($type);
	}
}

