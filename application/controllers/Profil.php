<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->isLogged();
	}

	public function index($nokp)
	{
		if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']) || $this->appsess->getSessionData("username")==$nokp)
		{
			$this->load->model('profil_model','profil');
			$this->load->model('hrmis_skim_model','skim');
			$this->load->model('hrmis_carta_model','jabatan');

			$data["profil"] = $this->profil->getProfil($nokp);
			$data["skim"] = $this->skim;
			$data["jabatan"] = $this->jabatan;

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
			$this->load->model("kumpulan_model","kumpulan");
			$this->load->model("jabatan_model","jabatan");
			$data["senPeranan"] = $this->kumpulan->get_all();
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
				$this->appsess->setFlashSession("success", true);
			}
			else
			{
				$this->appsess->setFlashSession("success", false);
			}
		}

		return redirect('profil/' . $username);
	}

	public function kumpulan_hapus($username, $kumpPenggunaID)
	{
		$this->load->model("kumpulan_profil_model","kumpulan_profil");

		if($this->kumpulan_profil->delete($kumpPenggunaID))
		{
			$this->appsess->setFlashSession("success", true);
		}
		else
		{
			$this->appsess->setFlashSession("success", false);
		}
		return redirect('profil/' . $username);
	}

	public function tukar_peranan($peranan)
	{
		$this->appsess->setSessionData('kumpulan',$peranan);
		redirect('');
	}

	public function reset_katalaluan($username)
	{
		if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN']) || $this->appsess->getSessionData("username")==$username)
		{
			if(!$this->exist("submit"))
			{
				$this->applog->write(['nokp'=>$this->appsess->getSessionData('username'),'event'=>'Menu reset katalaluan']);
				return $this->renderView("pengguna/reset_katalaluan");
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
}
