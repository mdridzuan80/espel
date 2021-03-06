<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isLogged();
	}

	private function plugins()
    {
        return [
            "css" => [
                'assets/js/vendors/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css',
                'assets/css/calendar.css',
            ],
            "js" => [
                "assets/js/vendors/moment/moment.js",
                'assets/js/vendors/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js',
                'assets/js/kursus.js',
            ],
        ];
    }

	public function index($nokp)
	{
		if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN','PTJ']) || $this->appsess->getSessionData("username")==$nokp)
		{
			$this->load->model('profil_model','profil');
			$this->load->model('hrmis_skim_model','skim');
			$this->load->model('hrmis_carta_model','jabatan');
			$this->load->model('log_model', 'logging');

			$data["profil"] = $this->profil->getProfil($nokp);
			$data["skim"] = $this->skim;
			$data["jabatan"] = $this->jabatan;
			$data['mprofil'] = $this->profil;
			$data['sen_log'] = $this->logging->latest_log($nokp);

			$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Melihat Profil']);
	        return $this->load->view("profil/show",$data);
		}
		else
		{
			return $this->renderPermissionDeny();
		}
	}

	public function kumpulan($username)
	{
		if(!$this->exist("submit"))
		{
			$this->load->model('profil_model','profil');
			$this->load->model("kumpulan_model","kumpulan");
			$this->load->model("jabatan_model","jabatan");
			$this->load->model('kumpulan_profil_model', 'kumpulan_profil');
			
			
			$data["senPeranan"] = $this->kumpulan->sen_kumpulan_patut($this->kumpulan->get_by('kod',$this->appsess->getSessionData('kumpulan'))->id);
			$profil = $this->profil->get_by('nokp',$username);
			$data["profil"] = $profil;

			$data["sen_subscribe"] = $this->kumpulan_profil->subscribe_peranan($username);

			$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Mengakses maklumat peranan ' . $profil->nama]);
			$plugins['embedjs']=[$this->load->view('profil/peranan/js','',true)];
			return $this->renderView("profil/peranan/add", $data, $plugins);
		}
		else
		{
			$this->load->model("kumpulan_profil_model", "kumpulan_profil");
			$this->load->model('hrmis_carta_model', 'hrmis_carta');
        
			$all_jabatan = $this->hrmis_carta->as_array()->get_all();
		
			$data =[
				"kumpulan_id" => $this->input->post('comPeranan'),
				"profil_nokp" => $username,
			];

			if($this->input->post('comPeranan')==1 || $this->input->post('comPeranan')==2)
			{
				$selected = flattenArray(relatedJabatan($all_jabatan,$this->config->item('espel_default_jabatan_id')));
				array_push($selected,$this->config->item('espel_default_jabatan_id'));
				$data["inc_jab"] = serialize($selected);
				$data['sub_tree'] = 'Y';
				$data['jabatan_id'] = $this->config->item('espel_default_jabatan_id');
			}

			if($this->input->post('comPeranan')==3)
			{
				$data["jabatan_id"] = $this->input->post('comJabatanPenyelaras');
				$selected = flattenArray(relatedJabatan($all_jabatan,$data["jabatan_id"]));
				array_push($selected,$data["jabatan_id"]);
				$data["inc_jab"] = serialize($selected);
				$data['sub_tree'] = $this->input->post('comSubTree');
			}

			if($this->kumpulan_profil->insert($data))
			{
				$this->load->model('profil_model','profil');

				$sql = $this->db->last_query();
				$profil = $this->profil->get_by('nokp',$username);

				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menambah maklumat peranan bagi ' . $profil->nama, 'sql'=>$sql]);
				$this->appsess->setFlashSession("success", true);
			}
			else
			{
				$this->appsess->setFlashSession("success", false);
			}
		}

		return redirect('profil/' . $username . '/kump');
	}

	public function kumpulan_hapus($username, $kumpPenggunaID)
	{
		$this->load->model("kumpulan_profil_model","kumpulan_profil");

		if($this->kumpulan_profil->delete($kumpPenggunaID))
		{
			$this->load->model('profil_model','profil');
			$sql = $this->db->last_query();	

			$profil = $this->profil->get_by('nokp',$username);

			$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Hapus maklumat peranan ' . $profil->nama, 'sql'=>$sql]);
			$this->appsess->setFlashSession("success", true);
		}
		else
		{
			$this->appsess->setFlashSession("success", false);
		}
		return redirect('profil/' . $username . '/kump');
	}

	public function tukar_peranan($peranan, $jabatan_id = 0)
	{
		$this->appsess->setSessionData('ptj_jabatan_id', $jabatan_id);
		$this->appsess->setSessionData('kumpulan', $peranan);
		redirect('dashboard');
	}

	public function reset_katalaluan($username)
	{
		//if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN','PTJ','PENGGUNA']) || $this->appsess->getSessionData("username")==$username)
		//{
			if(!$this->exist("submit"))
			{
				$this->load->model('profil_model','profil');

				$data['profil'] = $this->profil->get($username);

				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menu reset katalaluan']);
				return $this->renderView("pengguna/reset_katalaluan", $data);
			}
			else
			{
				$this->load->model("profil_model","profil");
				$katalaluan = $this->input->post("txtKatalaluan");
				$reKatalaluan = $this->input->post("txtReKatalaluan");
				if(strcmp($katalaluan,$reKatalaluan)==0)
				{
					$data = [
						"password" => $this->appauth->hash_katalaluan($katalaluan),
					];

					if($this->profil->update($username,$data))
					{
						$this->appsess->setFlashSession("success", true);
						$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Berjaya reset katalaluan']);
						return redirect("profil/admin/reset_katalaluan");
					}
					else
					{
						$this->appsess->setFlashSession("success", false);
						$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Gagal reset katalaluan']);
						return redirect("profil/admin/reset_katalaluan");
					}
				}
				else
				{
					$this->appsess->setFlashSession("success", false);
					return redirect("profil/admin/reset_katalaluan");
				}
			}
		//}
		//else
		//{
		//	return $this->renderPermissionDeny();
		//}
	}

	public function resetkatalaluan($username)
	{
		$this->load->model('profil_model','profil');

		$data['profil'] = $this->profil->get($username);

		$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menu reset katalaluan']);
		return $this->load->view('pengguna/reset_katalaluan', $data);
	}

	public function ajax_do_resetkatalaluan()
	{
		$this->load->model("profil_model","profil");

		$username = $this->input->post('hddNoKP');
		$katalaluan = $this->input->post("txtKatalaluan");
		$reKatalaluan = $this->input->post("txtReKatalaluan");

		if(strcmp($katalaluan,$reKatalaluan)==0)
		{
			$data = [
				"password" => $this->appauth->hash_katalaluan($katalaluan),
			];

			if($this->profil->update($username,$data))
			{
				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Berjaya reset katalaluan']);
				$this->output->set_status_header(200);
			}
			else
			{
				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Gagal reset katalaluan']);
				$this->output->set_status_header(400,'Gagal reset katalaluan');
			}
		}
	}

	public function kecuali($nokp)
    {
		$this->load->model('kecuali_model', 'kecuali');

		if(!$this->exist("submit"))
		{
			$this->load->model('profil_model','profil');

			$data['sen_kecuali'] = $this->kecuali->get_many_by('nokp',$nokp);
			$data['profil'] = $this->profil->get($nokp);
			
			$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Akses profil ' . $nokp . ' pengecualian kelayakan kursus.']);
			$plugins = $this->plugins();
			$plugins['embedjs']=[$this->load->view('profil/kecuali/js','',true)];
			return $this->renderView("profil/kecuali/show",$data,$plugins);
		}
		else
		{
			$data = [
				'nokp' => $nokp,
				'mula' => $this->input->inputToDate("txtTkhMulaKecuali"),
				'tamat' => $this->input->inputToDate("txtTkhTamatKecuali"),
				'catatan' => $this->input->post('txtCatatan'),
			];

			$data_array=[];
			$ym = date('Y',strtotime($this->input->inputToDate("txtTkhMulaKecuali")));
			$yt = date('Y',strtotime($this->input->inputToDate("txtTkhTamatKecuali")));

			if($ym==$yt)
			{
				$data_array[$ym] = datediff('d', $this->input->inputToDate("txtTkhMulaKecuali"),$this->input->inputToDate("txtTkhTamatKecuali"))+1;
				$data['tahun1'] = $ym;
				$data['hari1'] = $data_array[$ym];
				$data['layak1'] = round((365-$data_array[$ym])*7/365);
			}
			else
			{
				$data_array[$ym] = datediff('d', $this->input->inputToDate("txtTkhMulaKecuali"),$ym . '-12-31')+1;
				$data['tahun1'] = $ym;
				$data['hari1'] = $data_array[$ym];
				$data['layak1'] = round((365-$data_array[$ym])*7/365);
				$data_array[$yt] = datediff('d', $yt . '-01-01',$this->input->inputToDate("txtTkhTamatKecuali"))+1;
				$data['tahun2'] = $yt;
				$data['hari2'] = $data_array[$yt];
				$data['layak2'] = round((365-$data_array[$yt])*7/365);
			}

			$data['serialize'] = serialize($data_array);

			if($this->kecuali->insert($data))
			{
				$this->appsess->setFlashSession("success", true);
				$sql = $this->db->last_query();
				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menambah maklumat pengecualian kelayakan kursus', 'sql'=>$sql]);
			}
			else
			{
				$this->appsess->setFlashSession("success", false);
				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Gagal menambah maklumat pengecualian kelayakan kursus']);
			}

			return redirect('profil/' . $nokp . '/kecuali');
		}
	}
	
	public function kecuali_hapus($username, $kecualiId)
	{
		$this->load->model("kecuali_model","kecuali");

		if($this->kecuali->delete($kecualiId))
		{
			$sql = $this->db->last_query();
			$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menghapus maklumat pengecualian kursus', 'sql'=>$sql]);
			$this->appsess->setFlashSession("success", true);
		}
		else
		{
			$this->appsess->setFlashSession("success", false);
		}
		return redirect('profil/' . $username . '/kecuali');
	}

	public function edit_kursus($nokp, $tahun)
	{
		$this->load->model('profil_model', 'profil');
		$this->load->model("kursus_model", "kursus");
		$this->load->model("mycpd_model", "mycpd");

		$data['tahun'] = $tahun;
		$data['profil'] = $this->profil->get($nokp);
		$data["sen_hadir"] = $this->kursus->get_all_kursus_hadir($nokp, $tahun);
		$data["mycpd"] = $this->mycpd->get_point($nokp, $tahun);

		$plugins = $this->plugins();
		$plugins["embedjs"][] = $this->load->view("profil/edit_js", null, true);

		return $this->renderView("profil/edit_kursus", $data, $plugins);
	}
}
