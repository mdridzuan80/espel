<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function appsess()
{
    $CI =& get_instance();
    return $CI->appsess;
}

function auth()
{
    $CI =& get_instance();
    return $CI->appauth;
}

function jabatan()
{
    $CI =& get_instance();
    $CI->load->model('jabatan_model','jabatan');
    return $CI->jabatan;
}

function buildTree(array $elements, $parentId = 6650) {
    $branch = [];

    foreach ($elements as $element) {
        if ($element['parent_buid'] == $parentId) {
            $children = buildTree($elements, $element['buid']);
            $element['id'] = $element['buid'];
            $element["text"] = $element["title"];
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}

function buildTreeParentInc(array $elements, $parentId = 0, $parentIncId = 0) {
    $branch = [];

    if($parentIncId != 0)
    {
        foreach ($elements as $element)
        {
            if ($element['id'] == $parentIncId)
            {
                $children = buildTreeParentInc($elements, $element['id']);
                $element["text"] = $element["nama"];
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    }
    else
    {
        foreach ($elements as $element)
        {
            if ($element['parent_jabatan_id'] == $parentId)
            {
                $children = buildTreeParentInc($elements, $element['id']);
                $element["text"] = $element["nama"];
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    }

    return $branch;
}

function relatedJabatan(array $elements, $parentId = 0) {
    $branch = [];

    foreach ($elements as $element) {
        if ($element['parent_buid'] == $parentId) {
            $branch[] = $element['buid'];
            $c = relatedJabatan($elements, $element['buid']);
            if($c)
            {
                $branch[] = $c;
            }
        }
    }
    return $branch;
}

function flattenArray($a)
{
    $na = array();

	foreach($a as $i)
    {
        if(is_array($i))
        {
            if($na) $na = array_merge($na,flattenarray($i));
            else $na = flattenarray($i);
        }
        else $na[] = $i;
    }
    return $na;
}

function kiraanHari($mula,$tamat)
{
    $hari=0;
    if(strcmp(date("Y-m-d",strtotime($mula)),date("Y-m-d",strtotime($tamat)))==0)
    {
        //formula 6 jam = 1 hari
        $hari = round(datediff("n", $mula, $tamat)/(6*60),2);
    }
    else
    {
        //formula kira hari
        $hari = datediff("y", date("Y-m-d",strtotime($mula)), date("Y-m-d",strtotime($tamat)))+1;
    }
    return abs($hari);
}

#---------------------------------------------------------------------------------------
# FUNCTION: datediff($interval, $datefrom, $dateto, $using_timestamps = false)
# DATE CREATED: Mar 31, 2005
# AUTHOR: I Love Jack Daniels
# PURPOSE: Just like the DateDiff function found in Visual Basic
# $interval can be:
# yyyy - Number of full years
# q - Number of full quarters
# m - Number of full months
# y - Difference between day numbers (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
# d - Number of full days
# w - Number of full weekdays
# ww - Number of full weeks
# h - Number of full hours
# n - Number of full minutes
# s - Number of full seconds (default)
#---------------------------------------------------------------------------------------
function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
  if (!$using_timestamps) {
	$datefrom = strtotime($datefrom, 0);
	$dateto = strtotime($dateto, 0);
  }
  $difference = $dateto - $datefrom; // Difference in seconds
  switch($interval) {
	case 'yyyy': $years_difference = floor($difference / 31536000);
				if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
					$years_difference--;
				}
				if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
					$years_difference++;
				}
				$datediff = $years_difference;
				break;
	case "q": $quarters_difference = floor($difference / 8035200);
				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}
				$quarters_difference--;
				$datediff = $quarters_difference;
				break;
	case "m": $months_difference = floor($difference / 2678400);
				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}
				$months_difference--;
				$datediff = $months_difference;
				break;
	case 'y': $datediff = date("z", $dateto) - date("z", $datefrom); break;
	case "d": $datediff = floor($difference / 86400); break;
	case "w": $days_difference = floor($difference / 86400);
				$weeks_difference = floor($days_difference / 7); // Complete weeks
				$first_day = date("w", $datefrom);
				$days_remainder = floor($days_difference % 7);
				$odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
				if ($odd_days > 7) { $days_remainder--; }
				if ($odd_days > 6) { $days_remainder--; }
				$datediff = ($weeks_difference * 5) + $days_remainder;
				break;
	case "ww": $datediff = floor($difference / 604800); break;
	case "h": $datediff = floor($difference / 3600); break;
	case "n": $datediff = floor($difference / 60); break;
	default: $datediff = $difference; break;
  }
  return $datediff;
}

function flatten_array(array $array)
{
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
}

function get_penyelaras_related_jabatan($username)
{
    $CI =& get_instance();
    $CI->load->model("jabatan_model","jabatan");
    $CI->load->model("kumpulan_profil_model", "kumpulan_profil");
    $jab_id = $CI->kumpulan_profil->get_by([
        "profil_nokp" => $username,
        "kumpulan_id" => 3,
    ])->jabatan_id;
    $flatted = flatten_array(
        relatedJabatan(
            $CI->jabatan->as_array()->get_all(),
            $jab_id
        )
    );
    array_push($flatted,$jab_id);
    return $flatted;
}

function dd($var)
{
    return die(var_dump($var));
}

function initObj(array $property = array())
{
    return (new obj($property));
}

function array_bulan()
{
    return [
        '1' => ['jan'=>'januari'],
        '2' => ['feb'=>'februari'],
        '3' => ['mac'=>'mac'],
        '4' => ['apr'=>'april'],
        '5' => ['mei'=>'mei'],
        '6' => ['jun'=>'jun'],
        '7' => ['jul'=>'julai'],
        '7' => ['ogo'=>'ogos'],
        '9' => ['sep'=>'september'],
        '10' => ['okt'=>'oktober'],
        '11' => ['nov'=>'november'],
        '12' => ['dis'=>'disember'],
    ];
}

/*
* Function hash
* Return string
*/
function pass_encode($password)
{
    return password_hash($password,PASSWORD_BCRYPT);
}

class Obj {
    public function __construct(array $arguments = array()) {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                if(is_numeric($property)):
                    $this->{$argument} = null;
                else:
                    $this->{$property} = $argument;
                endif;
            }
        }
    }

    public function __call($method, $arguments) {
        $arguments = array_merge(array("stdObject" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } else {
            throw new Exception("Fatal error: Call to undefined method stdObject::{$method}()");
        }
    }

    public function __get($name){
        if(property_exists($this, $name)):
            return $this->{$name};
        else:
            return $this->{$name} = null;
        endif;
    }

    public function __set($name, $value) {
        $this->{$name} = $value;
    }
}
