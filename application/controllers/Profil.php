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
	        return $this->renderView("profil/show",$data);
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
			return $this->renderView("profil/peranan/add", $data);
		}
		else
		{
			$this->load->model("kumpulan_profil_model", "kumpulan_profil");
			$data =[
				"kumpulan_id" => $this->input->post('comPeranan'),
				"profil_nokp" => $username,
			];

			if($this->input->post('comPeranan')==3)
			{
				$data["jabatan_id"] = $this->input->post('comJabatanPenyelaras');
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

	public function tukar_peranan($peranan)
	{
		$this->appsess->setSessionData('kumpulan',$peranan);
		redirect('');
	}

	public function reset_katalaluan($username)
	{
		if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN','PTJ']) || $this->appsess->getSessionData("username")==$username)
		{
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
		}
		else
		{
			return $this->renderPermissionDeny();
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
				'catatan' => $this->input->post('txtCatatan')
			];

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
}
