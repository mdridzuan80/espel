<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Hrmisapi\Hrmisapi;

class Apphrmis
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function syncData()
    {
        try{
            $raw = $this->getDataFileByBU();
            $raw = $raw['soap:Envelope']['soap:Body']['GetDataFileByBUResponse']['getFileResponseStreaming'];

            $this->unzip($this->decodeFile($raw));
            return 'Integrasi berjaya';
        }
        catch (Exception $e)
        {
            return $e;
        }
    }

    public function getDataFileByBU()
    {
        $hrmis = new Hrmisapi($this->CI->config->item('espel_hrmis_url'), $this->CI->config->item('espel_hrmis_username'), $this->CI->config->item('espel_hrmis_password'));

        $param['buorgchart'] = '0518';
        $param['bulevel'] = 2;
        $param['datatype'] = 'jknm';

        return $hrmis->GetDataFileByBU($param)->arr();
    }

    public function decodeFile($file_info)
    {
        $contents = $file_info['fileData'];
        $output = $file_info['fileName'];
        $bin = base64_decode($contents);
        file_put_contents($this->CI->config->item('espel_hrmis_temp_folder') . $output, $bin);
        return $output;
    }

    public function unzip($output)
    {
        $zip = new ZipArchive;

        if($zip->open($this->CI->config->item('espel_hrmis_temp_folder') . $output))
        {
            //extract contents to /data/ folder
            $zip->extractTo($this->CI->config->item('espel_hrmis_temp_folder'));
            //close the archive
            $zip->close();

            $zipOpen = zip_open($this->CI->config->item('espel_hrmis_temp_folder') . $output);

            while ($zip_entry = zip_read($zipOpen)) {
                $contents = file_get_contents($this->CI->config->item('espel_hrmis_temp_folder') . zip_entry_name($zip_entry));
                unlink($this->CI->config->item('espel_hrmis_temp_folder') . zip_entry_name($zip_entry));

                $newline = "\n";
                $splitcontents = explode($newline, $contents);
                $counter = 0;
                foreach ($splitcontents as $color) {
                    if ($color) {
                        $content_array[$counter] = array();
                        $delimiter = "\t";
                        $splitcontents1 = explode($delimiter, $color);

                        foreach ($splitcontents1 as $value) {
                            $content_array[$counter][] = $value;
                        }
                        $counter = $counter + 1;
                    }
                }
                return $content_array;
            }
        } else {
           return [];
        }
    }

    public function prosesData($data)
    {
        
    }
}