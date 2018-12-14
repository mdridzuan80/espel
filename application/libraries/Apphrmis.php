<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Hrmisapi\Hrmisapi;

class Apphrmis
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function syncData()
    {
        try {
            $raw = $this->getDataFileByBU();
            $raw = $raw['soap:Envelope']['soap:Body']['GetDataFileByBUResponse']['getFileResponseStreaming'];

            $hrmis = $this->unzip($this->decodeFile($raw));
            $this->prosesMigration($hrmis);

            return 'Integrasi berjaya';
        } catch (Exception $e) {
            return $e;
        }
    }

    private function prosesMigration($hrmis)
    {
        $this->CI->load->model('hrmis_profil_import_model');
        $this->CI->load->model('profil_model');

        $this->CI->hrmis_profil_import_model->kosongkan();

        foreach ($hrmis as $hrmisRow) {
            $fields = [
                "nama" => addslashes(trim($hrmisRow[0])),
                "nokp" => trim($hrmisRow[1]),
                "email" => trim($hrmisRow[2]),
                "jabatan_id" => trim($hrmisRow[3]),
                "jabatan" => trim($hrmisRow[5]),
                "skim_id" => trim($hrmisRow[6]),
                "gred" => trim($hrmisRow[7]),
                "kelas_id" => trim($hrmisRow[8]),
                "nama_ppp" => trim($hrmisRow[9]),
                "nokp_ppp" => trim($hrmisRow[10]),
                "email_ppp" => trim($hrmisRow[11]),
                "nama_ppk" => trim($hrmisRow[12]),
                "nokp_ppk" => trim($hrmisRow[13]),
                "email_ppk" => trim($hrmisRow[14]),
            ];

            $fields2 = [
                "nama" => addslashes(trim($hrmisRow[0])),
                "nokp" => trim($hrmisRow[1]),
                "email" => trim($hrmisRow[2]),
                "jabatan_id" => (int)trim($hrmisRow[3]),
                "jabatan_desc" => trim($hrmisRow[5]),
                "skim_id" => trim($hrmisRow[6]),
                "gred_id" => trim($hrmisRow[7]),
                "kelas_id" => trim($hrmisRow[8]),
                "nokp_ppp" => trim($hrmisRow[10]),
                "email_ppp" => trim($hrmisRow[11]),
                "nokp_ppk" => trim($hrmisRow[13]),
                "email_ppk" => trim($hrmisRow[14]),
                "status" => "Y",
                "password" => pass_encode(trim($hrmisRow[1])),
                "kelas" => SELF::generateKelas($hrmisRow[7], $hrmisRow[8]),
            ];

            preg_match_all('!\d+!', $fields2['gred_id'], $matches);
            $fields2['gred'] = $matches[0][0];

            $db_debug = $this->CI->db->db_debug; //save setting

            $this->CI->db->db_debug = false; //disable debugging for queries

            $this->CI->hrmis_profil_import_model->insert($fields);

            $err = $this->CI->db->error();

            if ($err["code"] != 0) {
                log_message('info', $err["message"]);
            } else {
                $this->CI->profil_model->hrmisMigrate($fields2);
            }

            $this->CI->db->db_debug = $db_debug; //restore setting
        }

        $this->CI->profil_model->hapusMigrate();
    }

    public function getDataFileByBU()
    {
        $data = '';
        $hrmis = new Hrmisapi($this->CI->config->item('espel_hrmis_url'), $this->CI->config->item('espel_hrmis_username'), $this->CI->config->item('espel_hrmis_password'));

        $param['buorgchart'] = '0518';
        $param['bulevel'] = 2;
        $param['datatype'] = 'jknm';

        echo "getting data from hrmis...\n";
        $data = $hrmis->GetDataFileByBU($param)->arr();
        echo "done getting data from hrmis\n";

        return $data;
    }

    public function decodeFile($file_info)
    {
        echo "decode string to binary..\n";
        $contents = $file_info['fileData'];
        $output = $file_info['fileName'];
        $bin = base64_decode($contents);
        file_put_contents($this->CI->config->item('espel_hrmis_temp_folder') . $output, $bin);
        echo "done decode string to binary\n";
        return $output;
    }

    public function unzip($output)
    {
        $zip = new ZipArchive;

        if ($zip->open($this->CI->config->item('espel_hrmis_temp_folder') . $output)) {
            //extract contents to /data/ folder
            echo "extract data...\n";
            $zip->extractTo($this->CI->config->item('espel_hrmis_temp_folder'));
            $zip->close();
            echo "done extract data\n";

            $zipOpen = zip_open($this->CI->config->item('espel_hrmis_temp_folder') . $output);

            while ($zip_entry = zip_read($zipOpen)) {
                $contents = file_get_contents($this->CI->config->item('espel_hrmis_temp_folder') . zip_entry_name($zip_entry));
                unlink($this->CI->config->item('espel_hrmis_temp_folder') . zip_entry_name($zip_entry));
                zip_close($zipOpen);
                //unlink($this->CI->config->item('espel_hrmis_temp_folder') . $output);

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

    static function generateKelas($gred_id, $kumpulan)
    {
        preg_match_all('!\d+!', $gred_id, $matches);

        if ($kumpulan == 'PP') {
            if ($matches[0][0] == 6 || $matches[0][0] == 7)
                return 1;
            else
                return 2;
        } else {
            if ($matches[0][0] >= 41)
                return 2;
            if ($matches[0][0] >= 17 && $matches[0][0] <= 40)
                return 3;
            else
                return 4;
        }
    }
}