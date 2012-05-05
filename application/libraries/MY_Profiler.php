<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Profiler Class
 *
 * This class enables you to display benchmark, query, and other data
 * in order to help with debugging and optimization.
 *
 * Note: At some point it would be good to move all the HTML in this class
 * into a set of template files in order to allow customization.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/profiling.html
 */
class MY_Profiler extends CI_Profiler {

	 function MY_Profiler() {
	 	parent::CI_Profiler();
		$this->CI->load->library('firephp');
	}	
 	
 	
	// --------------------------------------------------------------------

	/**
	 * Auto Profiler
	 *
	 * This function cycles through the entire array of mark points and
	 * matches any two points that are named identically (ending in "_start"
	 * and "_end" respectively).  It then compiles the execution times for
	 * all points and returns it as an array
	 *
	 * @access	private
	 * @return	array
	 */
 	function _compile_benchmarks()
 	{
  		$profile = array();
 		foreach ($this->CI->benchmark->marker as $key => $val)
 		{
 			// We match the "end" marker so that the list ends
 			// up in the order that it was defined
 			if (preg_match("/(.+?)_end/i", $key, $match))
 			{ 			
 				if (isset($this->CI->benchmark->marker[$match[1].'_end']) AND isset($this->CI->benchmark->marker[$match[1].'_start']))
 				{
 					$profile[$match[1]] = $this->CI->benchmark->elapsed_time($match[1].'_start', $key);
 				}
 			}
 		}

		// Build a table containing the profile data.
		// Note: At some point we should turn this into a template that can
		// be modified.  We also might want to make this data available to be logged
	
	
		$output[] = array('Benchmark', 'Time');
		
		
		foreach ($profile as $key => $val)
		{
			$key = ucwords(str_replace(array('_', '-'), ' ', $key));
			$output[] = array($key, $val);
		}
		
		$output = array($this->CI->lang->line('profiler_benchmarks'), $output);
 		
 		$this->CI->firephp->fb($output, FirePHP::TABLE);
 	}
 	
	// --------------------------------------------------------------------

	/**
	 * Compile Queries
	 *
	 * @access	private
	 * @return	string
	 */	
	function _compile_queries()
	{
		
		
		if ( ! class_exists('CI_DB_driver'))
		{
			$this->CI->firephp->fb($this->CI->lang->line('profiler_queries').': '.$this->CI->lang->line('profiler_no_db'), FirePHP::INFO);
			return;
		}
		else
		{
			
			if (count($this->CI->db->queries) == 0)
			{
				$this->CI->firephp->fb($this->CI->lang->line('profiler_queries').': '.$this->CI->lang->line('profiler_no_queries'), FirePHP::INFO);
			}
			else
			{
				$output[] = array('Time','Query');
				
				foreach ($this->CI->db->queries as $key => $val)
				{
					//$val = htmlspecialchars($val, ENT_QUOTES);
					$time = number_format($this->CI->db->query_times[$key], 4);
					
					
					$output[]= array($time, $val);
				}
			}
		}
		
		$this->firephp->fb(array($this->CI->lang->line('profiler_queries').' ('.count($this->CI->db->queries).')', $output), FirePHP::TABLE);
		
		
		return $output;
	}

	
	// --------------------------------------------------------------------

	/**
	 * Compile $_GET Data
	 *
	 * @access	private
	 * @return	string
	 */	
	function _compile_get()
	{	
		
				
		if (count($_GET) == 0)
		{
			$this->CI->firephp->fb($this->CI->lang->line('profiler_get_data').': '.$this->CI->lang->line('profiler_no_get'), FirePHP::INFO);
			return;
		}
		else
		{
			
		
			foreach ($_GET as $key => $val)
			{
				if ( ! is_numeric($key))
				{
					$key = "'".$key."'";
				}
			
					$output['$_GET['.$key.']'] = $val;
			
			}
			
			
		}
		$this->CI->firephp->fb($output, $this->CI->lang->line('profiler_get_data'), FirePHP::LOG);

		return $output;	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Compile $_POST Data
	 *
	 * @access	private
	 * @return	string
	 */	
	function _compile_post()
	{	
		if (count($_POST) == 0)
		{
			$this->CI->firephp->fb($this->CI->lang->line('profiler_post_data').': '.$this->CI->lang->line('profiler_no_post'), FirePHP::INFO);
			return;
		}
		else
		{
			
		
			
			$this->CI->firephp->fb($_POST, $this->CI->lang->line('profiler_post_data'), FirePHP::INFO);
		}
		

		return $output;	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Show query string
	 *
	 * @access	private
	 * @return	string
	 */	
	function _compile_uri_string()
	{	
		$this->CI->firephp->fb($this->CI->lang->line('profiler_uri_string').': '.
		($this->CI->uri->uri_string == '' ? $this->CI->lang->line('profiler_no_uri') : $this->CI->uri->uri_string)
		, FirePHP::INFO);
		
	}

	// --------------------------------------------------------------------
	
	/**
	 * Compile memory usage
	 *
	 * Display total used memory
	 *
	 * @access	public
	 * @return	string
	 */
	function _compile_memory_usage()
	{
		$output = $this->CI->lang->line('profiler_memory_usage').': ';
		
		
		if (function_exists('memory_get_usage') && ($usage = memory_get_usage()) != '')
		{
			$output .= number_format($usage).' bytes';
		}
		else
		{
			$output .= $this->CI->lang->line('profiler_no_memory_usage');				
		}
		
		$this->CI->firephp->fb($output, FirePHP::INFO);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Run the Profiler
	 *
	 * @access	private
	 * @return	string
	 */	
	function run()
	{		
		
		$this->CI->firephp->fb('------ Profiler -------');
		
		$this->_compile_memory_usage();
		$this->_compile_benchmarks();	
		$this->_compile_uri_string();
		$this->_compile_get();
		$this->_compile_post();
		$this->_compile_queries();
		
		
	}

}

// END CI_Profiler class

/* End of file Profiler.php */
/* Location: ./system/libraries/Profiler.php */