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
	        $data["profil"] = $this->profil->getProfil($nokp);
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
						return redirect("pengguna");
					}
					else
					{
						$this->appsess->setFlashSession("success", false);
						return redirect("profil/reset_katalaluan/" . $username);
					}
				}
				else
				{
					$this->appsess->setFlashSession("success", false);
					return redirect("profil/reset_katalaluan/" . $username);
				}
			}
		}
		else
		{
			return $this->renderPermissionDeny();
		}
	}
}
